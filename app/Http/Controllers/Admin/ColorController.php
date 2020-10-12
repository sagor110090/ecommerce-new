<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Session;

class ColorController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('color-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $color = Color::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $color = Color::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'color  Show All Record');
        return view('admin.color.index', compact('color'));
    }

    public function create()
    {
        if (!Helper::authCheck('color-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'color Add New button clicked');
        return view('admin.color.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();

        Color::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'color Record Saved');
        return redirect('admin/color');
    }

    public function show($id)
    {
        $color = Color::findOrFail($id);
        Helper::activityStore('Store', 'color Single Record showed');
        return view('admin.color.show', compact('color'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('color-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $color = Color::findOrFail($id);
        Helper::activityStore('Edit', 'color Edit button clicked');
        return view('admin.color.edit', compact('color'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();

        $color = Color::findOrFail($id);
        $color->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'color Record Updated');
        return redirect('admin/color');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('color-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Color::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'color Delete button clicked');
        return redirect('admin/color');
    }
}
