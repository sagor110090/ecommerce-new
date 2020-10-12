<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Offer;
use Helper;
use Illuminate\Http\Request;
use Session;

class OfferController extends Controller
{

     public function index(Request $request)
    {
        if (!Helper::authCheck('offer-show')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $offer = Offer::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('ending_date_time', 'LIKE', "%$keyword%")
                ->orWhere('offer_percentage', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $offer = Offer::latest()->paginate($perPage);
        }
        Helper::activityStore('Show','offer  Show All Record');
        return view('admin.offer.index', compact('offer'));
    }


    public function create()
    {
        if (!Helper::authCheck('offer-create')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        Helper::activityStore('Create','offer Add New button clicked');
        return view('admin.offer.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
			'product_id' => 'required',
			'ending_date_time' => 'required',
			'offer_percentage' => 'required'
		]);
        $requestData = $request->all();
        
        Offer::create($requestData);
        Session::flash('success','Successfully Saved!');
        Helper::activityStore('Store','offer Record Saved');
        return redirect('admin/offer');
    }


    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        Helper::activityStore('Store','offer Single Record showed');
        return view('admin.offer.show', compact('offer'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('offer-edit')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        $offer = Offer::findOrFail($id);
        Helper::activityStore('Edit','offer Edit button clicked');
        return view('admin.offer.edit', compact('offer'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'product_id' => 'required',
			'ending_date_time' => 'required',
			'offer_percentage' => 'required'
		]);
        $requestData = $request->all();
        
        $offer = Offer::findOrFail($id);
        $offer->update($requestData);
        Session::flash('success','Successfully Updated!');
        Helper::activityStore('Update','offer Record Updated');
        return redirect('admin/offer');
    }


    public function destroy($id)
    {
        if (!Helper::authCheck('offer-delete')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        Offer::destroy($id);
        Session::flash('success','Successfully Deleted!');
        Helper::activityStore('Delete','offer Delete button clicked');
        return redirect('admin/offer');
    }
}
