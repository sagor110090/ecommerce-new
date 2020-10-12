<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Session;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('category-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $category = Category::where('name', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $category = Category::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'category  Show All Record');
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        if (!Helper::authCheck('category-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'category Add New button clicked');
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:categories',
            'image' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('product-image', 'public');
            $setImage = 'storage/' . $requestData['image'];
            $img = Image::make($setImage)->resize(24, 24)->save($setImage);

        }
        Category::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'category Record Saved');
        return redirect('admin/category');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        Helper::activityStore('Store', 'category Single Record showed');
        return view('admin.category.show', compact('category'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('category-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $category = Category::findOrFail($id);
        Helper::activityStore('Edit', 'category Edit button clicked');
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('product-image', 'public');
            $setImage = 'storage/' . $requestData['image'];
            $img = Image::make($setImage)->resize(24, 24)->save($setImage);

        }
        $category = Category::findOrFail($id);
        $category->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'category Record Updated');
        return redirect('admin/category');
    }

    public function destroy($id, Request $request)
    {
        if (!Helper::authCheck('category-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Storage::delete(Category::find($id)->image);
        Category::destroy($id);

        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'category Delete button clicked');
        return redirect('admin/category');
    }
}