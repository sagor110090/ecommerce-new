<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MiniCategory;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class MiniCategoryController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('minicategory-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $minicategory = MiniCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('subCategory_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $minicategory = MiniCategory::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'minicategory  Show All Record');
        return view('admin.mini-category.index', compact('minicategory'));
    }

    public function create()
    {
        if (!Helper::authCheck('minicategory-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'minicategory Add New button clicked');
        return view('admin.mini-category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:mini_categories',
            'subCategory_id' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        MiniCategory::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'minicategory Record Saved');
        return redirect()->back();
    }

    public function show($id)
    {
        $minicategory = MiniCategory::findOrFail($id);
        Helper::activityStore('Store', 'minicategory Single Record showed');
        return view('admin.mini-category.show', compact('minicategory'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('minicategory-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $minicategory = MiniCategory::findOrFail($id);
        Helper::activityStore('Edit', 'minicategory Edit button clicked');
        return view('admin.mini-category.edit', compact('minicategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'subCategory_id' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        $minicategory = MiniCategory::findOrFail($id);
        $minicategory->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'minicategory Record Updated');
        return redirect('admin/mini-category');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('minicategory-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        MiniCategory::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'minicategory Delete button clicked');
        return redirect('admin/mini-category');
    }
}