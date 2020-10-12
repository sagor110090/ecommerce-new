<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Helper;
use Illuminate\Http\Request;
use Session;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('supplier-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $supplier = Supplier::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('phone_number', 'LIKE', "%$keyword%")
                ->orWhere('total_paid_amount', 'LIKE', "%$keyword%")
                ->orWhere('total_paid_due', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $supplier = Supplier::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'supplier  Show All Record');
        return view('admin.supplier.index', compact('supplier'));
    }

    public function create()
    {
        if (!Helper::authCheck('supplier-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'supplier Add New button clicked');
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);
        $requestData = $request->all();

        Supplier::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'supplier Record Saved');
        return redirect('admin/supplier');
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        Helper::activityStore('Store', 'supplier Single Record showed');
        return view('admin.supplier.show', compact('supplier'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('supplier-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $supplier = Supplier::findOrFail($id);
        Helper::activityStore('Edit', 'supplier Edit button clicked');
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);
        $requestData = $request->all();

        $supplier = Supplier::findOrFail($id);
        $supplier->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'supplier Record Updated');
        return redirect('admin/supplier');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('supplier-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Supplier::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'supplier Delete button clicked');
        return redirect('admin/supplier');
    }
}
