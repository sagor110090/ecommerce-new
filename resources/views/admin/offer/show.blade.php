@extends('layouts.app',['pageTitle' => __(' Offer Show')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Offer') }}
@endslot
@endcomponent
<div class="col-md-12">
    <div class="card">
        <div class="card-header">{{ __(' Offer') }}</div>
        <div class="card-body">

            <a href="{{ url('/admin/offer') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                        class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
            @if (Helper::authCheck('offer-edit'))
            <a href="{{ url('/admin/offer/' . $offer->id . '/edit') }}" title="Edit"><button
                    class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i>
                    {{ __('Edit') }}</button></a>
            @endif

            @if (Helper::authCheck('offer-delete'))
            <form method="POST" id="deleteButton{{$offer->id}}" action="{{ url('admin/offer' . '/' . $offer->id) }}"
                accept-charset="UTF-8" style="display:inline">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                    onclick="sweetalertDelete({{$offer->id}})"><i class="feather-16" data-feather="trash-2"></i>
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
                            <td>{{ $offer->id }}</td>
                        </tr>
                        <tr>
                            <th> Product Name </th>
                            <td> {{ $offer->product->name }} </td>
                        </tr>
                        <tr>
                            <th> Ending Date Time </th>
                            <td> {{ $offer->ending_date_time }} </td>
                        </tr>
                        <tr>
                            <th> Offer Percentage </th>
                            <td> {{ $offer->offer_percentage }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

@endsection
