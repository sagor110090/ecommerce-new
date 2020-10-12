@extends('frontEnd.layouts.app',['pageTitle' => __('Compare products')])
@section('content')

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">compare</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
<div class="container">
    <section class="cd-products-comparison-table">
        <header>            
            <div class="actions">
                <a href="#0" class="reset">Reset</a>
                <a href="#0" class="filter">Filter</a>
            </div>
        </header>

        <div class="cd-products-table">
            <div class="features">
                <div class="top-info">Image</div>
                <ul class="cd-features-list">
                    <li>Product</li>
                    <li>Sale Price</li>
                    <li>Quantity</li>
                    <li>Color</li>
                    <li>Size</li>
                    <li>Show Detail</li>
                    <li>Delate</li>
                </ul>
            </div> <!-- .features -->

            <div class="cd-products-wrapper">
                <ul class="cd-products-columns">
                    @foreach ($compare as $item)
                        <li class="product">
                            <div class="top-info">
                                <div class="check"></div>
                                <img src=" {{Storage::url($item->product->thumbnail1)}} "
                                    alt="product image">
                            </div> <!-- .top-info -->

                            <ul class="cd-features-list">
                                <li>{{$item->product->name}}</li>
                                <li>${{$item->product->sale_price}}</li>
                                <li>{{$item->product->quantity}}</li>
                                <li>{{$item->product->color->name}}</li>
                                <li>{{$item->product->size->name}}</li>
                                <li><a href="{{ url('product-details', [$item->product->slug]) }}"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i></a></li>
                            </ul>
                        </li> <!-- .product -->
                    @endforeach
                </ul> <!-- .cd-products-columns -->
            </div> <!-- .cd-products-wrapper -->

            <ul class="cd-table-navigation">
                <li><a href="#0" class="prev inactive">&#9668;</a></li>
                <li><a href="#0" class="next">&#9658;</a></li>
            </ul>
        </div> <!-- .cd-products-table -->
    </section>
</div>
@include('frontEnd.layouts.parts.brand')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontEnd') }}/assets/css/compare.css">
@endpush
@push('js')
<script src="{{ asset('frontEnd') }}/assets/js/compare.js"></script>
@endpush