@extends('frontEnd.layouts.app',['pageTitle' => __('All Products ')])
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
                                    <li class="breadcrumb-item active" aria-current="page">my account</li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

                        <!-- my account wrapper start -->
        <div class="my-account-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                            Dashboard</a>
                                        <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                         
                                        
                                        <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                        <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                        <a href="{{ url('user-logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
        
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                <p>Hello, <strong>{{Auth::user()->fname.' '.Auth::user()->lname}}</strong> </p>
                                                </div>
                                                <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
        
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Orders</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Delivary Status</th>
                                                                <th>Payment Status</th>
                                                                <th>Total</th>
                                                                <th>Shipping Charge</th>
                                                                <th>Total Item</th>
                                                                <th>Payment Method</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($orders as $item)
                                                            <tr>
                                                                <td> {{$loop->iteration}} </td>
                                                                <td> {{ Helper::globalDateTime($item->created_at)}} </td>
                                                                <td> {!! $item->delivary_status == 'not_delivered' ? '<div class="bg-danger text-light">Not Delivered</div>' : $item->delivary_status == 'delivered' ? '<div class="bg-success text-light">Delivered</div>' : '<div class="bg-warning text-light">Pending</div>'!!} </td>
                                                                <td> {!! $item->payment_status == 'not_paid' ? '<div class="bg-danger text-light">Not Paid</div>' : '<div class="bg-success text-light">Paid</div>'!!} </td>
                                                                <td> {{$item->order_amount}} </td>
                                                                <td> {{$item->shipping_charge}} </td>
                                                                <td> {{$item->total_item}} </td>
                                                                <td> {{$item->payment_method}} </td>
                                                            </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7">Empty</td>
                                                                </tr>
                                                            @endforelse
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
         
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                <address>
                                                    <p><strong> {{$customer->user->fname.' '.$customer->user->lname}} </strong></p>
                                                    <p> {{$customer->address}} <br>
                                                    {{$customer->city}}, {{$customer->postcode}},{{$customer->city}},{{$customer->country}}</p>
                                                    <p>Mobile: {{$customer->phone_number}} </p>
                                                </address>
                                                <a href="#" data-toggle="modal" data-target="#address-modal" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Edit Address</a>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
        
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form action="{{ url('myAccountDetail', [$customer->user->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">First Name</label>
                                                                    <input type="text" name="fname" value=" {{$customer->user->fname}} " id="first-name" placeholder="First Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name"  class="required">Last Name</label>
                                                                    <input type="text" value=" {{$customer->user->lname}} " name="lname" id="last-name" placeholder="Last Name" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Addres</label>
                                                            <input type="email" value=" {{$customer->user->email}} " name="email" id="email" placeholder="Email Address" />
                                                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button class="check-btn sqr-btn ">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
        

        <div id="address-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="address-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Address</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  method="post" action="{{ url('myAccountStore', [$customer->id]) }}">
                            @csrf
                            <div class="single-input-item">
                                <label for="city">Phone Number</label>
                                <input id="phone_number" value=" {{$customer->phone_number}} " class="form-control" type="text" name="phone_number">
                            </div>
                            <div class="single-input-item mb-10">
                                <label for="country">Country</label>
                                <select name="country" id="country" style="display: none;">
                                    @foreach (Helper::getAll('countries') as $item)
                                        <option value=" {{$item->name}} " {{$customer->country == $item->name ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="single-input-item">
                                <label for="city">City</label>
                                <input id="city" value=" {{$customer->city}} " class="form-control" type="text" name="city">
                            </div>
                            <div class="single-input-item">
                                <label for="state">State</label>
                                <input id="state" value=" {{$customer->state}} " class="form-control" type="text" name="state">
                            </div>
                            <div class="single-input-item">
                                <label for="address">Address</label>
                                <input id="address" value=" {{$customer->address}} " class="form-control" type="text" name="address">
                            </div>
                            <div class="form-group">
                                <label for="postcode">Postcode</label>
                                <input id="postcode" value=" {{$customer->postcode}} " class="form-control" type="text" name="postcode">
                            </div>
                            {{-- <div class="form-group">
                                <label for="country">Country</label>
                                <select name="country" id="country">
                                    @foreach (Helper::getAll('countries') as $item)
                                        <option value=" {{$item->name}} ">{{$item->name}}</option>
                                    @endforeach
                                </select>
                               <input id="country" value=" {{$customer->country}} " class="form-control" type="text" name="country">
                            </div> --}}
                            
                            <button class="check-btn sqr-btn">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@include('frontEnd.layouts.parts.brand')
@endsection
@push('js')
@endpush