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
                            <li class="breadcrumb-item active" aria-current="page">blog details</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

        <!-- blog wrapper start -->
        <div class="about-us-wrapper pt-4">
            <div class="container">
                <div class="row">
                    <!-- blog Text Start -->
                    <div class="col-lg-6">
                        <div class="about-text-wrap">
                            <h2> {{$blog->name}} </h2>
                            <p>{{$blog->content}}</p>
                        </div>
                    </div>
                    <!-- blog Text End -->
                    <!-- blog Image Start -->
                    <div class="col-lg-5 ml-auto">
                        <div class="about-image-wrap mt-md-26 mt-sm-26">
                            <img src=" {{Storage::url($blog->image)}} " alt="About" />
                        </div>
                    </div>
                    <!-- blog Image End -->
                </div>
            </div>
        </div>
        <!-- blog wrapper end -->

@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush