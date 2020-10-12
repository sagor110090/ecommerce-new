@extends('layouts.app',['pageTitle' => __(' Add banner')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Add banner') }}
    @endslot
@endcomponent


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create  banner') }}</div>
                <div class="card-body">
                
                    <br />
                    <br />

                    <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/banner/save') }}" accept-charset="UTF-8"
                        class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_1') ? 'has-error' : ''}}">
                                    <label for="banner_1" class="control-label">{{ __('banner_1') }}</label><br>
                                    <input type='file' name="banner_1" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_1')"
                                        value="{{ isset($banner->banner_1) ? $banner->banner_1 : old('image')}}">
                                    <input type='text' name="oldbanner_1" value="{{ isset($banner->banner_1) ? $banner->banner_1 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_1" class="avatar-preview"
                                                src="{{ isset($banner->banner_1) ? Storage::url($banner->banner_1) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_1', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_1?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_2') ? 'has-error' : ''}}">
                                    <label for="banner_2" class="control-label">{{ __('banner_2') }}</label><br>
                                    <input type='file' name="banner_2" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_2')"
                                        value="{{ isset($banner->banner_2) ? $banner->banner_2 : old('image')}}">
                                    <input type='text' name="oldbanner_2" value="{{ isset($banner->banner_2) ? $banner->banner_2 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_2" class="avatar-preview"
                                                src="{{ isset($banner->banner_2) ? Storage::url($banner->banner_2) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_2', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_2?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_3') ? 'has-error' : ''}}">
                                    <label for="banner_3" class="control-label">{{ __('banner_3') }}</label><br>
                                    <input type='file' name="banner_3" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_3')"
                                        value="{{ isset($banner->banner_3) ? $banner->banner_3 : old('image')}}">
                                    <input type='text' name="oldbanner_3" value="{{ isset($banner->banner_3) ? $banner->banner_3 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_3" class="avatar-preview"
                                                src="{{ isset($banner->banner_3) ? Storage::url($banner->banner_3) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_3', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_3?</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_4') ? 'has-error' : ''}}">
                                    <label for="banner_4" class="control-label">{{ __('banner_4') }}</label><br>
                                    <input type='file' name="banner_4" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_4')"
                                        value="{{ isset($banner->banner_4) ? $banner->banner_4 : old('image')}}">
                                    <input type='text' name="oldbanner_4" value="{{ isset($banner->banner_4) ? $banner->banner_4 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_4" class="avatar-preview"
                                                src="{{ isset($banner->banner_4) ? Storage::url($banner->banner_4) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_4', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_4?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_5') ? 'has-error' : ''}}">
                                    <label for="banner_5" class="control-label">{{ __('banner_5') }}</label><br>
                                    <input type='file' name="banner_5" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_5')"
                                        value="{{ isset($banner->banner_5) ? $banner->banner_5 : old('image')}}">
                                    <input type='text' name="oldbanner_5" value="{{ isset($banner->banner_5) ? $banner->banner_5 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_5" class="avatar-preview"
                                                src="{{ isset($banner->banner_5) ? Storage::url($banner->banner_5) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_5', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_5?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_6') ? 'has-error' : ''}}">
                                    <label for="banner_6" class="control-label">{{ __('banner_6') }}</label><br>
                                    <input type='file' name="banner_6" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_6')"
                                        value="{{ isset($banner->banner_6) ? $banner->banner_6 : old('image')}}">
                                    <input type='text' name="oldbanner_6" value="{{ isset($banner->banner_6) ? $banner->banner_6 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_6" class="avatar-preview"
                                                src="{{ isset($banner->banner_6) ? Storage::url($banner->banner_6) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_6', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_6?</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_7') ? 'has-error' : ''}}">
                                    <label for="banner_7" class="control-label">{{ __('banner_7') }}</label><br>
                                    <input type='file' name="banner_7" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_7')"
                                        value="{{ isset($banner->banner_7) ? $banner->banner_7 : old('image')}}">
                                    <input type='text' name="oldbanner_7" value="{{ isset($banner->banner_7) ? $banner->banner_7 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_7" class="avatar-preview"
                                                src="{{ isset($banner->banner_7) ? Storage::url($banner->banner_7) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_7', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_7?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_8') ? 'has-error' : ''}}">
                                    <label for="banner_8" class="control-label">{{ __('banner_8') }}</label><br>
                                    <input type='file' name="banner_8" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_8')"
                                        value="{{ isset($banner->banner_8) ? $banner->banner_8 : old('image')}}">
                                    <input type='text' name="oldbanner_8" value="{{ isset($banner->banner_8) ? $banner->banner_8 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_8" class="avatar-preview"
                                                src="{{ isset($banner->banner_8) ? Storage::url($banner->banner_8) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_8', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_8?</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group {{ $errors->has('banner_9') ? 'has-error' : ''}}">
                                    <label for="banner_9" class="control-label">{{ __('banner_9') }}</label><br>
                                    <input type='file' name="banner_9" accept=".png, .jpg, .jpeg" onchange="showMyImage(this,'banner_9')"
                                        value="{{ isset($banner->banner_9) ? $banner->banner_9 : old('image')}}">
                                    <input type='text' name="oldbanner_9" value="{{ isset($banner->banner_9) ? $banner->banner_9 : ''}}"
                                        hidden>
                                    <div class="avatar-upload">
                                        <div class="avatar-preview">
                                            <img id="banner_9" class="avatar-preview"
                                                src="{{ isset($banner->banner_9) ? Storage::url($banner->banner_9) : asset('assets/img/upload.png')}}"
                                                alt="image" />
                                        </div>
                                    </div>
                                    {!! $errors->first('banner_9', '<p class="text-danger">:message</p>') !!}
                                    <div class="invalid-feedback"> What's your banner_9?</div>
                                </div>
                            </div>
                        </div>
                        
                        
                        

                        

                        

                        

                        
                        
                        
                        <input class="btn btn-success" type="submit" value='Save'>
                        

                    </form>

                </div>
            </div>
        </div>

@endsection