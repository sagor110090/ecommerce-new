@extends('layouts.app',['pageTitle' => __(' Type Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Type') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Type') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/type') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16"
                        data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('type-edit'))
            <a href="{{ url('/admin/type/' . $type->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('type-delete'))
            <form method="POST" id="deleteButton{{$type->id}}" action="{{ url('admin/type' . '/' . $type->id) }}"
                accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$type->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $type->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $type->name }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
