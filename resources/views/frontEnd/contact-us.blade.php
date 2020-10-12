@extends('frontEnd.layouts.app',['pageTitle' => __('Contact Us ')])
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
                            <li class="breadcrumb-item active" aria-current="page">contact us</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<div class="contact-area pb-34 pb-md-18 pb-sm-0">
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-lg-6">
                <div class="contact-info mt-md-28 mt-sm-28">
                    <h2>contact us</h2>
                    <p> {{$contact->content}} </p>
                    <ul>
                        <li><i class="fa fa-fax"></i> Address : {{$contact->address}}</li>
                        <li><i class="fa fa-phone"></i> {{$contact->email}}</li>
                        <li><i class="fa fa-envelope-o"></i> {{$contact->phone}}</li>
                    </ul>
                    <div class="working-time">
                        <h3>Working hours</h3>
                        <p><span>{{$contact->working_day}}:</span>{{$contact->working_hours}}</p>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>

@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush