@extends('auth.layouts.app')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" tabindex="1" class="form-control" name="email"
                                    value="{{ old('email') }}" required>
                                {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                <div class="invalid-feedback">Please fill in your email</div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        @if (Route::has('password.request'))
                                        <a class="text-small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <input id="password" type="password" tabindex="2" class="form-control  " name="password"
                                    required>
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
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
