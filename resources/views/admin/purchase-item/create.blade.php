@extends('layouts.app',['pageTitle' => __(' Purchase Item Add')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Purchase Item') }}
@endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('Create  Purchase Item') }}</div>

        <div class="card-body">
            <a href="{{ url('/admin/purchase-item') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                </button></a>
            <br />
            <br />


            <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/purchase-item') }}" accept-charset="UTF-8"
                class="form-horizontal needs-validation" novalidate="" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.purchase-item.form', ['formMode' => 'create'])

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
