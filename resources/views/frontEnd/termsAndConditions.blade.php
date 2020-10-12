@extends('frontEnd.layouts.app',['pageTitle' => __('Terms And Conditions ')])
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
                            <li class="breadcrumb-item active" aria-current="page">Terms And Conditions</li>

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
            <div class="col">
                <div class="terms-and-conditions">
                    {!!$termsAndConditions->terms_and_condition!!}
                </div>
            </div>
        </div>
    </div>
</div>


@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush
