@extends('layouts.app',['pageTitle' => __(' Slider show')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Slider') }}
    @endslot
@endcomponent
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __(' Slider') }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/slider') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
                        @if (Helper::authCheck('slider-edit'))
                        <a href="{{ url('/admin/slider/' . $slider->id . '/edit') }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i> {{ __('Edit') }}</button></a>
                        @endif

                        @if (Helper::authCheck('slider-delete'))
                        <form method="POST" id="deleteButton{{$slider->id}}" action="{{ url('admin/slider' . '/' . $slider->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="sweetalertDelete({{$slider->id}})"><i class="feather-16" data-feather="trash-2"></i> {{ __('Delete') }}</button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $slider->id }}</td>
                                    </tr>
                                    <tr><th> Slider Background </th><td> {{ $slider->slider_background }} </td></tr><tr><th> Slider Lable1 </th><td> {{ $slider->slider_lable1 }} </td></tr><tr><th> Slider Lable2 </th><td> {{ $slider->slider_lable2 }} </td></tr><tr><th> Slider Lable3 </th><td> {{ $slider->slider_lable3 }} </td></tr><tr><th> Slider Lable4 </th><td> {{ $slider->slider_lable4 }} </td></tr><tr><th> Header </th><td> {{ $slider->header }} </td></tr><tr><th> Description </th><td> {{ $slider->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

@endsection
