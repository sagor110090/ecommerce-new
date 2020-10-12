@extends('layouts.app',['pageTitle' => __(' Color Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Color') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  Color') }}</div>

                <div class="card-body">
                    <a href="{{ url('/admin/color') }}" title="Back"><button
                            class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                            </button></a>
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/color') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.color.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>

@endsection