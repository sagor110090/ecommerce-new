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
                            <li class="breadcrumb-item active" aria-current="page">blog</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

        <!-- blog main wrapper start -->
        <div class="blog-main-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-wrapper-inner">
                            <div class="row">
                                <!-- start single blog item -->
                                @foreach ($blog as $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="blog-item mb-26">
                                        <div class="blog-thumb img-full fix">
                                            <a href=" {{url('blog/'.$item->slug)}} ">
                                                <img src="{{Storage::url($item->thumbnail)}}" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                        <h3><a href=" {{url('blog/'.$item->slug)}} ">{{$item->name}}</a></h3>
                                            <div class="blog-meta">
                                            <span class="posted-author">by: {{ $item->user->fname.' '.$item->user->lname }}</span>
                                                <span class="post-date">{{ Helper::globalDateTime($item->created_at) }}</span>
                                            </div>
                                            <p>{{ Helper::limit_text($item->content, 40) }}</p>
                                        </div>
                                        <a href=" {{url('blog/'.$item->slug)}} ">read more <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end single blog item -->
                            </div>
                        </div>
                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center pt-30 pb-30">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="pagination-box">
                                        <li><a class="Previous" href="#">Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a class="Next" href="#"> Next </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
            </div>
        </div>
        <!-- blog main wrapper end -->

@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush