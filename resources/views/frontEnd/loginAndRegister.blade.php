@extends('frontEnd.layouts.app',['pageTitle' => __('Login And Register')])
@section('content')

            <!-- breadcrumb area start -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-wrap">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ asset('/') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">login-register</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->
    
            <!-- login register wrapper start -->
            <div class="login-register-wrapper">
                <div class="container">
                    <div class="member-area-from-wrap">
                        <div class="row">
                            <!-- Login Content Start -->
                            <div class="col-lg-6">
                                <div class="login-reg-form-wrap  pr-lg-50">
                                    <h2>Sign In</h2>
                                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                                        @csrf
                                       
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" tabindex="1" class="form-control dashed-input-field" name="email" value="{{ old('email') }}" required>
                                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                            <div class="invalid-feedback">Please fill in your email</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-block">
                                                <label for="password" class="control-label">Password</label>
                                                <div class="float-right">
                                                    @if (Route::has('password.request'))
                                                    <a class="text-small text-danger" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <input id="password" type="password" tabindex="2" class="form-control dashed-input-field " name="password" required >
                                            {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                                            <div class="invalid-feedback"> please fill in your password </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
            
                                                <input class="custom-control-input" tabindex="3" type="checkbox" name="remember"
                                                    id="remember-me">
            
                                                <label class="custom-control-label" for="remember-me">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="sqr-btn" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Login Content End -->
    
                            <!-- Register Content Start -->
                            <div class="col-lg-6">
                                <div class="login-reg-form-wrap mt-md-34 mt-sm-34">
                                    <h2>Singup Form</h2>
                                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group {{ $errors->has('fname') ? 'has-error' : ''}}">
                            <label for="fname" class="control-label">{{ __('First Name') }}</label>
                            <input class="form-control dashed-input-field" name="fname" type="text" id="fname" value="{{old('fname')}}" required>
                            {!! $errors->first('fname', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your fname?</div>
                        <div class="form-group {{ $errors->has('lname') ? 'has-error' : ''}}">
                            <label for="lname" class="control-label">{{ __('Last Name') }}</label>
                            <input class="form-control dashed-input-field" name="lname" type="text" id="lname" value="{{old('lname')}}" required>
                            {!! $errors->first('lname', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your lname?</div>
                        </div>
                       

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            <label for="email" class="control-label">{{ __('Email') }}</label>
                            <input class="form-control dashed-input-field" name="email" type="email" id="email" value="{{old('email')}}" required>
                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                            <div class="invalid-feedback"> What's your email?</div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                            <label for="password" class="control-label">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control dashed-input-field" name="password" required autocomplete="new-password">
                                {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                                <div class="invalid-feedback">Please fill in your password</div>
                             
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                            <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control dashed-input-field" name="password_confirmation" required autocomplete="new-password">
                                {!! $errors->first('password_confirmation', '<p class="text-danger">:message</p>') !!}
                                <div class="invalid-feedback">Please fill in your Confirm Password </div>
                             
                        </div>

                        <div class="form-group row mb-0">
                            <div class="ml-3">
                                <button type="submit" class="sqr-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                                </div>
                            </div>
                            <!-- Register Content End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- login register wrapper end -->
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush