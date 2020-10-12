@extends('layouts.app',['pageTitle' => __(' Country Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Country') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  Country') }}</div>

                <div class="card-body">
                    <a href="{{ url('/admin/country') }}" title="Back"><button
                            class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                            </button></a>
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/country') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.country.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>

@endsection