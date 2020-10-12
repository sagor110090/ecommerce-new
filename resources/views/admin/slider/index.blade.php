@extends('layouts.app',['pageTitle' => __(' Slider Management')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Slider') }}
@endslot
@endcomponent

<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Slider List') }}</h6>

        <div class="card-body">
            @if (Helper::authCheck('slider-create'))
            <a href="{{ url('/admin/slider/create') }}" class="btn btn-success btn-sm" title="Add New  Slider">
                <i class="feather-16" data-feather="plus"></i> {{ __('Add New') }}
            </a>
            @endif

            <form method="GET" action="{{ url('/admin/slider') }}" accept-charset="UTF-8"
                class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="feather-16" data-feather="search"></i>
                        </button>
                    </span>
                </div>
            </form>

            <br />
            <br />
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover" style="width:100%;">
                    <thead>
                        <tr>
                            <th width='30'>#</th>
                            <th>Slider Background</th>
                            <th>Slider Lable1</th>
                            <th>Slider Lable2</th>
                            <th>Slider Lable3</th>
                            <th>Slider Lable4</th>
                            <th>Header</th>
                            <th>Description</th>
                            <th width='150'>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($slider as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{Storage::url($item->slider_background) }}" height="40px" width="60px"></td>
                            <td><img src="{{Storage::url($item->slider_lable1) }}" height="40px" width="60px"></td>
                            <td><img src="{{Storage::url($item->slider_lable2) }}" height="40px" width="60px"></td>
                            <td><img src="{{Storage::url($item->slider_lable3) }}" height="40px" width="60px"></td>
                            <td><img src="{{Storage::url($item->slider_lable4) }}" height="40px" width="60px"></td>
                            <td>{{ $item->header }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a href="{{ url('/admin/slider/' . $item->id) }}" title="View"><button
                                        class="btn btn-info btn-sm"><i class="feather-16"
                                            data-feather="eye"></i></button></a>
                                @if (Helper::authCheck('slider-edit'))
                                <a href="{{ url('/admin/slider/' . $item->id . '/edit') }}" title="Edit"><button
                                        class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                                    </button></a>
                                @endif
                                @if (Helper::authCheck('slider-delete'))
                                <form method="POST" id="deleteButton{{$item->id}}"
                                    action="{{ url('/admin/slider' . '/' . $item->id) }}" accept-charset="UTF-8"
                                    style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                        onclick="sweetalertDelete({{$item->id}})"><i class="feather-16"
                                            data-feather="trash-2"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $slider->appends(['search' => Request::get('search')])->render()
                    !!} </div>
            </div>

        </div>
    </div>
</div>

@endsection
