@extends('layouts.app',['pageTitle' => __(' Shipping Charge Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Shipping Charge') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  Shipping Charge') }}</div>

                <div class="card-body">
                    <a href="{{ url('/admin/shipping-charge') }}" title="Back"><button
                            class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                            </button></a>
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/shipping-charge') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.shipping-charge.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>

@endsection