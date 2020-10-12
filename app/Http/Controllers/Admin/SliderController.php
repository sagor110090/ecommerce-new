<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class SliderController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('slider-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $slider = Slider::where('slider_background', 'LIKE', "%$keyword%")
                ->orWhere('slider_lable1', 'LIKE', "%$keyword%")
                ->orWhere('slider_lable2', 'LIKE', "%$keyword%")
                ->orWhere('slider_lable3', 'LIKE', "%$keyword%")
                ->orWhere('slider_lable4', 'LIKE', "%$keyword%")
                ->orWhere('header', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $slider = Slider::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'slider  Show All Record');
        return view('admin.slider.index', compact('slider'));
    }

    public function create()
    {
        if (!Helper::authCheck('slider-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'slider Add New button clicked');
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'slider_background' => 'required',
            'slider_lable1' => 'required',
            'slider_lable2' => 'required',
            'slider_lable3' => 'required',
            'slider_lable4' => 'required',
        ]);
        $requestData = $request->all();
        if ($request->hasFile('slider_background')) {
            $requestData['slider_background'] = $request->file('slider_background')
                ->store('slider', 'public');
        }
        if ($request->hasFile('slider_lable1')) {
            $requestData['slider_lable1'] = $request->file('slider_lable1')
                ->store('slider', 'public');
        }
        if ($request->hasFile('slider_lable2')) {
            $requestData['slider_lable2'] = $request->file('slider_lable2')
                ->store('slider', 'public');
        }
        if ($request->hasFile('slider_lable3')) {
            $requestData['slider_lable3'] = $request->file('slider_lable3')
                ->store('slider', 'public');
        }
        if ($request->hasFile('slider_lable4')) {
            $requestData['slider_lable4'] = $request->file('slider_lable4')
                ->store('slider', 'public');
        }

        Slider::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'slider Record Saved');
        return redirect('admin/slider');
    }

    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        Helper::activityStore('Store', 'slider Single Record showed');
        return view('admin.slider.show', compact('slider'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('slider-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $slider = Slider::findOrFail($id);
        Helper::activityStore('Edit', 'slider Edit button clicked');
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'slider_background' => 'required',
            // 'slider_lable1' => 'required',
            // 'slider_lable2' => 'required',
            // 'slider_lable3' => 'required',
            // 'slider_lable4' => 'required'
        ]);
        $requestData = $request->all();
        $slider = Slider::findOrFail($id);
        if ($request->hasFile('slider_background')) {
            $requestData['slider_background'] = $request->file('slider_background')
                ->store('slider', 'public');
            Storage::delete($slider->slider_background);
        }
        if ($request->hasFile('slider_lable1')) {
            $requestData['slider_lable1'] = $request->file('slider_lable1')
                ->store('slider', 'public');
            Storage::delete($slider->slider_lable1);
        }
        if ($request->hasFile('slider_lable2')) {
            $requestData['slider_lable2'] = $request->file('slider_lable2')
                ->store('slider', 'public');
            Storage::delete($slider->slider_lable2);
        }
        if ($request->hasFile('slider_lable3')) {
            $requestData['slider_lable3'] = $request->file('slider_lable3')
                ->store('slider', 'public');
            Storage::delete($slider->slider_lable3);
        }
        if ($request->hasFile('slider_lable4')) {
            $requestData['slider_lable4'] = $request->file('slider_lable4')
                ->store('slider', 'public');
            Storage::delete($slider->slider_lable4);
        }

        $slider->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'slider Record Updated');
        return redirect('admin/slider');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('slider-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $slider = Slider::find($id);
        Storage::delete($slider->slider_background);
        Storage::delete($slider->slider_lable1);
        Storage::delete($slider->slider_lable2);
        Storage::delete($slider->slider_lable3);
        Storage::delete($slider->slider_lable4);

        Slider::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'slider Delete button clicked');
        return redirect('admin/slider');
    }
}
