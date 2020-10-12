<?php

namespace App\Http\Controllers;

use App\BillingDetail;
use App\Blog;
use App\Brand;
use App\Category;
use App\Compare;
use App\CustomerInfo;
use App\Http\Controllers\Controller;
use App\MiniCategory;
use App\Order;
use App\OrderItem;
use App\Product;
use App\ShippingCharge;
use App\Slider;
use App\SubCategory;
use App\Type;
use App\User;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        $featureds = Product::where('featured', 'yes')->inRandomOrder()->get();
        $newArrivals = Product::inRandomOrder()->limit(100)->get();
        $newProducts = Product::inRandomOrder()->limit(100)->get();
        $mostViewed = Product::inRandomOrder()->limit(100)->get();
        $hotSales = Product::inRandomOrder()->limit(100)->get();
        $hotDeals = Product::inRandomOrder()->limit(100)->get();
        $bestSellers = Product::inRandomOrder()->limit(100)->get();
        $latestProducts = Product::inRandomOrder()->limit(100)->get();

        $blog = Blog::latest()->get();
        return view('frontEnd.index', compact('sliders', 'featureds', 'newArrivals', 'newProducts', 'mostViewed', 'hotSales', 'latestProducts', 'hotDeals', 'bestSellers', 'blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productDetails($id)
    {
        $product = Product::where('slug', $id)->first();
        $featureds = Product::where('featured', 'yes')->inRandomOrder()->limit(20)->get();
        $relatedProducts = Product::inRandomOrder()->limit(20)->get();
        $tags = Type::get();
        $reviews = DB::table('reviews')->where('product_id', $product->id)->get();
        return view('frontEnd.product-details', compact('product', 'featureds', 'relatedProducts', 'tags', 'reviews'));
    }
    public function cart()
    {
        $subTotal = Cart::getSubTotal();
        $items = Cart::getContent();
        $cartTotalQuantity = Cart::getTotalQuantity();
        $total = Cart::getTotal();
        $shippingCharge = 0;
        if (ShippingCharge::where('status', 'active')->first()) {
            $shippingCharge = ShippingCharge::where('status', 'active')->first()->amount;
        }
        return view('frontEnd.cart', compact('subTotal', 'items', 'cartTotalQuantity', 'total', 'shippingCharge'));
    }
    public function cartUpdate(Request $request)
    {
        $result = [];
        if ($request->id != null) {

            for ($i = 0; $i < count($request->id); $i++) {
                if ($request->quantity[$i] > $request->oldQuantity[$i]) {
                    $result[$i] = $request->quantity[$i] - $request->oldQuantity[$i];
                    Cart::update($request->id[$i], array(
                        'quantity' => $result[$i],
                    ));
                } else {
                    $result[$i] = $request->quantity[$i] - $request->oldQuantity[$i];
                    Cart::update($request->id[$i], array(
                        'quantity' => $result[$i],
                    ));
                }

            }
        }
        return redirect('/cart');
    }
    public function removeFromCart($id)
    {
        Cart::remove($id);
        return redirect('/cart');
    }

    public function checkout()
    {
        $subTotal = Cart::getSubTotal();
        $items = Cart::getContent();
        $cartTotalQuantity = Cart::getTotalQuantity();
        $total = Cart::getTotal();
        $shippingCharge = 0;
        if (ShippingCharge::where('status', 'active')->first()) {
            $shippingCharge = ShippingCharge::where('status', 'active')->first()->amount;
        }
        return view('frontEnd.checkout', compact('subTotal', 'items', 'cartTotalQuantity', 'total', 'shippingCharge'));
    }

    public function order(Request $request)
    {
        $customer_id = Auth::user()->customer->id;
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
        ]);
        foreach ($items as $key => $value) {
            OrderItem::create([
                'product_id' => $value->id,
                'product_quantity' => $value->quantity,
                'order_id' => $order->id,
            ]);
        }
        BillingDetail::create([
            "fname" => $request->fname,
            "lname" => $request->lname,
            "email" => $request->email,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "postcode" => $request->postcode,
            "phone_number" => $request->phone_number,
            "customerInfo_id" => $customer_id,
            "order_id" => $order->id,
        ]);
    }

    public function category($slug)
    {
        $id = Category::where('slug', $slug)->first()->id;
        $products = Product::where('category_id', $id)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function subCategory($id)
    {
        $id = SubCategory::where('slug', $slug)->first()->id;

        $products = Product::where('subcategory_id', $id)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function miniCategory($slug)
    {
        $id = MiniCategory::where('slug', $slug)->first()->id;
        $products = Product::where('minicategory_id', $id)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function search(Request $request)
    {
        $products = Product::where('name', $request->search)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shop()
    {
        $products = Product::paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function filter(Request $request)
    {
        $products = Product::whereBetween('sale_price', [$request->minPrice, $request->maxPrice])->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function brand($slug)
    {
        $id = Brand::where('slug', $slug)->first()->id;
        $products = Product::where('brand_id', $id)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function type($slug)
    {
        $id = Type::where('slug', $slug)->first()->id;
        $products = Product::where('type_id', $id)->paginate(20);
        return view('frontend.shop', compact('products'));
    }
    public function cartStore(Request $request)
    {
        Cart::add(array(
            'id' => $request->product_id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'attributes' => array(
                'size' => $request->size,
                'color' => $request->color,
                'image' => $request->thumbnail1,
                'slug' => $request->slug,
            ),
            
        ));

        $subTotal = Cart::getSubTotal();
        // view the cart items
        $items = Cart::getContent();
       

        $cartTotalQuantity = Cart::getTotalQuantity();
        return response()->json(['items' => $items, 'subTotal' => $subTotal, 'cartTotalQuantity' => $cartTotalQuantity]);
    }
    public function showCart()
    {
        $subTotal = Cart::getSubTotal();
        // view the cart items
        $items = Cart::getContent();
        $cartTotalQuantity = Cart::getTotalQuantity();
        return response()->json(['items' => $items, 'subTotal' => $subTotal, 'cartTotalQuantity' => $cartTotalQuantity]);
    }
    public function removeCart($id)
    {
        Cart::remove($id);

        $subTotal = Cart::getSubTotal();
        // view the cart items
        $items = Cart::getContent();
        $cartTotalQuantity = Cart::getTotalQuantity();
        return response()->json(['items' => $items, 'subTotal' => $subTotal, 'cartTotalQuantity' => $cartTotalQuantity]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
    public function wishlistStore(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required||unique:wishlists',
        ]);
        DB::table('wishlists')->insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
        ]);
        return response()->json('done');
    }
    public function wishlistIndex(Request $request)
    {
        $products = DB::table('wishlists')->where('user_id', Auth::user()->id)->get();
        return view('frontEnd.wishlist', compact('products'));
    }
    public function wishlistDelete($id)
    {
        DB::table('wishlists')->delete($id);
        return redirect('/wishlists');
    }
    public function myAccount()
    {
        $orders = Order::where('customerInfo_id', Auth::user()->customer->id)->get();
        $customer = CustomerInfo::find(Auth::user()->customer->id);
        return view('frontEnd.my-account', compact('orders', 'customer'));
    }
    public function myAccountStore($id, Request $request)
    {
        CustomerInfo::find($id)->update($request->all());
        return redirect('/my-account');
    }
    public function myAccountDetail($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'required||unique:users',
        ]);
        User::find($id)->update($request->all());
        return redirect('/my-account');
    }
    public function compare($id)
    {
        $customer_id = Auth::user()->customer->id;
        if (Compare::where('customer_id', $customer_id)->count() > 5) {
            return response()->json("You can't add more than 4 items");
        }
        $compare = Compare::where('product_id', $id)->where('customer_id', $customer_id)->first();
        if ($compare) {
            return response()->json('Item alrady added to compare list');
        }
        Compare::insert([
            'product_id' => $id,
            'customer_id' => $customer_id,
        ]);
        return response()->json('Item added to compare list');
    }
    public function compareShow()
    {
        $compare = Compare::where('customer_id', Auth::user()->customer->id)->get();
        return view('frontEnd.compare', compact('compare'));
    }
    public function blog()
    {
        $blog = Blog::latest()->get();
        return view('frontEnd.blog', compact('blog'));
    }
    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('frontEnd.blog-details', compact('blog'));
    }
    public function reviewStore(Request $request)
    {
        $review = DB::table('reviews')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'review' => $request->review,
            'product_id' => $request->product_id,
        ]);
        return redirect()->back()->with('success', 'Thanks for reviews');
    }
    public function contactUs()
    {
        $contact = DB::table('contact_us')->where('id', 1)->first();
        return view('frontEnd.contact-us', compact('contact'));
    }
    public function newsletter(Request $request)
    {
        $this->validate($request, [
            'email' => 'required||unique:newsletters',
        ]);
        $contact = DB::table('newsletters')->insert(['email' => $request->email]);
        return redirect()->back()->with('success', 'thanks for subscription');
    }

    public function termsAndConditions()
    {
        $termsAndConditions = DB::table('terms_and_conditions')->where('id', 1)->first();
        return view('frontEnd.termsAndConditions', compact('termsAndConditions'));
    }
}