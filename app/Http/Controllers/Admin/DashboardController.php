<?php

namespace App\Http\Controllers\Admin;

use App\CustomerInfo;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    public function index()
    {
        $chart_options = [
            'chart_title' => 'Daily Orders: Last 30 day ',
            'report_type' => 'group_by_date',
            'model' => 'App\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only last 30 days

        ];
        $chart1 = new LaravelChart($chart_options);
        return view('dashboard', compact('chart1'));
    }

    public function order()
    {
        if (!Helper::authCheck('order-list')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('show', 'show order list');
        $order = Order::latest()->get();
        foreach ($order as $key => $value) {
            if ($value->show == 0) {
                Order::find($value->id)->update(['show' => 1]);
            }
        }
        $order = Order::latest()->paginate(25);
        return view('admin.order.order', compact('order'));
    }

    public function orderItem($id)
    {
        if (!Helper::authCheck('orderItem-list')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('show', 'show orderItem list');
        $order = Order::find($id);
        $orderItem = $order->orderItem;
        return view('admin.order.orderItem', compact('orderItem', 'id'));
    }
    public function customer()
    {
        if (!Helper::authCheck('customer-list')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('show', 'show customer list');
        $customer = CustomerInfo::latest()->paginate(25);
        return view('admin.order.customer', compact('customer'));
    }
    public function paypalInfo()
    {
        if (!Helper::authCheck('paypal-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Show', 'paypal show');
        $paypal = DB::table('paypal_info')->where('id', 1)->first();
        return view('admin.order.paypal', compact('paypal'));
    }
    public function paypalInfoStore(Request $request)
    {
        if (!Helper::authCheck('paypal-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('edit', 'paypal edit');
        DB::table('paypal_info')->where('id', 1)
            ->update([
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'currency' => $request->currency,
            ]);
        return redirect()->back();
    }
    public function invoice($id)
    {
        $order = Order::find($id);
        if ($order->show == 0) {
            $order->update(['show' => 1]);
        }
        return view('admin.order.invoice', compact('order'));
    }
    public function payment($id, Request $request)
    {
        if (!Helper::authCheck('order-list')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('show', 'show order list');
        $order = Order::findOrFail($id)->update(['payment_status' => $request->payment]);
        Session::flash('success', 'Successfully Saved!');

        return redirect()->back();
    }
    public function delivery($id, Request $request)
    {
        $order = Order::findOrFail($id)->update(['delivery_status' => $request->delivery_status]);
        return redirect()->back();
    }
    public function banner()
    {
        if (!Helper::authCheck('banner-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $banner = DB::table('banners')->first();
        return view('admin.order.banner', compact('banner'));
    }
    public function bannerStore(Request $request)
    {
        if (!Helper::authCheck('banner-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('update', 'Banner update');
        $requestData = [];
        dd($request->all());
        if ($request->hasFile('banner_1')) {
            $requestData['banner_1'] = $request->file('banner_1')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_1'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_1);
        }
        if ($request->hasFile('banner_2')) {
            $requestData['banner_2'] = $request->file('banner_2')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_2'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_2);
        }
        if ($request->hasFile('banner_3')) {
            $requestData['banner_3'] = $request->file('banner_3')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_3'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_3);
        }
        if ($request->hasFile('banner_4')) {
            $requestData['banner_4'] = $request->file('banner_4')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_4'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_4);
        }
        if ($request->hasFile('banner_5')) {
            $requestData['banner_5'] = $request->file('banner_5')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_5'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_5);
        }
        if ($request->hasFile('banner_6')) {
            $requestData['banner_6'] = $request->file('banner_6')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_6'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_6);
        }
        if ($request->hasFile('banner_7')) {
            $requestData['banner_7'] = $request->file('banner_7')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_7'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_7);
        }
        if ($request->hasFile('banner_8')) {
            $requestData['banner_8'] = $request->file('banner_8')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_8'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_8);
        }
        if ($request->hasFile('banner_9')) {
            $requestData['banner_9'] = $request->file('banner_9')
                ->store('banner-image', 'public');
            $setImage = 'storage/' . $requestData['banner_9'];
            // $img = Image::make($setImage)->resize(655, 800)->save($setImage);
            Storage::delete($request->oldbanner_9);
        }
        // if ($requestData == null) {
        //     return redirect()->back()->with('success', 'Nothing Update!');
        // }
        DB::table('banners')->where('id', 1)->update($requestData);
        // DB::table('banners')
        Session::flash('success', 'Successfully Update!');

        return redirect()->back();
    }

    public function contactUs()
    {
        if (!Helper::authCheck('contact-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $contact = DB::table('contact_us')->where('id', 1)->first();
        return view('admin.order.contact-us', compact('contact'));
    }
    public function contactUsStore(Request $request)
    {
        if (!Helper::authCheck('contact-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('edit', 'contact edit');
        DB::table('contact_us')->where('id', 1)->update($request->except(['_token']));
        return redirect()->back()->with('success', 'Contact Update!');
    }
    public function newsletterShow()
    {
        if (!Helper::authCheck('newsletter-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('show', 'newsletters show');
        $newsletters = DB::table('newsletters')->latest()->get();
        return view('admin.order.newsletter', compact('newsletters'));
    }
    public function setting()
    {
        if (!Helper::authCheck('setting-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $setting = DB::table('setting')->where('id', 1)->first();
        return view('admin.order.setting', compact('setting'));
    }

    public function settingStore(Request $request)
    {
        if (!Helper::authCheck('setting-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('edit', 'setting edit');
        $requestData = $request->except(['_token', 'oldlogo', 'oldfavicon']);
        if ($request->hasFile('logo')) {
            $requestData['logo'] = $request->file('logo')
                ->store('banner-image', 'public');
            Storage::delete($request->oldlogo);
        }
        if ($request->hasFile('favicon')) {
            $requestData['favicon'] = $request->file('favicon')
                ->store('banner-image', 'public');
            Storage::delete($request->oldfavicon);
        }
        DB::table('setting')->where('id', 1)->update($requestData);
        return redirect()->back()->with('success', 'Setting Update!');
    }
    public function termsAndConditions()
    {
        if (!Helper::authCheck('termsAndConditions-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $terms_and_condition = DB::table('terms_and_conditions')->where('id', 1)->first();
        return view('admin.order.termsAndConditions', compact('terms_and_condition'));
    }
    public function termsAndConditionsStore(Request $request)
    {
        if (!Helper::authCheck('termsAndConditions-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('edit', 'Terms And Conditions edit');
        $requestData = $request->except(['_token']);

        DB::table('terms_and_conditions')->where('id', 1)->update($requestData);
        return redirect()->back()->with('success', 'Terms And Conditions Update!');
    }
}