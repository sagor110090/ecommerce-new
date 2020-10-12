@extends('layouts.app',['pageTitle' => __(' Size Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Size') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Size') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/size') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16"
                        data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('size-edit'))
            <a href="{{ url('/admin/size/' . $size->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('size-delete'))
            <form method="POST" id="deleteButton{{$size->id}}" action="{{ url('admin/size' . '/' . $size->id) }}"
                accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$size->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $size->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $size->name }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
