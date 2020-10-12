<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Session;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('brand-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $brand = Brand::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $brand = Brand::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'brand  Show All Record');
        return view('admin.brand.index', compact('brand'));
    }

    public function create()
    {
        if (!Helper::authCheck('brand-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'brand Add New button clicked');
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:brands',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('brand', 'public');
            $setImage = 'storage/' . $requestData['image'];
            $img = Image::make($setImage)->resize(160, 90)->save($setImage);
        }
        Brand::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'brand Record Saved');
        return redirect('admin/brand');
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        Helper::activityStore('Store', 'brand Single Record showed');
        return view('admin.brand.show', compact('brand'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('brand-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $brand = Brand::findOrFail($id);
        Helper::activityStore('Edit', 'brand Edit button clicked');
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        $brand = Brand::findOrFail($id);
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('brand', 'public');
            $setImage = 'storage/' . $requestData['image'];
            $img = Image::make($setImage)->resize(160, 90)->save($setImage);
            Storage::delete($brand->image);
        }
        $brand->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'brand Record Updated');
        return redirect('admin/brand');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('brand-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $item = Product::find($id);
        Storage::delete($item->image);
        Brand::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'brand Delete button clicked');
        return redirect('admin/brand');
    }
}