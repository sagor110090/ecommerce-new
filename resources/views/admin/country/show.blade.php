@extends('layouts.app',['pageTitle' => __(' Country Add')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Country') }}
    @endslot
@endcomponent
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __(' Country') }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/country') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="feather-16" data-feather="arrow-left"></i> {{ __(' Back') }}</button></a>
                        @if (Helper::authCheck('country-edit'))
                        <a href="{{ url('/admin/country/' . $country->id . '/edit') }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="feather-16" data-feather="edit"></i> {{ __('Edit') }}</button></a>
                        @endif

                        @if (Helper::authCheck('country-delete'))
                        <form method="POST" id="deleteButton{{$country->id}}" action="{{ url('admin/country' . '/' . $country->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="sweetalertDelete({{$country->id}})"><i class="feather-16" data-feather="trash-2"></i> {{ __('Delete') }}</button>
                        </form>
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $country->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $country->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

@endsection
