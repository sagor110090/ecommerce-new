<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Payment;
use App\Product;
use App\ShippingCharge;
use App\ShippingDetail;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Session;

class PaymentController extends Controller
{

    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(DB::table('paypal_info')->first()->client_id);
        $this->gateway->setSecret(DB::table('paypal_info')->first()->client_secret);
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function index()
    {
        return view('payment');
    }

    public function charge(Request $request)
    {
        $this->validate($request, [
            "fname" => "required",
            "lname" => "required",
            "email" => "required",
            "country" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "postcode" => "required",
            "phone_number" => "required",
            "shipping" => "required",
            "paymentmethod" => "required",
        ]);
        Session::put('shipping_info', $request->all());
        $subTotal = Cart::getSubTotal();
        $cartTotalQuantity = Cart::getTotalQuantity();
        $items = Cart::getContent();
        if (sizeof($items) == 0) {
            return redirect()->back()->with('warning', 'No item selected for order');
        }

        $shippingCharge = 0;
        if (ShippingCharge::where('status', 'active')->first()) {
            $shippingCharge = ShippingCharge::where('status', 'active')->first()->amount;
        }
        $total = $subTotal + $shippingCharge;

        if ($request->input('paymentmethod') == 'paypal') {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $total,
                    'currency' => DB::table('paypal_info')->first()->currency,
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();

                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            $customer_id = Auth::user()->customer->id;
            $order = Order::create([
                'order_amount' => $subTotal,
                'shipping_charge' => $shippingCharge,
                'total_item' => $items->count(),
                'customerInfo_id' => $customer_id,
                'payment_method' => $request->paymentmethod,
                'payment_status' => 'not_paid',
                'delivery_status' => 'not_delivered',
            ]);
            foreach ($items as $key => $value) {
                OrderItem::create([
                    'product_id' => $value->id,
                    'product_quantity' => $value->quantity,
                    'product_price' => $value->price,
                    'order_id' => $order->id,
                ]);
                $product = Product::find($value->id);
                $product->update(['quantity' => $product->quantity - $value->quantity]);
            }
            ShippingDetail::create([
                "fname" => $request->fname,
                "lname" => $request->lname,
                "email" => $request->email,
                "address" => $request->address,
                "city" => $request->city,
                "country" => $request->country,
                "state" => $request->state,
                "postcode" => $request->postcode,
                "phone_number" => $request->phone_number,
                "customerInfo_id" => $customer_id,
                "order_id" => $order->id,
            ]);
            return redirect('/')->withSuccess('order successful');
        }
    }

    public function payment_success(Request $request)
    {
        $data = Session::get('shipping_info');
        $customer_id = Auth::user()->customer->id;

        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Payment;
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = DB::table('paypal_info')->first()->currency;
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();

                    $subTotal = Cart::getSubTotal();
                    $cartTotalQuantity = Cart::getTotalQuantity();
                    $items = Cart::getContent();
                    $shippingCharge = 0;
                    if (ShippingCharge::where('status', 'active')->first()) {
                        $shippingCharge = ShippingCharge::where('status', 'active')->first()->amount;
                    }
                    $order = Order::create([
                        'order_amount' => $subTotal,
                        'shipping_charge' => $shippingCharge,
                        'total_item' => $items->count(),
                        'customerInfo_id' => $customer_id,
                        'payment_method' => 'paypal',
                        'payment_status' => 'paid',
                        'delivery_status' => 'not_delivered',
                    ]);
                    $customer = ['customerInfo_id' => $customer_id, 'order_id' => $order->id];
                    $data = array_merge($data, $customer);
                    foreach ($items as $key => $value) {
                        OrderItem::create([
                            'product_id' => $value->id,
                            'product_quantity' => $value->quantity,
                            'order_id' => $order->id,
                            'product_price' => $value->price,
                        ]);
                        $product = Product::find($value->id);
                        $product->update(['quantity' => $product->quantity - $value->quantity]);
                    }
                    ShippingDetail::create($data);

                }

                return redirect('/')->withSuccess('order successful');
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        return 'User is canceled the payment.';
    }

}
