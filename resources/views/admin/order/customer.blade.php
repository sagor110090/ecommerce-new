@extends('layouts.app',['pageTitle' => __('Customer')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Customer') }}
@endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Customer List') }}</h6>

        <div class="card-body">
            <form method="GET" action="{{ url('/admin/customer') }}" accept-charset="UTF-8"
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
                            <th>Phone Number</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Postcode</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->fname.' '.$item->user->lname }}</td>
                            <td>{{$item->phone_number}}</td>
                            <td>{{$item->state}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->postcode}}</td>
                            <td>{{$item->country}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {{ $customer->links() }}
            </div>

        </div>
    </div>
</div>


@endsection
