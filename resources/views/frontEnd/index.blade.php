@extends('frontEnd.layouts.app',['pageTitle' => __('Welcome ')])
@section('content')
<!-- header area end -->
<!-- hero slider start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="slider-wrapper-area">
                <div class="hero-slider-active hero__1 slick-dot-style hero-dot">
                    @foreach ($sliders as $slider)
                    <div class="single-slider"
                        style="background-image: url({{Storage::url($slider->slider_background)}});">
                        <div class="container p-0">
                            <div class="slider-main-content">
                                <div class="slider-content-img">
                                    <img src="{{Storage::url($slider->slider_lable1)}}" alt="">
                                    <img src="{{Storage::url($slider->slider_lable2)}}" alt="">
                                    <img src="{{Storage::url($slider->slider_lable3)}}" alt="">
                                </div>
                                <div class="slider-text">
                                    <div class="slider-label">
                                        <img src="{{Storage::url($slider->slider_lable4)}}" alt="">
                                    </div>
                                    <h1>{{$slider->header}}</h1>
                                    <p>{{$slider->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- hero slider end -->

<!-- home banner area start -->
<div class="banner-area mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 order-1">
                <div class="img-container img-full fix imgs-res mb-sm-30">
                    <a href="#">
                        @php
                        $banner = Helper::findById('banners', 1);
                        @endphp
                        <img src="{{$banner->banner_1 != null ? Storage::url($banner->banner_1) : asset('frontEnd/assets/img/banner/banner_left.jpg') }} "
                            alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 order-sm-3">
                <div class="img-container img-full fix mb-30">
                    <a href="#">
                        <img src="{{ $banner->banner_3 != null ? Storage::url($banner->banner_3) : asset('frontEndassets/img/banner/banner_static_top1.jpg') }}"
                            alt="">
                    </a>
                </div>
                <div class="img-container img-full fix mb-30">
                    <a href="#">
                        <img src="{{$banner->banner_4 != null ? Storage::url($banner->banner_4) : asset('frontEnd/assets/img/banner/banner_static_top2.jpg') }}"
                            alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 order-2 order-md-3">
                <div class="img-container img-full fix">
                    <a href="#">
                        <img src="{{$banner->banner_2 != null ? Storage::url($banner->banner_2) : asset('frontEnd/assets/img/banner/banner_static_top3.jpg') }}"
                            alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- home banner area end -->

<!-- page wrapper start -->
<div class="page-wrapper pt-6 pb-28 pb-md-6 pb-sm-6 pt-xs-36">
    <div class="container">
        <div class="row">
            <!-- start home sidebar -->
            <div class="col-lg-3">
                <div class="home-sidebar">
                    <!-- hot deals area start -->
                    <div class="main-sidebar hot-deals-wrap mb-30">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>hot deals</h3>
                            <div class="slick-append"></div>
                        </div> <!-- section title end -->
                        <div class="deals-carousel-active slick-padding slick-arrow-style">
                            @foreach ($hotDeals as $hotDeal)
                            <!-- product single item start -->
                            <div class="product-item fix">
                                <div class="product-thumb">
                                    <a href="product-details.html">
                                        <a href="{{ url('product-details', [$hotDeal->slug]) }}">
                                            <img src="{{Storage::url($hotDeal->thumbnail1)}}" class="img-pri" alt="">
                                            <img src="{{Storage::url($hotDeal->thumbnail2) }}" class="img-sec" alt="">
                                        </a>
                                    </a>
                                    <div class="product-label">
                                        <span>hot</span>
                                    </div>
                                    <div class="product-action-link">
                                        <a href="javascript:0;" data-toggle="modal" id="viewhotDeal{{$hotDeal->id}}"
                                            onclick="quick_view(this.id)" data-id="{{$hotDeal->id}}"
                                            data-name="{{$hotDeal->name}}" data-price="{{$hotDeal->sale_price}}"
                                            data-quantity="{{$hotDeal->quantity}}"
                                            data-short_description="{{$hotDeal->short_description}}"
                                            data-thumbnail1="{{asset('/').'storage/'.$hotDeal->thumbnail1}}"
                                            data-thumbnail2="{{asset('/').'storage/'.$hotDeal->thumbnail2}}"
                                            data-image1="{{asset('/').'storage/'.$hotDeal->image1}}"
                                            data-image2="{{asset('/').'storage/'.$hotDeal->image2}}"
                                            data-image3="{{asset('/').'storage/'.$hotDeal->image3}}"
                                            data-color="{{$hotDeal->color->name ?? ''}}"
                                            data-size="{{$hotDeal->size->name ?? ''}}" data-target="#quick_view"> <span
                                                data-toggle="tooltip" data-placement="left" title=""><i
                                                    class="fa fa-search"></i></span> </a>
                                        <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                                            id="wishhotDeal{{$hotDeal->id}}" data-id="{{$hotDeal->id}}"
                                            onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                                        <a href="javascript:0;" onclick="compare({{$hotDeal->id}})"
                                            data-toggle="tooltip" data-placement="left" title=""><i
                                                class="fa fa-refresh"></i></a>
                                        <a href="javascript:0;" data-toggle="tooltip"
                                            id="add-to-carthotDeal{{$hotDeal->id}}" onclick="addtocart(this.id)"
                                            data-placement="left" data-id="{{$hotDeal->id}}"
                                            data-slug="{{$hotDeal->slug ?? ''}}" data-name="{{$hotDeal->name}}"
                                            data-price="{{$hotDeal->sale_price}}" data-quantity="1"
                                            data-thumbnail1="{{asset('/').'storage/'.$hotDeal->thumbnail1}}"
                                            data-color="{{$hotDeal->color->name ?? ''}}"
                                            data-size="{{$hotDeal->size->name ?? ''}}"
                                            data-slug="{{$hotDeal->slug ?? ''}}" title=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4><a href="{{ url('product-details', [$hotDeal->slug]) }}">{{$hotDeal->name}}</a>
                                    </h4>
                                    <div class="pricebox">
                                        <span class="old-price">${{$hotDeal->regular_price}} </span><br>
                                        <span class="regular-price">${{$hotDeal->sale_price}} </span>
                                    </div>
                                </div>
                            </div>
                            <!-- product single item end -->

                            @endforeach

                        </div>
                    </div>
                    <!-- hot deals area end -->

                    <!-- best seller area start -->
                    <div class="main-sidebar category-wrapper mb-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>best seller</h3>
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="4">
                            @foreach ($bestSellers as $bestSeller)
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="{{ url('product-details', [$bestSeller->slug]) }}">
                                            <img src="{{Storage::url($bestSeller->thumbnail1)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a
                                                href="{{ url('product-details', [$bestSeller->slug]) }}">{{$bestSeller->name}}</a>
                                        </h4>
                                        <div class="price-box">
                                            <div class="regular-price">
                                                ${{$bestSeller->sale_price}}
                                            </div>
                                            <div class="old-price">
                                                <del>${{$bestSeller->regular_price}} </del>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div> <!-- end single item column -->
                            @endforeach

                        </div>
                    </div>
                    <!-- best seller area end -->

                    <!-- blog area start -->
                    <div class="main-sidebar blog-area mb-24">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>latest blog</h3>
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <!-- blog wrapper start -->
                        <div class="blog-carousel-active">
                            @foreach ($blog as $item)
                            <div class="blog-item">
                                <div class="blog-thumb img-full fix">
                                    <a href="{{url('blog/'.$item->slug)}}">
                                        <img src=" {{Storage::url($item->thumbnail)}} " alt="">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <h3><a href="{{url('blog/'.$item->slug)}}">{{$item->name}}</a></h3>
                                    <div class="blog-meta">
                                        <span class="posted-author">by:
                                            {{ $item->user->fname.' '.$item->user->lname }}</span>
                                        <span class="post-date">{{ Helper::globalDateTime($item->created_at) }}</span>
                                    </div>
                                    <p>{{ Helper::limit_text($item->content, 40) }}</p>
                                </div>
                                <a href="{{url('blog/'.$item->slug)}}">read more <i
                                        class="fa fa-long-arrow-right"></i></a>
                            </div> <!-- end single blog item -->
                            @endforeach
                        </div>
                        <!-- blog wrapper end -->
                    </div>
                    <!-- blog area end -->
                </div>
            </div>
            <!-- end home sidebar -->

            <div class="col-lg-9">
                <!-- featured category area start -->
                <div class="feature-category-area mt-md-70">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <h3>ordinary product</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        @foreach ($featureds as $featured)
                        <!-- product single item start -->
                        <div class="product-item fix">
                            <div class="product-thumb">
                                <a href="{{ url('product-details', [$featured->slug]) }}">
                                    <img src="{{Storage::url($featured->thumbnail1)}}" class="img-pri" alt="">
                                    <img src="{{Storage::url($featured->thumbnail2) }}" class="img-sec" alt="">
                                </a>
                                <div class="product-action-link">
                                    <a href="javascript:0;" data-toggle="modal" id="viewfeatured{{$featured->id}}"
                                        onclick="quick_view(this.id)" data-id="{{$featured->id}}"
                                        data-slug="{{$featured->slug ?? ''}}" data-name="{{$featured->name}}"
                                        data-price="{{$featured->sale_price}}" data-quantity="{{$featured->quantity}}"
                                        data-short_description="{{$featured->short_description}}"
                                        data-thumbnail1="{{asset('/').'storage/'.$featured->thumbnail1}}"
                                        data-thumbnail2="{{asset('/').'storage/'.$featured->thumbnail2}}"
                                        data-image1="{{asset('/').'storage/'.$featured->image1}}"
                                        data-image2="{{asset('/').'storage/'.$featured->image2}}"
                                        data-image3="{{asset('/').'storage/'.$featured->image3}}"
                                        data-color="{{$featured->color->name ?? ''}}"
                                        data-size="{{$featured->size->name ?? ''}}" data-target="#quick_view"> <span
                                            data-toggle="tooltip" data-placement="left" title=""><i
                                                class="fa fa-search"></i></span> </a>
                                    <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                                        id="wishfeatured{{$featured->id}}" data-id="{{$featured->id}}"
                                        onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip" onclick="compare({{$featured->id}})"
                                        data-placement="left" title=""><i class="fa fa-refresh"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip"
                                        id="add-to-cartfeatured{{$featured->id}}" onclick="addtocart(this.id)"
                                        data-placement="left" data-id="{{$featured->id}}"
                                        data-name="{{$featured->name}}" data-price="{{$featured->sale_price}}"
                                        data-quantity="1" data-slug="{{$featured->slug ?? ''}}"
                                        data-thumbnail1="{{asset('/').'storage/'.$featured->thumbnail1}}"
                                        data-color="{{$featured->color->name ?? ''}}"
                                        data-size="{{$featured->size->name ?? ''}}" title=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a href="{{ url('product-details', [$featured->slug]) }}">{{$featured->name}}</a>
                                </h4>
                                <div class="pricebox">
                                    <span class="old-price">${{$featured->regular_price}} </span><br>
                                    <span class="regular-price">${{$featured->sale_price}} </span>
                                </div>
                            </div>
                        </div>
                        <!-- product single item end -->
                        @endforeach
                    </div>
                    <!-- featured category end -->
                </div>
                <!-- featured category area end -->

                <!-- banner statistic start -->
                <div class="banner-statistic pt-28 pb-36">
                    <div class="img-container fix img-full">
                        <a href="#">
                            <img src="{{ $banner->banner_5 != null ? Storage::url($banner->banner_5) : asset('frontEnd/assets/img/banner/banner_static1.jpg') }}"
                                alt="">
                        </a>
                    </div>
                </div>
                <!-- banner statistic end -->

                <!-- featured category area start -->
                <div class="feature-category-area">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-flask"></i>
                        </div>
                        <h3>New Arrivals</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        @foreach ($newArrivals as $newArrival)
                        <!-- product single item start -->
                        <div class="product-item fix">
                            <div class="product-thumb">
                                <a href="{{ url('product-details', [$newArrival->slug]) }}">
                                    <img src="{{Storage::url($newArrival->thumbnail1)}}" class="img-pri" alt="">
                                    <img src="{{Storage::url($newArrival->thumbnail2) }}" class="img-sec" alt="">
                                </a>
                                <div class="product-action-link">
                                    <a href="javascript:0;" data-toggle="modal" id="viewnewArrival{{$newArrival->id}}"
                                        onclick="quick_view(this.id)" data-id="{{$newArrival->id}}"
                                        data-name="{{$newArrival->name}}" data-price="{{$newArrival->sale_price}}"
                                        data-slug="{{$newArrival->slug ?? ''}}"
                                        data-quantity="{{$newArrival->quantity}}"
                                        data-short_description="{{$newArrival->short_description}}"
                                        data-thumbnail1="{{asset('/').'storage/'.$newArrival->thumbnail1}}"
                                        data-thumbnail2="{{asset('/').'storage/'.$newArrival->thumbnail2}}"
                                        data-image1="{{asset('/').'storage/'.$newArrival->image1}}"
                                        data-image2="{{asset('/').'storage/'.$newArrival->image2}}"
                                        data-image3="{{asset('/').'storage/'.$newArrival->image3}}"
                                        data-color="{{$newArrival->color->name ?? ''}}"
                                        data-size="{{$newArrival->size->name ?? ''}}" data-target="#quick_view"> <span
                                            data-toggle="tooltip" data-placement="left" title=""><i
                                                class="fa fa-search"></i></span> </a>
                                    <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                                        id="wishnewArrival{{$newArrival->id}}" data-id="{{$newArrival->id}}"
                                        onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip" onclick="compare({{$newArrival->id}})"
                                        data-placement="left" title=""><i class="fa fa-refresh"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip"
                                        id="add-to-cartnewArrival{{$newArrival->id}}" onclick="addtocart(this.id)"
                                        data-placement="left" data-slug="{{$newArrival->slug ?? ''}}"
                                        data-id="{{$newArrival->id}}" data-name="{{$newArrival->name}}"
                                        data-price="{{$newArrival->sale_price}}" data-quantity="1"
                                        data-thumbnail1="{{asset('/').'storage/'.$newArrival->thumbnail1}}"
                                        data-color="{{$newArrival->color->name ?? ''}}"
                                        data-size="{{$newArrival->size->name ?? ''}}" title=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a
                                        href="{{ url('product-details', [$newArrival->slug]) }}">{{$newArrival->name}}</a>
                                </h4>
                                <div class="pricebox">
                                    <span class="old-price">${{$newArrival->regular_price}} </span><br>
                                    <span class="regular-price">${{$newArrival->sale_price}} </span>
                                </div>
                            </div>
                        </div>
                        <!-- product single item end -->
                        @endforeach
                    </div>
                    <!-- newArrival category end -->
                </div>
                <!-- newArrival category area end -->

                <!-- banner statistic start -->
                <div class="banner-statistic pt-28 pb-30 pb-sm-0">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="img-container fix img-full mb-sm-30">
                                <a href="#">
                                    <img src="{{ $banner->banner_6 != null ? Storage::url($banner->banner_6) : asset('frontEnd/assets/img/banner/banner_static2.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5">
                            <div class="img-container fix img-full mb-sm-30">
                                <a href="#">
                                    <img src="{{ $banner->banner_7 != null ? Storage::url($banner->banner_7) : asset('frontEnd/assets/img/banner/banner_static3.jpg') }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- banner statistic end -->

                <!-- category features area start -->
                <div class="category-feature-area">
                    <div class="row">
                        <!-- New Products area start -->
                        <div class="col-lg-4">
                            <div class="category-wrapper mb-md-24 mb-sm-24">
                                <div class="section-title-2 d-flex justify-content-between mb-28">
                                    <h3>New Products</h3>
                                    <div class="category-append"></div>
                                </div> <!-- section title end -->
                                <div class="category-carousel-active row" data-row="4">
                                    @foreach ($newProducts as $newProduct)
                                    <div class="col">
                                        <div class="category-item">
                                            <div class="category-thumb">
                                                <a href="{{ url('product-details', [$newProduct->slug]) }}">
                                                    <img src="{{Storage::url($newProduct->thumbnail1)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="category-content">
                                                <h4><a
                                                        href="{{ url('product-details', [$newProduct->slug]) }}">{{$newProduct->name}}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <div class="regular-price">
                                                        ${{$newProduct->sale_price}}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>${{$newProduct->regular_price}} </del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end single item -->
                                    </div>
                                    @endforeach
                                    <!-- end single item column -->
                                </div>
                            </div>
                        </div>
                        <!-- New Products area end -->
                        <!-- Most viewed area start -->
                        <div class="col-lg-4">
                            <div class="category-wrapper mb-md-24 mb-sm-24">
                                <div class="section-title-2 d-flex justify-content-between mb-28">
                                    <h3>Most viewed</h3>
                                    <div class="category-append"></div>
                                </div> <!-- section title end -->
                                <div class="category-carousel-active row" data-row="4">
                                    @foreach ($mostViewed as $mostViewed)
                                    <div class="col">
                                        <div class="category-item">
                                            <div class="category-thumb">
                                                <a href="{{ url('product-details', [$mostViewed->slug]) }}">
                                                    <img src="{{Storage::url($mostViewed->thumbnail1)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="category-content">
                                                <h4><a
                                                        href="{{ url('product-details', [$mostViewed->slug]) }}">{{$mostViewed->name}}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <div class="regular-price">
                                                        ${{$mostViewed->sale_price}}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>${{$mostViewed->regular_price}} </del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end single item -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Most viewed area end -->
                        <!-- Most viewed area start -->
                        <div class="col-lg-4">
                            {{-- <table style="border:0px;">
                                <tr>
                                    <td style="width:60px;text-align:center;">Days</td>
                                    <td style="width:70px;text-align:center;">Hours</td>
                                    <td style="width:60px;text-align:center;">Minutes</td>
                                    <td style="width:70px;text-align:center;">Seconds</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><span id="given_date"></span></td>
                                </tr>
                            </table> --}}
                            <div class="category-wrapper mb-md-24 mb-sm-24">
                                <div class="section-title-2 d-flex justify-content-between mb-28">
                                    <h3>hot sale</h3>
                                    <div class="category-append"></div>
                                </div> <!-- section title end -->
                                <div class="category-carousel-active row" data-row="4">
                                    @foreach ($hotSales as $hotSales)
                                    <div class="col">
                                        <div class="category-item">
                                            <div class="category-thumb">
                                                <a href="{{ url('product-details', [$hotSales->slug]) }}">
                                                    <img src="{{Storage::url($hotSales->thumbnail1)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="category-content">
                                                <h4><a
                                                        href="{{ url('product-details', [$hotSales->slug]) }}">{{$hotSales->name}}</a>
                                                </h4>
                                                <div class="price-box">
                                                    <div class="regular-price">
                                                        ${{$hotSales->sale_price}}
                                                    </div>
                                                    <div class="old-price">
                                                        <del>${{$hotSales->regular_price}} </del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end single item -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Most viewed area end -->
                    </div>
                </div>
                <!-- category features area end -->
            </div>
        </div>
    </div>
</div>
<!-- page wrapper end -->

<!-- latest product start -->
<div class="latest-product">
    <div class="container">
        <div class="section-title mb-30">
            <div class="title-icon">
                <i class="fa fa-flash"></i>
            </div>
            <h3>latest product</h3>
        </div> <!-- section title end -->
        <!-- featured category start -->
        <div class="latest-product-active slick-padding slick-arrow-style">
            @foreach ($latestProducts as $latestProduct)
            <!-- product single item start -->
            <div class="product-item fix">
                <div class="product-thumb">
                    <a href="{{ url('product-details', [$latestProduct->slug]) }}">
                        <img src="{{Storage::url($latestProduct->thumbnail1)}}" class="img-pri" alt="">
                        <img src="{{Storage::url($latestProduct->thumbnail2) }}" class="img-sec" alt="">
                    </a>
                    <div class="product-action-link">
                        <a href="javascript:0;" data-toggle="modal" id="viewlatestProduct{{$latestProduct->id}}"
                            onclick="quick_view(this.id)" data-id="{{$latestProduct->id}}"
                            data-name="{{$latestProduct->name}}" data-price="{{$latestProduct->sale_price}}"
                            data-quantity="{{$latestProduct->quantity}}" data-slug="{{$latestProduct->slug}}"
                            data-short_description="{{$latestProduct->short_description}}"
                            data-thumbnail1="{{asset('/').'storage/'.$latestProduct->thumbnail1}}"
                            data-thumbnail2="{{asset('/').'storage/'.$latestProduct->thumbnail2}}"
                            data-image1="{{asset('/').'storage/'.$latestProduct->image1}}"
                            data-image2="{{asset('/').'storage/'.$latestProduct->image2}}"
                            data-image3="{{asset('/').'storage/'.$latestProduct->image3}}"
                            data-color="{{$latestProduct->color->name ?? ''}}"
                            data-size="{{$latestProduct->size->name ?? ''}}" data-target="#quick_view"> <span
                                data-toggle="tooltip" data-placement="left" title=""><i class="fa fa-search"></i></span>
                        </a>
                        <a href="javascript:0;" data-toggle="tooltip" data-placement="left"
                            id="wishlatestProduct{{$latestProduct->id}}" data-id="{{$latestProduct->id}}"
                            onclick="wishlistStore(this.id)" title=""><i class="fa fa-heart-o"></i></a>
                        <a href="javascript:0;" data-toggle="tooltip" onclick="compare({{$newArrival->id}})"
                            data-placement="left" title=""><i class="fa fa-refresh"></i></a>
                        <a href="javascript:0;" data-toggle="tooltip"
                            id="add-to-cartlatestProduct{{$latestProduct->id}}" onclick="addtocart(this.id)"
                            data-placement="left" data-id="{{$latestProduct->id}}" data-name="{{$latestProduct->name}}"
                            data-slug="{{$latestProduct->slug ?? ''}}" data-price="{{$latestProduct->sale_price}}"
                            data-quantity="1" data-thumbnail1="{{asset('/').'storage/'.$latestProduct->thumbnail1}}"
                            data-color="{{$latestProduct->color->name ?? ''}}"
                            data-size="{{$latestProduct->size->name ?? ''}}" title=""><i
                                class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="{{ url('product-details', [$latestProduct->slug]) }}">{{$latestProduct->name}}</a></h4>
                    <div class="pricebox">
                        <span class="old-price">${{$latestProduct->regular_price}} </span><br>
                        <span class="regular-price">${{$latestProduct->sale_price}} </span>
                    </div>
                </div>
            </div>
            <!-- product single item end -->
            @endforeach
        </div>
        <!-- featured category end -->
    </div>
    <span id="given_date"></span>
</div>
<!-- latest product end -->

@include('frontEnd.layouts.parts.brand')
@endsection

@push('js')
<script src="{{ asset('js/jquery.countdownTimer.min.js') }}"></script>
<script>
    $(function () {
        $("#given_date").countdowntimer({
            startDate: "2014/10/01 00:00:00"‚ //set server date and time as "<?php echo date('Y/m/d H:i:s'); ?>".
            dateAndTime: "2018/01/01 00:00:00"‚ //end date
            size: "lg"
        });
    });

</script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('css/jquery.countdownTimer.css') }}">
@endpush
