@extends('layouts.app',['pageTitle' => __(' Product Management')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Product') }}
@endslot
@endcomponent

<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Product List') }}</h6>

        <div class="card-body">
            @if (Helper::authCheck('product-create'))
            <a href="{{ url('/admin/product/create') }}" class="btn btn-success btn-sm" title="Add New  Product">
                <i class="feather-16" data-feather="plus"></i> {{ __('Add New') }}
            </a>
            @endif

            <form method="GET" action="{{ url('/admin/product') }}" accept-charset="UTF-8"
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
                            <th>Name</th>
                            <th>Sku</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Mini Category</th>
                            <th>Type </th>
                            <th>Brand </th>
                            <th>Featured </th>
                            <th width='150'>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->sku }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->subCategory->name ?? '' }}</td>
                            <td>{{ $item->miniCategory->name ?? '' }}</td>
                            <td>{{ $item->type->name ?? ''}}</td>
                            <td>{{ $item->brand->name ?? ''}}</td>
                            <td>{{ $item->featured ?? ''}}</td>
                            <td>
                                <a href="{{ url('/admin/product/' . $item->id) }}" title="View"><button
                                        class="btn btn-info btn-sm"><i class="feather-16"
                                            data-feather="eye"></i></button></a>
                                @if (Helper::authCheck('product-edit'))
                                <a href="{{ url('/admin/product/' . $item->id . '/edit') }}" title="Edit"><button
                                        class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                                    </button></a>
                                @endif
                                @if (Helper::authCheck('product-delete'))
                                <form method="POST" id="deleteButton{{$item->id}}"
                                    action="{{ url('/admin/product' . '/' . $item->id) }}" accept-charset="UTF-8"
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
                <div class="pagination-wrapper"> {!! $product->appends(['search' => Request::get('search')])->render()
                    !!} </div>
            </div>

        </div>
    </div>
</div>

@endsection
