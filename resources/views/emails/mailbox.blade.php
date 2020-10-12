@extends('layouts.app',['pageTitle' => __('Mailbox')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('Mailbox') }}
@endslot
@endcomponent
<section class="section">
    <div class="section-body">
        <div class="row">
            @include('emails.sidebar')

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="card">
                    <div class="boxs mail_listing">
                        <div class="inbox-center table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="all-delete">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </th>
                                        <th colspan="3">
                                            <div class="inbox-header">
                                                <div class="mail-option">
                                                    <div class="email-btn-group m-l-15">
                                                        <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                            title="back" data-toggle="tooltip">
                                                            <i class="material-icons">keyboard_return</i>
                                                        </a>
                                                        <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                            title="Archive" data-toggle="tooltip">
                                                            <i class="material-icons">archive</i>
                                                        </a>
                                                        <div class="p-r-20">|</div>
                                                        <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                            title="Error" data-toggle="tooltip">
                                                            <i class="material-icons">error</i>
                                                        </a>
                                                        <form action="{{ url('admin/emails/delete') }}"
                                                            id="deleteButton1" method="get">

                                                            <a href="" id="delete-btn"
                                                                class="col-dark-gray waves-effect m-r-20" title="Delete"
                                                                data-toggle="tooltip">
                                                                <i class="material-icons">delete</i>
                                                            </a>
                                                            <a href="#" class="col-dark-gray  waves-effect m-r-20"
                                                                title="Folders" data-toggle="tooltip">
                                                                <i class="material-icons">folder</i>
                                                            </a>
                                                            <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                                title="Tag" data-toggle="tooltip">
                                                                <i class="material-icons">local_offer</i>
                                                            </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hidden-xs" colspan="2">
                                            <div class="pull-right">
                                                <div class="email-btn-group m-l-15">
                                                    <a href="#" class="col-dark-gray waves-effect m-r-20"
                                                        title="previous" data-toggle="tooltip">
                                                        <i class="material-icons">navigate_before</i>
                                                    </a>
                                                    <a href="#" class="col-dark-gray waves-effect m-r-20" title="next"
                                                        data-toggle="tooltip">
                                                        <i class="material-icons">navigate_next</i>
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $item)

                                    <tr class="unread">
                                        <td class="tbl-checkbox">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="checkbox-chack" name="select_email[]"
                                                    value="{{$item->id}}">
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </td>
                                        <td class="hidden-xs">
                                            @if ($item->subject)
                                            <a href="{{ asset('/admin/email/'.$item->id) }}">{{$item->subject}}</a>
                                            @else
                                            <a href="#">No Subject</a>
                                            @endif
                                        </td>
                                        {{-- <td class="max-texts">
                                                <a href="{{ asset('/admin/emai/'.$item->id) }}">
                                        <span class="badge badge-primary">Work</span>
                                        {!!Helper::limit_text($item->content,200)!!}</a>
                                        </td> --}}

                                        <td class="hidden-xs">
                                            <i class="material-icons" {{$item->attach  ? '' : 'hidden'}}>attach_file</i>
                                        </td>
                                        <td class="text-right"> {{Helper::globalDateTime($item->created_at)}} </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-7 ">
                                <p class="p-15">Showing 1 - @if (Helper::getAll('mailboxs')->where('status','send')->where('user_id',Auth::user()->id)->count()>15)
                                    15 of {{Helper::getAll('mailboxs')->where('status','send')->where('user_id',Auth::user()->id)->count()}}</p>
                                    @else
                                    {{Helper::getAll('mailboxs')->where('status','send')->where('user_id',Auth::user()->id)->count()}} of {{Helper::getAll('mailboxs')->where('status','send')->where('user_id',Auth::user()->id)->count()}} </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets') }}/bundles/summernote/summernote-bs4.css">
@endpush
@push('js')
<script src="{{ asset('assets') }}/bundles/summernote/summernote-bs4.js"></script>
<script>
    $('#delete-btn').click(function (e) {
        e.preventDefault();
        sweetalertDelete(1);
    });
    $("#all-delete").on("change", function () {
        var numberOfChecked = $('input:checkbox:checked').length;
        alert(numberOfChecked);
        $('.checkbox-chack').addClass('');
    });
    $('#upload_image_form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $('#send').addClass('btn-progress');
        $.ajax({
            type: 'POST',
            url: "/admin/sendSingleMail/",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                $('.alert').replaceWith('<div class="alert alert-success">Successfully Send</div>');
                $('#send').removeClass('btn-progress');
            },
            error: function (data) {
                console.log(data);
                $('.alert').replaceWith(
                    '<div class="alert alert-danger">Sending Failed fill up the field</div>');
                $('#send').removeClass('btn-progress');
            }
        });
    });
</script>
@endpush