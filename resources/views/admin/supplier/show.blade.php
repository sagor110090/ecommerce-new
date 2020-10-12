@extends('layouts.app',['pageTitle' => __(' Supplier Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Supplier') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Supplier') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/supplier') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('supplier-edit'))
            <a href="{{ url('/admin/supplier/' . $supplier->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('supplier-delete'))
            <form method="POST" id="deleteButton{{$supplier->id}}"
                action="{{ url('admin/supplier' . '/' . $supplier->id) }}" accept-charset="UTF-8"
                style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$supplier->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $supplier->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $supplier->name }} </td>
                        </tr>
                        <tr>
                            <th> Address </th>
                            <td> {{ $supplier->address }} </td>
                        </tr>
                        <tr>
                            <th> Phone Number </th>
                            <td> {{ $supplier->phone_number }} </td>
                        </tr>
                        <tr>
                            <th> Total Paid Amount </th>
                            <td> {{ $supplier->total_paid_amount }} </td>
                        </tr>
                        <tr>
                            <th> Total Paid Due </th>
                            <td> {{ $supplier->total_paid_due }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
