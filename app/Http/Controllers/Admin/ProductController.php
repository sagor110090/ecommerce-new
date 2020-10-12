<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MiniCategory;
use App\Product;
use App\SubCategory;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Session;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('product-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $product = Product::where('name', 'LIKE', "%$keyword%")
                ->orWhere('sku', 'LIKE', "%$keyword%")
                ->orWhere('category_id', 'LIKE', "%$keyword%")
                ->orWhere('subcategory', 'LIKE', "%$keyword%")
                ->orWhere('minicategory', 'LIKE', "%$keyword%")
                ->orWhere('type_id', 'LIKE', "%$keyword%")
                ->orWhere('brand_id', 'LIKE', "%$keyword%")
                ->orWhere('color_id', 'LIKE', "%$keyword%")
                ->orWhere('size_id', 'LIKE', "%$keyword%")
                ->orWhere('quantity', 'LIKE', "%$keyword%")
                ->orWhere('regular_price', 'LIKE', "%$keyword%")
                ->orWhere('sale_price', 'LIKE', "%$keyword%")
                ->orWhere('thumbnail1', 'LIKE', "%$keyword%")
                ->orWhere('thumbnail2', 'LIKE', "%$keyword%")
                ->orWhere('image1', 'LIKE', "%$keyword%")
                ->orWhere('image2', 'LIKE', "%$keyword%")
                ->orWhere('image3', 'LIKE', "%$keyword%")
                ->orWhere('brand_id', 'LIKE', "%$keyword%")
                ->orWhere('short_description', 'LIKE', "%$keyword%")
                ->orWhere('long_description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $product = Product::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'product  Show All Record');
        return view('admin.product.index', compact('product'));
    }

    public function create()
    {
        if (!Helper::authCheck('product-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'product Add New button clicked');
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'brand_id' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name . '-' . rand());
        if ($request->hasFile('thumbnail1')) {
            $requestData['thumbnail1'] = $request->file('thumbnail1')
                ->store('product-image', 'public');
            
        }
        if ($request->hasFile('thumbnail2')) {
            $requestData['thumbnail2'] = $request->file('thumbnail2')
                ->store('product-image', 'public');
           

        }
        if ($request->hasFile('image1')) {
            $requestData['image1'] = $request->file('image1')
                ->store('product-image', 'public');
            
        }
        if ($request->hasFile('image2')) {
            $requestData['image2'] = $request->file('image2')
                ->store('product-image', 'public');
           

        }
        if ($request->hasFile('image3')) {
            $requestData['image3'] = $request->file('image3')
                ->store('product-image', 'public');
           
        }

        Product::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'product Record Saved');
        return redirect('admin/product');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        Helper::activityStore('Store', 'product Single Record showed');
        return view('admin.product.show', compact('product'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('product-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $product = Product::findOrFail($id);
        // dd($product);
        Helper::activityStore('Edit', 'product Edit button clicked');
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'brand_id' => 'required',
        ]);
        $requestData = $request->all();

        $product = Product::findOrFail($id);
        if ($request->hasFile('thumbnail1')) {
            $requestData['thumbnail1'] = $request->file('thumbnail1')
                ->store('product-image', 'public');
           
            
        }
        if ($request->hasFile('thumbnail2')) {
            $requestData['thumbnail2'] = $request->file('thumbnail2')
                ->store('product-image', 'public');
           

        }
        if ($request->hasFile('image1')) {
            $requestData['image1'] = $request->file('image1')
                ->store('product-image', 'public');
            
        }
        if ($request->hasFile('image2')) {
            $requestData['image2'] = $request->file('image2')
                ->store('product-image', 'public');
            

        }
        if ($request->hasFile('image3')) {
            $requestData['image3'] = $request->file('image3')
                ->store('product-image', 'public');
           

        }
        $product->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'product Record Updated');
        return redirect('admin/product');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('product-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $item = Product::find($id);
        Storage::delete($item->thumbnail1);
        Storage::delete($item->thumbnail2);
        Storage::delete($item->image1);
        Storage::delete($item->image2);
        Storage::delete($item->image3);
        Product::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'product Delete button clicked');
        return redirect('admin/product');
    }
    public function subCategory(Request $request, $id)
    {
        $subCategory = SubCategory::where('category_id', $id)->get();
        return response()->json($subCategory);
    }
    public function miniCategory(Request $request, $id)
    {
        $miniCategory = MiniCategory::where('subcategory_id', $id)->get();
        return response()->json($miniCategory);
    }

}