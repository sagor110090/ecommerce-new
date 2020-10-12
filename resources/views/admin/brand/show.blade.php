@extends('layouts.app',['pageTitle' => __(' Brand Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Brand') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Brand') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/brand') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="eye"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('brand-edit'))
            <a href="{{ url('/admin/brand/' . $brand->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('brand-delete'))
            <form method="POST" id="deleteButton{{$brand->id}}" action="{{ url('admin/brand' . '/' . $brand->id) }}"
                accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$brand->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $brand->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $brand->name }} </td>
                        </tr>
                        <tr>
                            <th> image </th>
                            <td> <img src="{{ Storage::url($item->image)}}" height="50px" width="70px" alt=""> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
