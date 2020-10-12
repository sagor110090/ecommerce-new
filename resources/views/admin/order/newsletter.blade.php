@extends('layouts.app',['pageTitle' => __('Newsletters')])
@section('content')

@component('layouts.parts.breadcrumb')
    @slot('title')
        {{ __(' Newsletters') }}
    @endslot
@endcomponent


<div class="col-md-12">
    <div class="card">
        <h6 class="card-header">{{ __(' Newsletters List') }}</h6>

        <div class="card-body">
            <form method="GET" action="{{ url('/admin/newsletters') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                        <span class="input-group-append">
                            <button class="btn btn-secondary" type="submit">
                                <i class="feather-16" data-feather="search"></i>
                            </button>
                        </span>
                    </div>
            </form>

            <br/>
            <br/>
            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover"  style="width:100%;">
                    <thead>
                        <tr>
                            <th  width='30'>#</th>
                            <th>Email</th>
                            <th>Create</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($newsletters as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                        @endforeach
                         
                    </tbody>
                </table>
              </div>

        </div>
    </div>
</div>


@endsection