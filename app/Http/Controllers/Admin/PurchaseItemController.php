<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PurchaseItem;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class PurchaseItemController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('purchaseitem-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $purchaseitem = PurchaseItem::where('product_id', 'LIKE', "%$keyword%")
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
            $purchaseitem = PurchaseItem::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'purchaseitem  Show All Record');
        return view('admin.purchase-item.index', compact('purchaseitem'));
    }

    public function create()
    {
        if (!Helper::authCheck('purchaseitem-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'purchaseitem Add New button clicked');
        return view('admin.purchase-item.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        $requestData = $request->all();
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

        PurchaseItem::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'purchaseitem Record Saved');
        return redirect('admin/purchase-item');
    }

    public function show($id)
    {
        $purchaseitem = PurchaseItem::findOrFail($id);
        Helper::activityStore('Store', 'purchaseitem Single Record showed');
        return view('admin.purchase-item.show', compact('purchaseitem'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('purchaseitem-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $purchaseitem = PurchaseItem::findOrFail($id);
        Helper::activityStore('Edit', 'purchaseitem Edit button clicked');
        return view('admin.purchase-item.edit', compact('purchaseitem'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        $requestData = $request->all();
        if ($request->hasFile('thumbnail1')) {
            $requestData['thumbnail1'] = $request->file('thumbnail1')
                ->store('product-image', 'public');
            Storage::delete($request->oldThumbnail1);
        }
        if ($request->hasFile('thumbnail2')) {
            $requestData['thumbnail2'] = $request->file('thumbnail2')
                ->store('product-image', 'public');
            Storage::delete($request->oldThumbnail2);

        }
        if ($request->hasFile('image1')) {
            $requestData['image1'] = $request->file('image1')
                ->store('product-image', 'public');
            Storage::delete($request->oldImage1);
        }
        if ($request->hasFile('image2')) {
            $requestData['image2'] = $request->file('image2')
                ->store('product-image', 'public');
            Storage::delete($request->oldImage2);

        }
        if ($request->hasFile('image3')) {
            $requestData['image3'] = $request->file('image3')
                ->store('product-image', 'public');
            Storage::delete($request->oldImage3);

        }

        $purchaseitem = PurchaseItem::findOrFail($id);
        $purchaseitem->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'purchaseitem Record Updated');
        return redirect('admin/purchase-item');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('purchaseitem-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $item = PurchaseItem::find($id);
        Storage::delete($item->thumbnail1);
        Storage::delete($item->thumbnail2);
        Storage::delete($item->image1);
        Storage::delete($item->image2);
        Storage::delete($item->image3);

        PurchaseItem::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'purchaseitem Delete button clicked');
        return redirect('admin/purchase-item');
    }
}