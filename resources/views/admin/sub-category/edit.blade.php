@extends('layouts.app',['pageTitle' => __(' Sub Category Edit')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Sub Category') }}
    @endslot
@endcomponent

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit  Sub Category') }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/sub-category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> Back</button></a>
                        <br />
                        <br />
                        <form method="POST" id="oneTimeSubmit" action="{{ url('/admin/sub-category/' . $subcategory->id) }}" accept-charset="UTF-8" class="form-horizontal needs-validation" novalidate=""  enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.sub-category.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>

@endsection
