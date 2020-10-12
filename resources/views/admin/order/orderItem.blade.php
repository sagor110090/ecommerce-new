@extends('layouts.app',['pageTitle' => __('Order Items')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Order Items') }}
    @endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Order Items List #'.$id) }}</h6>

        <div class="card-body">
            <a href="javascript:history.back()" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
            </button></a>

            <br/>
            <br/>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover"  style="width:100%;">
                    <thead>
                        <tr>
                            <th  width='30'>#</th>
                            <th>Product Name</th>
                            <th>Product SKU</th>
                            <th> Quantity</th>
                            <th> price</th>
                            {{-- <th width='300'>{{ __('Actions') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItem as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td> 
                            <td>{{ $item->product->sku }}</td> 
                            <td>{{ $item->product_quantity }}</td>
                            <td>${{ $item->product_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>

        </div>
    </div>
</div>

@endsection