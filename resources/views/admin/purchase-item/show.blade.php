@extends('layouts.app',['pageTitle' => __(' Purchase Item Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Purchase Item') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Purchase Item') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/purchase-item') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('purchaseitem-edit'))
            <a href="{{ url('/admin/purchase-item/' . $purchaseitem->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('purchaseitem-delete'))
            <form method="POST" id="deleteButton{{$purchaseitem->id}}"
                action="{{ url('admin/purchase-item' . '/' . $purchaseitem->id) }}" accept-charset="UTF-8"
                style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$purchaseitem->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $purchaseitem->id }}</td>
                        </tr>
                        <tr>
                            <th> Product </th>
                            <td> {{ $purchaseitem->product->name }} </td>
                        </tr>
                        <tr>
                            <th> Color </th>
                            <td> {!! $purchaseitem->color->name ?? '<div class="text-danger"> empty </div>'!!} </td>
                        </tr>
                        <tr>
                            <th> Size </th>
                            <td> {!! $purchaseitem->size->name ?? '<div class="text-danger"> empty </div>'!!} </td>
                        </tr>
                        <tr>
                            <th> Brand </th>
                            <td> {!! $purchaseitem->product->brand->name ?? '<div class="text-danger"> empty </div>' !!}
                            </td>
                        </tr>
                        <tr>
                            <th> Quantity </th>
                            <td> {{ $purchaseitem->quantity }} </td>
                        </tr>
                        <tr>
                            <th> Regular Price </th>
                            <td> {!! $purchaseitem->regular_price ?? '<div class="text-danger"> empty </div>' !!} </td>
                        </tr>
                        <tr>
                            <th> Sale Price </th>
                            <td> {!! $purchaseitem->sale_price ?? '<div class="text-danger"> empty </div>' !!} </td>
                        </tr>
                        <tr>
                            <th> Thumbnail1 </th>
                            <td> <img src="{{ Storage::url($purchaseitem->thumbnail1)}}" height="50px" width="70px"
                                    alt=""> </td>
                        </tr>
                        <tr>
                            <th> Thumbnail2 </th>
                            <td> <img src="{{ Storage::url($purchaseitem->thumbnail2)}}" height="50px" width="70px"
                                    alt=""> </td>
                        </tr>
                        <tr>
                            <th> Image1 </th>
                            <td> <img src="{{ Storage::url($purchaseitem->image1)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Image2 </th>
                            <td> <img src="{{ Storage::url($purchaseitem->image2)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Image3 </th>
                            <td> <img src="{{ Storage::url($purchaseitem->image3)}}" height="50px" width="70px" alt="">
                            </td>
                        </tr>
                        <tr>
                            <th> Short Description </th>
                            <td> {!!$purchaseitem->short_description!!}
                            </td>
                        </tr>
                        <tr>
                            <th> Long Description </th>
                            <td> {!!$purchaseitem->long_description!!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
