@extends('frontEnd.layouts.app',['pageTitle' => __('All Products ')])
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
                            <li class="breadcrumb-item active" aria-current="page">shop</li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
@php
$banner = Helper::findById('banners', 1);
@endphp
<!-- page wrapper start -->
<div class="page-main-wrapper">
    <div class="container">
        <div class="row">
            <!-- sidebar start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="shop-sidebar-wrap mt-md-28 mt-sm-28">

                    <!-- manufacturer start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>Brand</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <ul>
                                @foreach (Helper::getAll('brands') as $item)
                                <li><i class="fa fa-angle-right"></i><a
                                        href="{{ url('/brand/'.$item->slug) }}">{{$item->name}}</a><span>{{\App\Brand::find($item->id)->product->count() ?? '0'}}</span>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- manufacturer end -->

                    <!-- pricing filter start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>filter by price</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="price-range-wrap">
                                <div class="price-range" data-min="50"
                                    data-max="{{Helper::getAll('products')->max('sale_price')}} "></div>
                                <div class="range-slider">
                                    <form method="GET" action="{{ url('filter') }}"
                                        class="d-flex justify-content-between">
                                        <button class="filter-btn">filter</button>
                                        <div class="price-input d-flex align-items-center">
                                            <label for="amount">Price: </label>
                                            <input type="text" id="amount">
                                            <input type="hidden" name="minPrice" id="minPrice">
                                            <input type="hidden" name="maxPrice" id="maxPrice">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pricing filter end -->
                    <!-- product tag start -->
                    <div class="sidebar-widget mb-30">
                        <div class="sidebar-title mb-10">
                            <h3>type</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="product-tag">
                                @foreach (Helper::getAll('types') as $item)
                                <a href="{{ url('type', [$item->slug]) }}">{{$item->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- product tag end -->

                    <!-- sidebar banner start -->
                    <div class="sidebar-widget mb-30">
                        <div class="img-container fix img-full">
                            <a href="#"><img
                                    src="{{$banner->banner_9 != null ? Storage::url($banner->banner_9) : asset('frontEnd/assets/img/banner/banner_shop.jpg') }}"
                                    alt=""></a>
                        </div>
                    </div>
                    <!-- sidebar banner end -->
                </div>
            </div>
            <!-- sidebar end -->

            <!-- product main wrap start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="shop-banner img-full">
                    <img src="{{$banner->banner_8 != null ? Storage::url($banner->banner_8) : asset('frontEnd/assets/img/banner/banner_static1.jpg') }}"
                        alt="">
                </div>
                <!-- product view wrapper area start -->
                <div class="shop-product-wrapper pt-34">
                    <!-- shop product top wrap start -->
                    <div class="shop-top-bar">
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="top-bar-left">
                                    <div class="product-view-mode mr-70 mr-sm-0">
                                        <a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                        <a href="#" data-target="list"><i class="fa fa-list"></i></a>
                                    </div>
                                    <div class="product-amount">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop product top wrap start -->

                    <div class="shop-product-wrap grid row">
                        @foreach ($products as $product)
                        <!-- product item start -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- product single grid item start -->
                            <div class="product-item fix mb-30">
                                <div class="product-thumb">
                                    <a href="{{ url('product-details', [$product->slug]) }}">
                                        <img src="{{Storage::url($product->thumbnail1)}}" class="img-pri" alt="">
                                        <img src="{{Storage::url($product->thumbnail2) }}" class="img-sec" alt="">
                                    </a>
                                    <div class="product-label">
                                        <span>hot</span>
                                    </div>
                                    <div class="product-action-link">
                                        <a href="javascript:0;" data-toggle="modal" id="viewproduct1{{$product->id}}"
                                            onclick="quick_view(this.id)" data-id="{{$product->id}}"
                                            data-name="{{$product->name}}" data-price="{{$product->sale_price}}"
                                            data-quantity="{{$product->quantity}}"
                                            data-short_description="{{$product->short_description}}"
                                            data-thumbnail1="{{asset('/').'storage/'.$product->thumbnail1}}"
                                            data-thumbnail2="{{asset('/').'storage/'.$product->thumbnail2}}"
                                            data-image1="{{asset('/').'storage/'.$product->image1}}"
                                            data-image2="{{asset('/').'storage/'.$product->image2}}"
                                            data-image3="{{asset('/').'storage/'.$product->image3}}"
                                            data-color="{{$product->color->name ?? ''}}"
                                            data-size="{{$product->size->name ?? ''}}" data-target="#quick_view"> <span
                                                data-toggle="tooltip" data-placement="left" title=""><i
                                                    class="fa fa-search"></i></span> </a>
                                        <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                                            id="wishproduct1{{$product->id}}" data-id="{{$product->id}}"
                                            onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                                        <a href="javascript:0;" data-toggle="tooltip"
                                            onclick="compare({{$product->id}})" data-placement="left" title=""><i
                                                class="fa fa-refresh"></i></a>
                                        <a href="javascript:0;" data-toggle="tooltip"
                                            id="add-to-cartproduct1{{$product->id}}" onclick="addtocart(this.id)"
                                            data-placement="left" data-id="{{$product->id}}"
                                            data-name="{{$product->name}}" data-price="{{$product->sale_price}}"
                                            data-quantity="1"
                                            data-thumbnail1="{{asset('/').'storage/'.$product->thumbnail1}}"
                                            data-color="{{$product->color->name ?? ''}}"
                                            data-slug="{{$product->slug ?? ''}}"
                                            data-size="{{$product->size->name ?? ''}}" title=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4><a href="{{ url('product-details', [$product->slug]) }}">{{$product->name}}</a>
                                    </h4>
                                    <div class="pricebox">
                                        <span class="old-price">${{$product->regular_price}} </span><br>
                                        <span class="regular-price">${{$product->sale_price}} </span>
                                    </div>
                                </div>
                            </div>
                            <!-- product single grid item end -->
                            <!-- product single list item start -->
                            <div class="product-list-item mb-30">
                                <div class="product-thumb">
                                    <a href="{{ url('product-details', [$product->slug]) }}">
                                        <img src="{{Storage::url($product->thumbnail1)}}" class="img-pri" alt="">
                                        <img src="{{Storage::url($product->thumbnail2) }}" class="img-sec" alt="">
                                    </a>
                                    <div class="product-label">
                                        <span>hot</span>
                                    </div>
                                </div>
                                <div class="product-list-content">
                                    <h3><a href="product-details.html">{{$product->name}} </a></h3>
                                    <div class="pricebox">
                                        <span class="old-price">${{$product->regular_price}} </span><br>
                                        <span class="regular-price">${{$product->sale_price}} </span>
                                    </div>
                                    <p>{{$product->short_description}}</p>
                                    <div class="product-list-action-link">
                                        <a href="javascript:0;" data-toggle="modal" id="viewproduct{{$product->id}}"
                                            onclick="quick_view(this.id)" data-id="{{$product->id}}"
                                            data-name="{{$product->name}}" data-price="{{$product->sale_price}}"
                                            data-quantity="{{$product->quantity}}"
                                            data-short_description="{{$product->short_description}}"
                                            data-thumbnail1="{{asset('/').'storage/'.$product->thumbnail1}}"
                                            data-thumbnail2="{{asset('/').'storage/'.$product->thumbnail2}}"
                                            data-image1="{{asset('/').'storage/'.$product->image1}}"
                                            data-image2="{{asset('/').'storage/'.$product->image2}}"
                                            data-image3="{{asset('/').'storage/'.$product->image3}}"
                                            data-color="{{$product->color->name ?? ''}}"
                                            data-size="{{$product->size->name ?? ''}}" data-target="#quick_view"> <span
                                                data-toggle="tooltip" data-placement="left" title=""><i
                                                    class="fa fa-search"></i></span> </a>
                                        <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                                            id="wishproduct{{$product->id}}" data-id="{{$product->id}}"
                                            onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                                        <a href="javascript:0;" data-toggle="tooltip"
                                            onclick="compare({{$product->id}})" data-placement="left" title=""><i
                                                class="fa fa-refresh"></i></a>
                                        <a href="javascript:0;" data-toggle="tooltip"
                                            id="add-to-cartproduct{{$product->id}}" onclick="addtocart(this.id)"
                                            data-placement="left" data-id="{{$product->id}}"
                                            data-name="{{$product->name}}" data-price="{{$product->sale_price}}"
                                            data-quantity="1"
                                            data-thumbnail1="{{asset('/').'storage/'.$product->thumbnail1}}"
                                            data-color="{{$product->color->name ?? ''}}"
                                            data-slug="{{$product->slug ?? ''}}"
                                            data-size="{{$product->size->name ?? ''}}" title=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- product single list item start -->
                        </div> <!-- product single column end -->
                        @endforeach

                    </div>
                    <!-- product item end -->
                </div>
                <!-- product view wrapper area end -->

                <!-- start pagination area -->
                {{ $products->links('vendor.pagination.frontend') }}

                <!-- end pagination area -->


            </div>
            <!-- product main wrap end -->
        </div>
    </div>
</div>
<!-- page wrapper end -->

@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush
