@extends('layouts.app',['pageTitle' => __(' Category Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Category') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Category') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/category') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('category-edit'))
            <a href="{{ url('/admin/category/' . $category->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('category-delete'))
            <form method="POST" id="deleteButton{{$category->id}}"
                action="{{ url('admin/category' . '/' . $category->id) }}" accept-charset="UTF-8"
                style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$category->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $category->name }} </td>
                        </tr>
                        <tr>
                            <th> Image </th>
                            <td> <img src="{{ Storage::url($category->image)}}" height="50px" width="70px" alt=""> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
