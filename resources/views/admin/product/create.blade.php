@extends('layouts.app',['pageTitle' => __(' Product Add')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Product') }}
@endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('Create  Product') }}</div>

        <div class="card-body">
            <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                </button></a>
            <br />
            <br />


            <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/product') }}" accept-charset="UTF-8"
                class="form-horizontal needs-validation" novalidate="" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.product.form', ['formMode' => 'create'])

            </form>

        </div>
    </div>
</div>

@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets') }}/bundles/summernote/summernote-bs4.css">
@endpush
@push('js')
<script src="{{ asset('assets') }}/bundles/summernote/summernote-bs4.js"></script>
@endpush
