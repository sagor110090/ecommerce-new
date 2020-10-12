@extends('layouts.app',['pageTitle' => __('Invoice')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Invoice') }}
    @endslot
@endcomponent
<a href="javascript:history.back()" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __('Back') }}
</button></a>
<br>
<br> 

<section class="section">
    <div class="section-body">
      <div class="invoice">
        <div class="invoice-print" id="print-window">
          <div class="row">
            <div class="col-lg-12">
              <div class="invoice-title">
                <h2>Invoice</h2>
                <div class="invoice-number">Order #{{$order->id}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <address>
                    <strong>Billed To:</strong><br>
                    {{$order->customer->user->fname .' '.$order->customer->user->lname}} <br>
                    {{$order->customer->address ? $order->customer->address.',' : ''}}<br>
                    {{$order->customer->city ? $order->customer->city.',' : ''}}<br>
                    {{$order->customer->state ? $order->customer->state.',' : ''}} {{$order->customer->postcode ? $order->customer->postcode.',' : ''}} {{$order->customer->country}}
                  </address>
                </div>
                <div class="col-md-6 text-md-right">
                  <address>
                    <strong>Shipped To:</strong><br>
                    {{$order->shippingBetails->fname .' '.$order->shippingBetails->lname}}<br>
                    {{$order->shippingBetails->address ? $order->shippingBetails->address.',' : ''}}<br>
                    {{$order->shippingBetails->city ? $order->shippingBetails->city.',' : ''}}<br>
                    {{$order->shippingBetails->state ? $order->shippingBetails->state.',' : ''}} {{$order->shippingBetails->postcode ? $order->shippingBetails->postcode.',' : ''}} {{$order->shippingBetails->country}}
                  </address>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <address>
                    <strong>Payment Method:</strong><br>
                  {{$order->payment_method}}<br>
                  </address>
                </div>
                <div class="col-md-6 text-md-right">
                  <address>
                    <strong>Order Date:</strong><br>
                    {{ Helper::globalDateTime($order->created_at) }}<br><br>
                  </address>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="section-title">Order Summary</div>
              <p class="section-lead">All items here cannot be deleted.</p>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                  <tbody>
                    <tr>
                        <th data-width="40" style="width: 40px;">#</th>
                        <th>Item</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right">Totals</th>
                    </tr>
                    @foreach ($order->orderItem as $item)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{$item->product->name}}</td>
                          <td class="text-center">${{$item->product_price}}</td>
                          <td class="text-center">{{$item->product_quantity}}</td>
                          <td class="text-right">${{(double)$item->product_price * (double)$item->product_quantity}}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
              <div class="row mt-4">
                <div class="col-lg-8">
                  <div class="section-title">Payment Method</div>
                  <p class="section-lead">The payment method that we provide is to make it easier for you to pay
                    invoices.</p>
                  <div class="images">
                    <img src="{{ asset('assets') }}/img/cards/visa.png" alt="visa">
                    <img src="{{ asset('assets') }}/img/cards/jcb.png" alt="jcb">
                    <img src="{{ asset('assets') }}/img/cards/mastercard.png" alt="mastercard">
                    <img src="{{ asset('assets') }}/img/cards/paypal.png" alt="paypal">
                  </div>
                </div>
                <div class="col-lg-4 text-right">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Subtotal</div>
                    <div class="invoice-detail-value">${{$order->order_amount}}</div>
                  </div>
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Shipping</div>
                    <div class="invoice-detail-value">${{$order->shipping_charge ?? '0'}}</div>
                  </div>
                  <hr class="mt-2 mb-2">
                  <div class="invoice-detail-item">
                    <div class="invoice-detail-name">Total</div>
                    <div class="invoice-detail-value invoice-detail-value-lg">${{$order->order_amount+$order->shipping_charge}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="text-md-right">
          <button class="btn btn-warning btn-icon icon-left"   id="print"><i class="fas fa-print"></i> Print</button>
        </div>
      </div>
    </div>
  </section>


@endsection

@push('js')
    <script src="{{ asset('assets/js/print.js') }}"></script>
    <script>
      $('#print').on('click', function() {
          $("#print-window").print({
              addGlobalStyles : true,
              stylesheet : "{{ asset('assets') }}/css/app.min.css",

              rejectWindow : true,
              noPrintSelector : "#printSection,#footer",
              iframe : false,
              append : null,
              prepend : "#footer"
          });
      });
      </script>
@endpush