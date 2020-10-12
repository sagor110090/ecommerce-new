@extends('layouts.app',['pageTitle' => __('Single View')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('Single View / '.$email->subject) }}
@endslot
@endcomponent
<section class="section">
    <div class="section-body">
        <div class="row">
            @include('emails.sidebar')
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="card">
                    <div class="boxs mail_listing">
                        <div class="inbox-body no-pad">
                            <section class="mail-list">
                                <div class="mail-sender">
                                    <div class="mail-heading">
                                        <h4 class="vew-mail-header">
                                            <b>{{$email->subject}}</b>
                                        </h4>
                                    </div>
                                    <hr>
                                    <div class="media">
                                        <a href="#" class="table-img m-r-15">
                                            <img alt="image" src="{{ Storage::url($user->image) }} "
                                                class="rounded-circle" width="35" data-toggle="tooltip"
                                                title="Sachin Pandit">
                                        </a>
                                        <div class="media-body">
                                            <span
                                                class="date pull-right">{{Helper::globalDateTime($email->created_at)}}</span>
                                            <h5 class="text-primary">{{ $user->fname.' '.$user->lname }}</h5>
                                            <small class="text-muted">From: {{$email->from}}</small><br>
                                            <small class="text-muted">To: {{$email->to}}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-mail p-t-20">
                                    {!!$email->content!!}
                                </div>
                                <div class="attachment-mail" {{$email->attach ? '' : 'hidden'}}>
                                    <p>
                                        <span>
                                            <i class="fa fa-paperclip"></i> attachments — </span>
                                    </p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="#">
                                                <img class="img-thumbnail img-responsive" alt="attachment"
                                                    src="{{Storage::url($email->attach)}}">
                                            </a>
                                            <a class="name" href="#"> {{$email->attach}}
                                                {{-- <span>20KB</span> --}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
