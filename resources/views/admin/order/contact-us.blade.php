@extends('layouts.app',['pageTitle' => __(' Add contact-us')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Add contact-us') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  contact-us') }}</div>
                <div class="card-body">
                
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/contact-us/save') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                            <label for="content" class="control-label">{{ __('content') }}</label>
                            <textarea name="content" class="form-control" id="content" cols="30" requiredrows="10">{{ isset($contact->content) ? $contact->content : old('content')}}</textarea>
                             
                            {!! $errors->first('content', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your content?</div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                            <label for="address" class="control-label">{{ __('Address') }}</label>
                            <input class="form-control" name="address" type="text" id="address"
                                value="{{ isset($contact->address) ? $contact->address : old('address')}}" required>
                            {!! $errors->first('address', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your address?</div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="control-label">{{ __('email') }}</label>
                            <input class="form-control" name="email" type="email" id="email"
                                value="{{ isset($contact->email) ? $contact->email : old('email')}}" required>
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your email?</div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                            <label for="phone" class="control-label">{{ __('phone no') }}</label>
                            <input class="form-control" name="phone" type="text" id="phone"
                                value="{{ isset($contact->phone) ? $contact->phone : old('phone')}}" required>
                            {!! $errors->first('phone', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your phone?</div>
                        </div>
                        <div class="form-group {{ $errors->has('working_day') ? 'has-error' : ''}}">
                            <label for="working_day" class="control-label">{{ __('working day') }}</label>
                            <input class="form-control" name="working_day" type="text" id="working_day"
                                value="{{ isset($contact->working_day) ? $contact->working_day : old('working_day')}}" required>
                            {!! $errors->first('working_day', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your working day?</div>
                        </div>
                        <div class="form-group {{ $errors->has('working_hours') ? 'has-error' : ''}}">
                            <label for="working_hours" class="control-label">{{ __('working hours') }}</label>
                            <input class="form-control" name="working_hours" type="text" id="working_hours"
                                value="{{ isset($contact->working_hours) ? $contact->working_hours : old('working_hours')}}" required>
                            {!! $errors->first('working_hours', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your working hours?</div>
                        </div>
                        <div class="form-group {{ $errors->has('facebook_link') ? 'has-error' : ''}}">
                            <label for="facebook_link" class="control-label">{{ __('facebook page link') }}</label>
                            <input class="form-control" name="facebook_link" type="link" id="facebook_link"
                                value="{{ isset($contact->facebook_link) ? $contact->facebook_link : old('facebook_link')}}" required>
                            {!! $errors->first('facebook_link', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your facebook link?</div>
                        </div>
                        <div class="form-group {{ $errors->has('twitter_link') ? 'has-error' : ''}}">
                            <label for="twitter_link" class="control-label">{{ __('twitter page link') }}</label>
                            <input class="form-control" name="twitter_link" type="link" id="twitter_link"
                                value="{{ isset($contact->twitter_link) ? $contact->twitter_link : old('twitter_link')}}" required>
                            {!! $errors->first('facebook_link', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your twitter link?</div>
                        </div>
                        <div class="form-group {{ $errors->has('instagram_link') ? 'has-error' : ''}}">
                            <label for="instagram_link" class="control-label">{{ __('instagram page link') }}</label>
                            <input class="form-control" name="instagram_link" type="link" id="instagram_link"
                                value="{{ isset($contact->instagram_link) ? $contact->instagram_link : old('instagram_link')}}" required>
                            {!! $errors->first('instagram_link', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your instagram link?</div>
                        </div>
                        <div class="form-group {{ $errors->has('google_plus_link') ? 'has-error' : ''}}">
                            <label for="google_plus_link" class="control-label">{{ __('google plus page link') }}</label>
                            <input class="form-control" name="google_plus_link" type="link" id="google_plus_link"
                                value="{{ isset($contact->google_plus_link) ? $contact->google_plus_link : old('google_plus_link')}}" required>
                            {!! $errors->first('google_plus_link', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your instagram link?</div>
                        </div>
                        <div class="form-group {{ $errors->has('youtube_channal_link') ? 'has-error' : ''}}">
                            <label for="youtube_channal_link" class="control-label">{{ __('youtube channal link') }}</label>
                            <input class="form-control" name="youtube_channal_link" type="link" id="youtube_channal_link"
                                value="{{ isset($contact->youtube_channal_link) ? $contact->youtube_channal_link : old('youtube_channal_link')}}" required>
                            {!! $errors->first('youtube_channal_link', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your youtube channal link?</div>
                        </div>
                        
                        <input class="btn btn-success" type="submit" value='Save'>
                        

                    </form>

                </div>
            </div>
        </div>

@endsection