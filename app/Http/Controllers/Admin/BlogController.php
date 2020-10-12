<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Session;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        if (!Helper::authCheck('blog-show')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $blog = Blog::where('name', 'LIKE', "%$keyword%")
                ->orWhere('content', 'LIKE', "%$keyword%")
                ->orWhere('thumbnail', 'LIKE', "%$keyword%")
                ->orWhere('image', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $blog = Blog::latest()->paginate($perPage);
        }
        Helper::activityStore('Show', 'blog  Show All Record');
        return view('admin.blog.index', compact('blog'));
    }

    public function create()
    {
        if (!Helper::authCheck('blog-create')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Helper::activityStore('Create', 'blog Add New button clicked');
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'image' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['user_id'] = Auth::user()->id;
        $requestData['slug'] = Str::slug($request->name);
        if ($request->hasFile('thumbnail')) {
            $requestData['thumbnail'] = $request->file('thumbnail')
                ->store('uploads', 'public');
        }
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('uploads', 'public');
        }

        Blog::create($requestData);
        Session::flash('success', 'Successfully Saved!');
        Helper::activityStore('Store', 'blog Record Saved');
        return redirect('admin/blog');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        Helper::activityStore('Store', 'blog Single Record showed');
        return view('admin.blog.show', compact('blog'));
    }

    public function edit($id)
    {
        if (!Helper::authCheck('blog-edit')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        $blog = Blog::findOrFail($id);
        Helper::activityStore('Edit', 'blog Edit button clicked');
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
        ]);
        $requestData = $request->all();
        $requestData['slug'] = Str::slug($request->name);
        $requestData['user_id'] = Auth::user()->id;
        if ($request->hasFile('thumbnail')) {
            $requestData['thumbnail'] = $request->file('thumbnail')
                ->store('uploads', 'public');
        }
        if ($request->hasFile('image')) {
            $requestData['image'] = $request->file('image')
                ->store('uploads', 'public');
        }

        $blog = Blog::findOrFail($id);
        $blog->update($requestData);
        Session::flash('success', 'Successfully Updated!');
        Helper::activityStore('Update', 'blog Record Updated');
        return redirect('admin/blog');
    }

    public function destroy($id)
    {
        if (!Helper::authCheck('blog-delete')) {Session::flash('error', 'Permission Denied!');return redirect()->back();}
        Blog::destroy($id);
        Session::flash('success', 'Successfully Deleted!');
        Helper::activityStore('Delete', 'blog Delete button clicked');
        return redirect('admin/blog');
    }
}