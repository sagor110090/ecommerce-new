@extends('layouts.app',['pageTitle' => __(' Sub Category Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Sub Category') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Sub Category') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/sub-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('subcategory-edit'))
            <a href="{{ url('/admin/sub-category/' . $subcategory->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('subcategory-delete'))
            <form method="POST" id="deleteButton{{$subcategory->id}}"
                action="{{ url('admin/sub-category' . '/' . $subcategory->id) }}" accept-charset="UTF-8"
                style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$subcategory->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $subcategory->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $subcategory->name }} </td>
                        </tr>
                        <tr>
                            <th> Image </th>
                            <td> <img src="{{ Storage::url($subcategory->image)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Category </th>
                            <td> {{ $subcategory->category->name }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
