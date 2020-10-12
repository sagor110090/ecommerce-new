@extends('auth.layouts.app',['pageTitle' => __('Error ')])
@section('content')

<section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
        <h1>{{$code}}</h1>
          <div class="page-description">
            The page you were looking for could {{$error}}.
          </div>
          <div class="page-search">

            <div class="mt-3">
              <a href="{{ url('/', []) }}">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection