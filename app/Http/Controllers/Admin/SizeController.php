<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use Helper;
use Illuminate\Http\Request;
use Session;

class SizeController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('size-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $size = Size::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $size = Size::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'size  Show All Record');
        return view('admin.size.index', compact('size'));
    }

    public function create()
    {
        if (!Helper::authCheck('size-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'size Add New button clicked');
        return view('admin.size.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();

        Size::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'size Record Saved');
        return redirect('admin/size');
    }

    public function show($id)
    {
        $size = Size::findOrFail($id);
        Helper::activityStore('Store', 'size Single Record showed');
        return view('admin.size.show', compact('size'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('size-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $size = Size::findOrFail($id);
        Helper::activityStore('Edit', 'size Edit button clicked');
        return view('admin.size.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();

        $size = Size::findOrFail($id);
        $size->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'size Record Updated');
        return redirect('admin/size');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('size-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Size::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'size Delete button clicked');
        return redirect('admin/size');
    }
}
