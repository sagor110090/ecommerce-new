@extends('frontEnd.layouts.app',['pageTitle' => __('Product Details ')])
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
                            <li class="breadcrumb-item"><a href="">shop</a></li>
                            <li class="breadcrumb-item active" aria-current="page">product details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- product details wrapper start -->
<div class="product-details-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-large-slider mb-20 slick-arrow-style_2">
                                <div class="pro-large-img img-zoom">
                                    <img src="{{Storage::url($product->image1)}}" alt="" />
                                </div>
                                <div class="pro-large-img img-zoom">
                                    <img src="{{Storage::url($product->image2)}}" alt="" />
                                </div>
                                <div class="pro-large-img img-zoom">
                                    <img src="{{Storage::url($product->image3)}}" alt="" />
                                </div>

                            </div>
                            <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                <div class="pro-nav-thumb"><img src="{{Storage::url($product->image1)}}" alt="" /></div>
                                <div class="pro-nav-thumb"><img src="{{Storage::url($product->image2)}}" alt="" /></div>
                                <div class="pro-nav-thumb"><img src="{{Storage::url($product->image3)}}" alt="" /></div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details-des mt-md-34 mt-sm-34">
                                <h3><a href="javascript:0;">{{$product->name}}</a></h3>
                                <div class="availability mt-10">
                                    <h5>Availability:</h5>
                                    <span>{{$product->quantity}} in stock</span>
                                </div>
                                <div class="pricebox">
                                    <span class="regular-price"> $ {{$product->sale_price}}</span>
                                    <div class="old-price">
                                        <del> $ {{$product->regular_price}} </del>
                                    </div>
                                </div>
                                <p>{{$product->short_description}}</p>
                                <div class="availability mt-10">
                                    <h5>color :</h5>
                                    <ul>

                                        <span> <b>{{$product->color->name ?? ''}} </b></span>

                                    </ul>
                                </div>
                                <div class="pro-size mb-20 mt-20">
                                    <h5>size :</h5>
                                    <ul>
                                        <li>
                                            <span>{{$product->size->name ?? ''}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <div class="quantity">
                                        <div class="pro-qty"><input class="quantity-value" type="text" value="1"></div>
                                    </div>
                                    <div class="action_link" id="quickViewCartBtn">
                                        <a class="buy-btn" id="add-to-cart{{$product->id}}"
                                            onclick="addtocartquickview(this.id)" data-placement="left"
                                            data-id="{{$product->id}}" data-name="{{$product->name}}"
                                            data-price="{{$product->sale_price}}" data-quantity="1"
                                            data-thumbnail1="{{asset('/').'storage/'.$product->thumbnail1}}"
                                            data-color="{{$product->color->name ?? ''}}"
                                            data-slug="{{$product->slug ?? ''}}"
                                            data-size="{{$product->size->name ?? ''}}" href="javascript:0">add to cart<i
                                                class="fa fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="useful-links mt-20">
                                    <a href="javascript:0;" data-toggle="tooltip" data-placement="top"
                                        onclick="compare({{$product->id}})" title="Compare"><i
                                            class="fa fa-refresh"></i>compare</a>
                                    <a href="javascript:0;" data-toggle="tooltip" id="wishlatestProduct{{$product->id}}"
                                        data-id="{{$product->id}}" onclick="wishlistStore(this.id)" data-placement="top"
                                        title="Wishlist"><i class="fa fa-heart-o"></i>wishlist</a>
                                </div>
                                <div class="share-icon mt-20">
                                    {{-- <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a> --}}
                                    <!-- AddToAny BEGIN -->
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_email"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        <a class="a2a_button_whatsapp"></a>
                                        <a class="a2a_button_telegram"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews mt-34">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tab_three">reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            {!!$product->long_description!!}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab_three">
                                        <form action="{{ url('reviewSave') }}" method="POST" class="review-form">
                                            @csrf
                                            <h5>review for {{$product->name}}</h5>
                                            @foreach ($reviews as $review)
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="{{ asset('frontEnd') }}/assets/img/about/avatar.jpg"
                                                        alt="">
                                                </div>
                                                <div class="review-box">
                                                    <div class="post-author">
                                                        <p><span> {{$review->name}} -</span>
                                                            {{Helper::globalDateTime($review->created_at)}}</p>
                                                    </div>
                                                    <p>{{$review->review}}</p>
                                                </div>

                                            </div>
                                            @endforeach
                                            <input type="hidden" name="product_id" class="form-control"
                                                value="{{$product->id}}">
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control dashed-input-field" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Email</label>
                                                    <input type="email" name="email"
                                                        class="form-control dashed-input-field" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Review</label>
                                                    <textarea class="form-control dashed-input-field" name="review"
                                                        required></textarea>

                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button class="sqr-btn" type="submit">Continue</button>
                                            </div>
                                        </form> <!-- end of review-form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->

                <!-- related products area start -->
                <div class="related-products-area mt-34">
                    <div class="section-title mb-30">
                        <div class="title-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        <h3>related products</h3>
                    </div> <!-- section title end -->
                    <!-- featured category start -->
                    <div class="featured-carousel-active slick-padding slick-arrow-style">
                        <!-- product single item start -->
                        @foreach ($relatedProducts as $relatedProduct)
                        <!-- product single item start -->
                        <div class="product-item fix">
                            <div class="product-thumb">
                                <a href="{{ url('product-details', [$relatedProduct->slug]) }}">
                                    <img src="{{Storage::url($relatedProduct->thumbnail1)}}" class="img-pri" alt="">
                                    <img src="{{Storage::url($relatedProduct->thumbnail1) }}" class="img-sec" alt="">
                                </a>
                                <div class="product-action-link">
                                    <a href="javascript:0;" data-toggle="modal"
                                        id="viewrelatedProduct{{$relatedProduct->id}}" onclick="quick_view(this.id)"
                                        data-id="{{$relatedProduct->id}}" data-slug="{{$relatedProduct->slug ?? ''}}"
                                        data-name="{{$relatedProduct->name}}"
                                        data-price="{{$relatedProduct->sale_price}}"
                                        data-quantity="{{$relatedProduct->quantity}}"
                                        data-short_description="{{$relatedProduct->short_description}}"
                                        data-thumbnail1="{{asset('/').'storage/'.$relatedProduct->thumbnail1}}"
                                        data-thumbnail2="{{asset('/').'storage/'.$relatedProduct->thumbnail2}}"
                                        data-image1="{{asset('/').'storage/'.$relatedProduct->image1}}"
                                        data-image2="{{asset('/').'storage/'.$relatedProduct->image2}}"
                                        data-image3="{{asset('/').'storage/'.$relatedProduct->image3}}"
                                        data-color="{{$relatedProduct->color->name ?? ''}}"
                                        data-size="{{$relatedProduct->size->name ?? ''}}" data-target="#quick_view">
                                        <span data-toggle="tooltip" data-placement="left" title=""><i
                                                class="fa fa-search"></i></span> </a>
                                    <a href="javascript:0;" data-toggle="tooltip"
                                        id="wishlatestProduct{{$relatedProduct->id}}" data-id="{{$relatedProduct->id}}"
                                        onclick="wishlistStore(this.id)" data-placement="left" title=""><i
                                            class="fa fa-heart-o"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip"
                                        onclick="compare({{$relatedProduct->id}})" data-placement="left" title=""><i
                                            class="fa fa-refresh"></i></a>
                                    <a href="javascript:0;" data-toggle="tooltip"
                                        id="add-to-cart{{$relatedProduct->id}}" onclick="addtocart(this.id)"
                                        data-placement="left" data-id="{{$relatedProduct->id}}"
                                        data-name="{{$relatedProduct->name}}"
                                        data-price="{{$relatedProduct->sale_price}}" data-quantity="1"
                                        data-thumbnail1="{{asset('/').'storage/'.$relatedProduct->thumbnail1}}"
                                        data-color="{{$relatedProduct->color->name ?? ''}}"
                                        data-slug="{{$relatedProduct->slug ?? ''}}"
                                        data-size="{{$relatedProduct->size->name ?? ''}}" title=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="product-content">
                                <h4><a
                                        href="{{ url('product-details', [$relatedProduct->slug]) }}">{{$relatedProduct->name}}</a>
                                </h4>
                                <div class="pricebox">
                                    <span class="old-price">$ {{$relatedProduct->regular_price}}</span><br>
                                    <span class="regular-price">$ {{$relatedProduct->sale_price}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- product single item end -->
                        @endforeach

                        <!-- product single item end -->
                    </div>
                    <!-- relatedProduct category end -->
                </div>
                <!-- related products area end -->
            </div>

            <!-- sidebar start -->
            <div class="col-lg-3">
                <div class="shop-sidebar-wrap fix mt-md-22 mt-sm-22">
                    <!-- featured category start -->
                    <div class="sidebar-widget mb-22">
                        <div class="section-title-2 d-flex justify-content-between mb-28">
                            <h3>featured</h3>
                            <div class="category-append"></div>
                        </div> <!-- section title end -->
                        <div class="category-carousel-active row" data-row="6">
                            @foreach ($featureds as $featured)
                            <div class="col">
                                <div class="category-item">
                                    <div class="category-thumb">
                                        <a href="{{ url('product-details', [$featured->slug]) }}">
                                            <img src="{{Storage::url($featured->thumbnail1)}}" class="img-pri" alt="">
                                        </a>
                                    </div>
                                    <div class="category-content">
                                        <h4><a
                                                href="{{ url('product-details', [$featured->slug]) }}">{{$featured->name}}</a>
                                        </h4>

                                        <div class="price-box">
                                            <div class="regular-price">
                                                ${{$featured->regular_price}}
                                            </div>
                                            <div class="old-price">
                                                <del>${{$featured->sale_price}}</del>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end single item -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- featured category end -->
                    <!-- product tag start -->
                    <div class="sidebar-widget mb-22">
                        <div class="sidebar-title mb-20">
                            <h3>tag</h3>
                        </div>
                        <div class="sidebar-widget-body">
                            <div class="product-tag">
                                @foreach ($tags as $tag)
                                <a href="#">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- product tag end -->
                </div>
            </div>
            <!-- sidebar end -->
        </div>
    </div>
</div>
<!-- product details wrapper end -->
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
<script async src="{{ asset('js') }}/page.js"></script>
@endpush
