<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ShippingCharge;
use Helper;
use Illuminate\Http\Request;
use Session;

class ShippingChargeController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('shippingcharge-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $shippingcharge = ShippingCharge::where('name', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $shippingcharge = ShippingCharge::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'shippingcharge  Show All Record');
        return view('admin.shipping-charge.index', compact('shippingcharge'));
    }

    public function create()
    {
        if (!Helper::authCheck('shippingcharge-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'shippingcharge Add New button clicked');
        return view('admin.shipping-charge.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            // 'status' => 'required||unique:shipping_charges',
            'status' => ['required'], [function ($attribute, $value, $fail) {
                if ($value == 'active') {
                    if (ShippingCharge::where('status', 'active')->first()) {
                        $fail('another active status :)');
                    }
                }

            }],
        ]);
        $requestData = $request->all();

        ShippingCharge::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'shippingcharge Record Saved');
        return redirect('admin/shipping-charge');
    }

    public function show($id)
    {
        $shippingcharge = ShippingCharge::findOrFail($id);
        Helper::activityStore('Store', 'shippingcharge Single Record showed');
        return view('admin.shipping-charge.show', compact('shippingcharge'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('shippingcharge-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $shippingcharge = ShippingCharge::findOrFail($id);
        Helper::activityStore('Edit', 'shippingcharge Edit button clicked');
        return view('admin.shipping-charge.edit', compact('shippingcharge'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            // 'status' => 'required||unique:shipping_charges',
            'status' => ['required'], [function ($attribute, $value, $fail) {
                if ($value == 'active') {
                    if (ShippingCharge::where('status', 'active')->first()) {
                        $fail('another active status :)');
                    }
                }

            }],
        ]);
        $requestData = $request->all();

        $shippingcharge = ShippingCharge::findOrFail($id);
        $shippingcharge->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'shippingcharge Record Updated');
        return redirect('admin/shipping-charge');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('shippingcharge-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        ShippingCharge::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'shippingcharge Delete button clicked');
        return redirect('admin/shipping-charge');
    }
}