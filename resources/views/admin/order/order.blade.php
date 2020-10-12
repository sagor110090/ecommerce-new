@extends('layouts.app',['pageTitle' => __('Order')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Order') }}
@endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Order List') }}</h6>

        <div class="card-body">
            <form method="GET" action="{{ url('/admin/order') }}" accept-charset="UTF-8"
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
                            <th>Customer Name</th>
                            <th>Order Amount</th>
                            <th>Shipping Charge</th>
                            <th>Total Item</th>
                            <th>Time</th>
                            <th>Payment status</th>
                            <th>Delivary status</th>
                            <th>Payment Method</th>
                            <th>Invoice</th>
                            {{-- <th width='300'>{{ __('Actions') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a tabindex="0" class="bg-success text-white" role="button" data-toggle="popover"
                                    title="Customer Info"
                                    data-content="id : {{$item->customer->id}}, Name: {{ $item->customer->user->fname.' '.$item->customer->user->lname }},Phone: {{$item->customer->phone}},State: {{$item->customer->state}},City: {{$item->customer->city}},address: {{$item->customer->address}},postcode: {{$item->customer->postcode}},country: {{$item->customer->country}}">{{ $item->customer->user->fname.' '.$item->customer->user->lname }}</a>
                            </td>
                            <td>$ {{ $item->order_amount }}</td>
                            <td>$ {{ $item->shipping_charge }}</td>
                            <td> <a href="{{ url('admin/orderItem/'.$item->id) }}">{{ $item->total_item }}</a></td>
                            <td>{{ Helper::globalDateTime($item->created_at) }}</td>
                            <td>
                                <form action="{{ url('admin/payment/'.$item->id) }}" id="payment-form{{$item->id}}"
                                    method="get">
                                    <select name="payment"
                                        class="{{ ($item->payment_status == 'paid' ) ? 'bg-success' : 'bg-warning'}}"
                                        onchange="Payment({{$item->id}})" id="payment{{$item->id}}">
                                        <option value="not_paid" class="bg-warning"
                                            {{ ($item->payment_status == 'not_paid' ) ? 'selected' : ''}}> Not Paid
                                        </option>
                                        <option value="paid" class="bg-success"
                                            {{ ($item->payment_status == 'paid' ) ? 'selected' : ''}}> Paid</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('/admin/delivery/'.$item->id) }}" id="delivery-form{{$item->id}}"
                                    method="get">
                                    <select name="delivery_status"
                                        class="{{ ($item->delivery_status == 'delivered' ) ? 'bg-success' : 'bg-warning'}}"
                                        onchange="Delivery({{$item->id}})" id="delivery{{$item->id}}">
                                        <option value="not_delivered" class="bg-warning"
                                            {{ ($item->delivery_status == 'not_delivered' ) ? 'selected' : ''}}> Not
                                            Delivered</option>
                                        <option value="delivered" class="bg-success"
                                            {{ ($item->delivery_status == 'delivered' ) ? 'selected' : ''}}> Delivered
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $item->payment_method }}</td>

                            <td>
                                <a href="{{ url('admin/invoice/'.$item->id) }}" class="btn btn-warning btn-xs">
                                    Print</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $order->links() }}
            </div>

        </div>
    </div>
</div>


@endsection
