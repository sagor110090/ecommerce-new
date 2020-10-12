@extends('layouts.app',['pageTitle' => __(' Purchase Item Add')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Purchase Item') }}
@endslot
@endcomponent

<div class="col-md-12">
    <div class="card">
        <h6 class=" card-header">{{ __(' Purchase Item Management') }}</h6>

        <div class="card-body">


            @if (Helper::authCheck('purchaseitem-create'))
            <a href="{{ url('/admin/purchase-item/create') }}" class="btn btn-success btn-sm"
                title="Add New  Purchase Item">
                <i class="feather-16" data-feather="plus"></i> {{ __('Add New') }}
            </a>
            @endif

            <form method="GET" action="{{ url('/admin/purchase-item') }}" accept-charset="UTF-8"
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
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Regular Price</th>
                            <th>Sale Price</th>
                            <th width='150'>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseitem as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->brand->name }}</td>
                            <td>{!! $item->color->name ?? '<div class="text-danger"> empty </div>' !!}</td>
                            <td>{!! $item->size->name ?? '<div class="text-danger"> empty </div>' !!}</td>
                            <td>{!! $item->quantity !!}</td>
                            <td>{!! $item->regular_price ?? '<div class="text-danger"> empty </div>'!!}</td>
                            <td>{!! $item->sale_price ?? '<div class="text-danger"> empty </div>'!!}</td>
                            <td>
                                <a href="{{ url('/admin/purchase-item/' . $item->id) }}" title="View"><button
                                        class="btn btn-info btn-sm"><i class="feather-16"
                                            data-feather="eye"></i></button></a>
                                @if (Helper::authCheck('purchaseitem-edit'))
                                <a href="{{ url('/admin/purchase-item/' . $item->id . '/edit') }}" title="Edit"><button
                                        class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                                    </button></a>
                                @endif
                                @if (Helper::authCheck('purchaseitem-delete'))
                                <form method="POST" id="deleteButton{{$item->id}}"
                                    action="{{ url('/admin/purchase-item' . '/' . $item->id) }}" accept-charset="UTF-8"
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
                <div class="pagination-wrapper"> {!! $purchaseitem->appends(['search' =>
                    Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
</div>

@endsection
