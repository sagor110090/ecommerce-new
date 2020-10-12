<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Type;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

class TypeController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('type-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $type = Type::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $type = Type::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'type  Show All Record');
        return view('admin.type.index', compact('type'));
    }

    public function create()
    {
        if (!Helper::authCheck('type-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'type Add New button clicked');
        return view('admin.type.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:types',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);

        Type::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'type Record Saved');
        return redirect('admin/type');
    }

    public function show($id)
    {
        $type = Type::findOrFail($id);
        Helper::activityStore('Store', 'type Single Record showed');
        return view('admin.type.show', compact('type'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('type-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $type = Type::findOrFail($id);
        Helper::activityStore('Edit', 'type Edit button clicked');
        return view('admin.type.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        $type = Type::findOrFail($id);
        $type->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'type Record Updated');
        return redirect('admin/type');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('type-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Type::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'type Delete button clicked');
        return redirect('admin/type');
    }
}