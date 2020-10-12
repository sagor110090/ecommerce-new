@extends('layouts.app',['pageTitle' => __(' Product Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Product') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Product') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/product') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('product-edit'))
            <a href="{{ url('/admin/product/' . $product->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('product-delete'))
            <form method="POST" id="deleteButton{{$product->id}}"
                action="{{ url('admin/product' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$product->id}})"><i class="feather-16" data-feather="trash-2"></i>
                    {{ __('Delete') }}</button>
            </form>
            @endif
            <br />
            <br />

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th> Name </th>
                            <td> {{ $product->name }} </td>
                        </tr>
                        <tr>
                            <th> Sku </th>
                            <td> {{ $product->sku }} </td>
                        </tr>
                        <tr>
                            <th> Category </th>
                            <td> {{ $product->category->name }} </td>
                        </tr>
                        <tr>
                            <th> Subcategory </th>
                            <td> {{ $product->subcategory->name }} </td>
                        </tr>
                        <tr>
                            <th> Minicategory </th>
                            <td> {{ $product->minicategory->name ?? '' }} </td>
                        </tr>
                        <tr>
                            <th> Type </th>
                            <td> {{ $product->type->name }} </td>
                        </tr>
                        <tr>
                            <th> Brand </th>
                            <td> {{ $product->brand->name }} </td>
                        </tr>
                        <tr>
                            <th> Featured </th>
                            <td> {{ $product->featured }} </td>
                        </tr>
                        <tr>
                            <th> Color </th>
                            <td> {!! $product->color->name ?? '<div class="text-danger"> empty </div>'!!} </td>
                        </tr>
                        <tr>
                            <th> Size </th>
                            <td> {!! $product->size->name ?? '<div class="text-danger"> empty </div>'!!} </td>
                        </tr>
                        <tr>
                            <th> Brand </th>
                            <td> {!! $product->brand->name ?? '<div class="text-danger"> empty </div>' !!}
                            </td>
                        </tr>
                        <tr>
                            <th> Quantity </th>
                            <td> {{ $product->quantity }} </td>
                        </tr>
                        <tr>
                            <th> Regular Price </th>
                            <td> {!! $product->regular_price ?? '<div class="text-danger"> empty </div>' !!} </td>
                        </tr>
                        <tr>
                            <th> Sale Price </th>
                            <td> {!! $product->sale_price ?? '<div class="text-danger"> empty </div>' !!} </td>
                        </tr>
                        <tr>
                            <th> Thumbnail1 </th>
                            <td> <img src="{{ Storage::url($product->thumbnail1)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Thumbnail2 </th>
                            <td> <img src="{{ Storage::url($product->thumbnail2)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Image1 </th>
                            <td> <img src="{{ Storage::url($product->image1)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Image2 </th>
                            <td> <img src="{{ Storage::url($product->image2)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Image3 </th>
                            <td> <img src="{{ Storage::url($product->image3)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Short Description </th>
                            <td> {!!$product->short_description!!}
                            </td>
                        </tr>
                        <tr>
                            <th> Long Description </th>
                            <td> {!!$product->long_description!!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
