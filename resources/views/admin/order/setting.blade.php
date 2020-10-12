@extends('layouts.app',['pageTitle' => __(' Add setting')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Add setting') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Set  setting') }}</div>
                <div class="card-body">
                
                    <br />
                    <br />


                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/setting/save') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
                            <label for="logo" class="control-label">{{ __('Logo') }}</label><br>
                            <input type='file' name="logo" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'logo')"
                                value="{{ isset($setting->logo) ? $setting->logo : old('image')}}">
                            <input type='text' name="oldlogo" value="{{ isset($setting->logo) ? $setting->logo : ''}}"
                                hidden>
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <img id="logo" class="avatar-preview"
                                        src="{{ isset($setting->logo) ? Storage::url($setting->logo) : asset('assets/img/upload.png')}}"
                                        alt="image" />
                                </div>
                            </div>
                            {!! $errors->first('setting_9', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your logo?</div>
                        </div>
                        <div class="form-group {{ $errors->has('favicon') ? 'has-error' : ''}}">
                            <label for="favicon" class="control-label">{{ __('Favicon') }}</label><br>
                            <input type='file' name="favicon" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'favicon')"
                                value="{{ isset($setting->favicon) ? $setting->favicon : old('image')}}">
                            <input type='text' name="oldfavicon" value="{{ isset($setting->favicon) ? $setting->favicon : ''}}"
                                hidden>
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <img id="favicon" class="avatar-preview"
                                        src="{{ isset($setting->favicon) ? Storage::url($setting->favicon) : asset('assets/img/upload.png')}}"
                                        alt="image" />
                                </div>
                            </div>
                            {!! $errors->first('setting_9', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your favicon?</div>
                        </div>
                        <div class="form-group {{ $errors->has('site_name') ? 'has-error' : ''}}">
                            <label for="site_name" class="control-label">{{ __('Site name') }}</label>
                            <input class="form-control" name="site_name" type="text" id="site_name"
                                value="{{ isset($setting->site_name) ? $setting->site_name : old('site_name')}}" required>
                            {!! $errors->first('site_name', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your site name?</div>
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                            <label for="title" class="control-label">{{ __('Site title') }}</label>
                            <input class="form-control" name="title" type="text" id="title"
                                value="{{ isset($setting->title) ? $setting->title : old('title')}}" required>
                            {!! $errors->first('title', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your title?</div>
                        </div>
                        <input class="btn btn-success" type="submit" value='Save'>
                        

                    </form>

                </div>
            </div>
        </div>

@endsection