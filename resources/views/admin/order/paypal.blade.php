@extends('layouts.app',['pageTitle' => __(' Add Paypal-Info')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Add Paypal-Info') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  Paypal-Info') }}</div>
                <div class="card-body">
                
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/paypal-info/save') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('client_id') ? 'has-error' : ''}}">
                            <label for="client_id" class="control-label">{{ __('Client Id') }}</label>
                            <input class="form-control" name="client_id" type="text" id="client_id"
                                value="{{ isset($paypal->client_id) ? $paypal->client_id : old('client_id')}}" required>
                            {!! $errors->first('client_id', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your client id?</div>
                        </div>
                        <div class="form-group {{ $errors->has('client_secret') ? 'has-error' : ''}}">
                            <label for="client_secret" class="control-label">{{ __('Client Secret') }}</label>
                            <input class="form-control" name="client_secret" type="text" id="client_secret"
                                value="{{ isset($paypal->client_secret) ? $paypal->client_secret : old('client_secret')}}" required>
                            {!! $errors->first('client_secret', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your client secret?</div>
                        </div>
                        <div class="form-group {{ $errors->has('currency') ? 'has-error' : ''}}">
                            <label for="currency" class="control-label">{{ __(' Currency') }}</label>
                            <input class="form-control" name="currency" type="text" id="currency"
                                value="{{ isset($paypal->currency) ? $paypal->currency : old('currency')}}" required>
                            {!! $errors->first('currency', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your currency?</div>
                        </div>

                        <input class="btn btn-success" type="submit" value='Save'>
                        

                    </form>

                </div>
            </div>
        </div>

@endsection