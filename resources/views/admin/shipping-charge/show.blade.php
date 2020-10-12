@extends('layouts.app',['pageTitle' => __(' Shipping Charge Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Shipping Charge') }}
    @endslot
@endcomponent
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __(' Shipping Charge') }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/shipping-charge') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
                        @if (Helper::authCheck('shippingcharge-edit'))
                        <a href="{{ url('/admin/shipping-charge/' . $shippingcharge->id . '/edit') }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i> {{ __('Edit') }}</button></a>
                        @endif

                        @if (Helper::authCheck('shippingcharge-delete'))
                        <form method="POST" id="deleteButton{{$shippingcharge->id}}" action="{{ url('admin/shipping-charge' . '/' . $shippingcharge->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="sweetalertDelete({{$shippingcharge->id}})"><i class="feather-16" data-feather="trash-2"></i> {{ __('Delete') }}</button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $shippingcharge->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $shippingcharge->name }} </td></tr><tr><th> Amount </th><td> {{ $shippingcharge->amount }} </td></tr><tr><th> Status </th><td> {{ $shippingcharge->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

@endsection
