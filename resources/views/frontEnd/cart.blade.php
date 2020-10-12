@extends('frontEnd.layouts.app',['pageTitle' => __('Cart Details ')])
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
                            <li class="breadcrumb-item active" aria-current="page">cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- cart main wrapper start -->
<div class="cart-main-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Cart Table Area -->
                <div class="cart-table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="pro-thumbnail">Thumbnail</th>
                                <th class="pro-title">Product</th>
                                <th class="pro-price">Price</th>
                                <th class="pro-quantity">Quantity</th>
                                <th class="pro-subtotal">Total</th>
                                <th class="pro-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ url('cartUpdate') }}" method="post" id="updateCartForm">
                                {{ csrf_field() }}
                                @forelse ($items as $item)
                                <input type="text" hidden value="{{$item->id}}" name="id[]">
                                <input type="text" hidden value="{{$item->quantity}}" name="oldQuantity[]">
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                src="{{$item->attributes->image}}" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#"> {{$item->name}} </a></td>
                                    <td class="pro-price"><span>${{$item->price}}</span></td>
                                    <td class="pro-quantity">
                                        <div class="pro-qty"><input type="text" name="quantity[]"
                                                value="{{$item->quantity}}"></div>
                                    </td>
                                    <td class="pro-subtotal"><span> {{$item->price*$item->quantity}} </span></td>
                                    <td class="pro-remove"><a href="{{ url('removeFromCart', [$item->id]) }}"><i
                                                class="fa fa-trash-o"></i></a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">empty</td>

                                </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-5 ml-auto">
                <!-- Cart Calculation Area -->
                <div class="cart-calculator-wrapper">
                    <div class="cart-calculate-items">
                        <h3>Cart Totals</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Sub Total</td>
                                    <td>${{$subTotal}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>${{ $shippingCharge }}</td>
                                </tr>
                                <tr class="total">
                                    <td>Total</td>
                                    <td class="total-amount"> ${{$total+$shippingCharge}} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="{{ url('checkout') }}" class="sqr-btn d-block">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart main wrapper end -->
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush
