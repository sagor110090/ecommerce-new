@extends('layouts.app',['pageTitle' => __(' Slider Edit')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Slider') }}
@endslot
@endcomponent

<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('Edit  Slider') }}</div>
        <div class="card-body">
            <a href="{{ url('/admin/slider') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> Back</button></a>
            <br />
            <br />
            <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/slider/' . $slider->id) }}"
                accept-charset="UTF-8" class="form-horizontal needs-validation" novalidate=""
                enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('admin.slider.form', ['formMode' => 'edit'])

            </form>

        </div>
    </div>
</div>

@endsection
