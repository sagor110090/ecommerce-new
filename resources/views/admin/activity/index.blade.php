@extends('layouts.app',['pageTitle' => __('Activity Logs')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __(' Activity Log') }}
@endslot
@endcomponent

<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Activity List') }}</h6>

        <div class="card-body">
            <form method="GET" action="{{ url('/admin/activities') }}" accept-charset="UTF-8"
                class="form-inline my-2 my-lg-0 float-right" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                        value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
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
                            <th>User</th>
                            <th>Activity</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{!! Helper::activityFindName($item->user_id) !!}</td>
                            <td>{{ $item->activity }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{!! Helper::globalDateTime($item->created_at) !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $activity->appends(['search' => Request::get('search')])->render()
                    !!} </div>
            </div>

        </div>
    </div>
</div>

@endsection