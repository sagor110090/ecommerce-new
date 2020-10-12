<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Helper;
use Illuminate\Http\Request;
use Session;

class CountryController extends Controller
{

     public function index(Request $request)
    {
        if (!Helper::authCheck('country-show')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $country = Country::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $country = Country::latest()->paginate($perPage);
        }
        Helper::activityStore('Show','country  Show All Record');
        return view('admin.country.index', compact('country'));
    }


    public function create()
    {
        if (!Helper::authCheck('country-create')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        Helper::activityStore('Create','country Add New button clicked');
        return view('admin.country.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        Country::create($requestData);
        Session::flash('success','Successfully Saved!');
        Helper::activityStore('Store','country Record Saved');
        return redirect('admin/country');
    }


    public function show($id)
    {
        $country = Country::findOrFail($id);
        Helper::activityStore('Store','country Single Record showed');
        return view('admin.country.show', compact('country'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('country-edit')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        $country = Country::findOrFail($id);
        Helper::activityStore('Edit','country Edit button clicked');
        return view('admin.country.edit', compact('country'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $country = Country::findOrFail($id);
        $country->update($requestData);
        Session::flash('success','Successfully Updated!');
        Helper::activityStore('Update','country Record Updated');
        return redirect('admin/country');
    }


    public function destroy($id)
    {
        if (!Helper::authCheck('country-delete')) { Session::flash('error','Permission Denied!'); return redirect()->back();}
        Country::destroy($id);
        Session::flash('success','Successfully Deleted!');
        Helper::activityStore('Delete','country Delete button clicked');
        return redirect('admin/country');
    }
}
