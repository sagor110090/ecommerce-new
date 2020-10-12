@extends('frontEnd.layouts.app',['pageTitle' => __('Checkout')])
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
                            <li class="breadcrumb-item active" aria-current="page">checkout</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- checkout main wrapper start -->
<div class="checkout-page-wrapper">
    <div class="container">
        <div class="row">
            <!-- Checkout Billing Details -->
            <div class="col-lg-6">
                <div class="checkout-billing-details-wrap">
                    <h2>Billing Details</h2>
                    <div class="billing-form-wrap">
                        <form action="{{ url('charge') }}" method="POST" id="orderForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">First Name</label>
                                        <input type="text" class="dashed-input-field" id="f_name" name="fname"
                                            placeholder="First Name" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input-item">
                                        <label for="l_name" class="required">Last Name</label>
                                        <input type="text" class="dashed-input-field" id="l_name" name="lname"
                                            placeholder="Last Name" required />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" id="email" class="dashed-input-field" name="email"
                                    placeholder="Email Address" required />
                            </div>
                            <div class="single-input-item">
                                <label for="country" class="required pt-20">Country</label>
                                <select name="country" id="country" class="form-control dashed-input-field">
                                    @foreach (Helper::getAll('countries') as $item)
                                    <option value=" {{$item->name}} ">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="single-input-item">
                                <label for="street-address" class="required pt-20">Street address</label>
                                <input type="text" class="dashed-input-field" name="address" id="street-address"
                                    placeholder="Street address Line 1" required />
                            </div>

                            <div class="single-input-item">
                                <label for="town" class="required">Town / City</label>
                                <input type="text" class="dashed-input-field" name="city" id="town"
                                    placeholder="Town / City" required />
                            </div>

                            <div class="single-input-item">
                                <label for="state">State / Divition</label>
                                <input type="text" class="dashed-input-field" name="state" id="state"
                                    placeholder="State / Divition" />
                            </div>

                            <div class="single-input-item">
                                <label for="postcode" class="required">Postcode / ZIP</label>
                                <input type="text" class="dashed-input-field" name="postcode" id="postcode"
                                    placeholder="Postcode / ZIP" required />

                            </div>

                            <div class="single-input-item">
                                <label for="phone" class="required">Phone</label>
                                <input type="text" class="dashed-input-field" name="phone_number" id="phone"
                                    placeholder="Phone" required />
                            </div>

                    </div>
                </div>
            </div>

            <!-- Order Summary Details -->
            <div class="col-lg-6">
                <div class="order-summary-details mt-md-26 mt-sm-26">
                    <h2>Your Order Summary</h2>
                    <div class="order-summary-content mb-sm-4">
                        <!-- Order Summary Table -->
                        <div class="order-summary-table table-responsive text- class=" dashed-input-field"center">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td><a href="single-product.html">{{$item->name}}<strong> ×
                                                    {{$item->quantity}}</strong></a></td>
                                        <td>${{$item->price*$item->quantity}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td><strong>${{$subTotal}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="d-flex justify-content-center">
                                            <ul class="shipping-type">
                                                <li>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="flatrate" name="shipping"
                                                            class="custom-control-input" checked />
                                                        <label class="custom-control-label" for="flatrate">Flat Rate:
                                                            ${{$shippingCharge}}</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount</td>
                                        <td><strong>${{$total+$shippingCharge}}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Order Payment Method -->
                        <div class="order-payment-method">
                            <div class="single-payment-method show">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="cashon" name="paymentmethod" value="cash"
                                            class="custom-control-input" checked />
                                        <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="cash">
                                    <p>Pay with cash upon delivery.</p>
                                </div>
                            </div>
                            <div class="single-payment-method">
                                <div class="payment-method-name">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="paypalpayment" name="paymentmethod" value="paypal"
                                            class="custom-control-input" />
                                        <label class="custom-control-label" for="paypalpayment">Paypal <img
                                                src="{{ asset('frontEnd') }}/assets/img/paypal-card.jpg"
                                                class="img-fluid paypal-card" alt="Paypal" /></label>
                                    </div>
                                </div>
                                <div class="payment-method-details" data-method="paypal">
                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                        account.</p>
                                </div>
                            </div>
                            <div class="summary-footer-area">
                                <div class="custom-control custom-checkbox mb-14">
                                    <input type="checkbox" class="custom-control-input" id="terms" required />
                                    <label class="custom-control-label" for="terms">I have read and agree to the website
                                        <a href="{{ url('terms-and-conditions') }}">terms and conditions.</a></label>
                                </div>
                                <button type="submit" class="check-btn sqr-btn">Place Order</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout main wrapper end -->
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush
