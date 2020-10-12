@extends('layouts.app',['pageTitle' => __(' Blog Add')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Blog') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Blog') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/blog') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16"
                        data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('blog-edit'))
            <a href="{{ url('/admin/blog/' . $blog->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('blog-delete'))
            <form method="POST" id="deleteButton{{$blog->id}}" action="{{ url('admin/blog' . '/' . $blog->id) }}"
                accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$blog->id}})"><i class="feather-16" data-feather="trash-2"></i>
                    {{ __('Delete') }}</button>
            </form>
            @endif
            <br />
            <br />

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $blog->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $blog->name }} </td>
                        </tr>
                        <tr>
                            <th> Content </th>
                            <td> {{ $blog->content }} </td>
                        </tr>
                        <tr>
                            <th> Thumbnail </th>
                            <td><img src="{{ Storage::url($blog->thumbnail) }}" alt=""></td>
                        </tr>
                        <tr>
                            <th> Image </th>
                            <td> <img src="{{ Storage::url($blog->image) }}" alt=""> </td>
                        </tr>
                        <tr>
                            <th> User </th>
                            <td> {{ $blog->user->fname.' '.$blog->user->lname }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection