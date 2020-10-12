@extends('layouts.app',['pageTitle' => __(' Mini Category Edit')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Mini Category') }}
    @endslot
@endcomponent

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit  Mini Category') }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/mini-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/mini-category/' . $minicategory->id) }}" accept-charset="UTF-8" class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.mini-category.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>

@endsection
