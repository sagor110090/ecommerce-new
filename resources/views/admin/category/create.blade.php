@extends('layouts.app',['pageTitle' => __(' Category Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Category') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  Category') }}</div>

                <div class="card-body">
                    <a href="{{ url('/admin/category') }}" title="Back"><button
                            class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
                            </button></a>
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/category') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.category.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>

@endsection