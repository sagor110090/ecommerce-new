@extends('layouts.app',['pageTitle' => __(' Add terms and conditions')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('terms and conditions') }}
@endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __('Set  terms and conditions') }}</div>
        <div class="card-body">

            <br />
            <br />

            <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/terms-and-conditions/save') }}"
                accept-charset="UTF-8" class="form-horizontal needs-validation" novalidate=""
                enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('terms and condition') ? 'has-error' : ''}}">
                    <label for="terms_and_condition" class="control-label">{{ __('Site terms and condition') }}</label>
                    <textarea class="summernote" rows="5" name="terms_and_condition" type="textarea"
                        id="terms_and_condition">{{ isset($terms_and_condition->terms_and_condition) ? $terms_and_condition->terms_and_condition : ''}}</textarea>
                    {!! $errors->first('terms_and_condition', '<p class="text-danger">:message</p>') !!}
                    <div class="invalid-feedback"> What's your terms and conditions?</div>
                </div>
                <input class="btn btn-success" type="submit" value='Save'>


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
