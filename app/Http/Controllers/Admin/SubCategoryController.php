<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SubCategory;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;

class SubCategoryController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('subcategory-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $subcategory = SubCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $subcategory = SubCategory::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'subcategory  Show All Record');
        return view('admin.sub-category.index', compact('subcategory'));
    }

    public function create()
    {
        if (!Helper::authCheck('subcategory-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'subcategory Add New button clicked');
        return view('admin.sub-category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:sub_categories',
            'category_id' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('uploads', 'public');
        }

        SubCategory::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'subcategory Record Saved');
        return redirect()->back();
    }

    public function show($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        Helper::activityStore('Store', 'subcategory Single Record showed');
        return view('admin.sub-category.show', compact('subcategory'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('subcategory-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $subcategory = SubCategory::findOrFail($id);
        Helper::activityStore('Edit', 'subcategory Edit button clicked');
        return view('admin.sub-category.edit', compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('uploads', 'public');
            Storage::delete($request->oldImage);

        }

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'subcategory Record Updated');
        return redirect('admin/sub-category');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('subcategory-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Storage::delete(SubCategory::find($id)->image);
        SubCategory::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'subcategory Delete button clicked');
        return redirect('admin/sub-category');
    }
}