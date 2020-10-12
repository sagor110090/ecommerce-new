@extends('frontEnd.layouts.app',['pageTitle' => __('Product Details ')])
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
                                    <li class="breadcrumb-item"><a href="javascript:0">shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">CHECKOUT</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- wishlist main wrapper start -->
        <div class="wishlist-main-wrapper">
            <div class="container">
                <!-- Wishlist Page Content Start -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Wishlist Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="pro-thumbnail">Thumbnail</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Stock Status</th>
                                    <th class="pro-subtotal">Add to Cart</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                               @forelse ($products as $product)
                               @php $item = Helper::getProduct($product->product_id) @endphp
                               <tr>
                               <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{Storage::url($item->thumbnail1)}}" alt="Product"/></a></td>
                               <td class="pro-title"><a href="#">{{$item->name}}</a></td>
                                   <td class="pro-price"><span>{{$item->sale_price}}</span></td>
                                   <td class="pro-quantity">{!!$item->quantity > 0 ? '<span class="text-success">In Stock</span>' : '<span class="text-danger">Stock Not Available</span>'!!}</td>
                                   <td class="pro-subtotal"><a href="javascript:0;" id="add-to-cart{{$item->id}}"
                                       onclick="addtocart(this.id)" data-placement="left" data-id="{{$item->id}}"
                                       data-name="{{$item->name}}" data-price="{{$item->sale_price}}"
                                       data-quantity="1" data-thumbnail1="{{asset('/').'storage/'.$item->thumbnail1}}"
                                       data-color="{{$item->color->name ?? ''}}"
                                       data-size="{{$item->size->name ?? ''}}" class="sqr-btn text-white">Add to Cart</a></td>
                                   <td class="pro-remove"><a href="{{ url('/wishlistDelete', [$product->id]) }}"><i class="fa fa-trash-o"></i></a></td>
                               </tr>
                               @empty
                               <tr>
                                   <td colspan="6">empty</td>
                                   
                               </tr>
                               @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Wishlist Page Content End -->
            </div>
        </div>
        <!-- wishlist main wrapper end -->
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush