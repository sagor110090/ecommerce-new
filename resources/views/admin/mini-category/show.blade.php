@extends('layouts.app',['pageTitle' => __(' Mini Category show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Mini Category') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Mini Category') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/mini-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('minicategory-edit'))
            <a href="{{ url('/admin/mini-category/' . $minicategory->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('minicategory-delete'))
            <form method="POST" id="deleteButton{{$minicategory->id}}"
                action="{{ url('admin/mini-category' . '/' . $minicategory->id) }}" accept-charset="UTF-8"
                style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$minicategory->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $minicategory->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $minicategory->name }} </td>
                        </tr>
                        <tr>
                            <th> Sub Category </th>
                            <td> {{ $minicategory->subCategory->name }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
