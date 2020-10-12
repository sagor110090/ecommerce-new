@extends('layouts.app',['pageTitle' => __('Email')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('Email') }}
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
                                        <th colspan="1">
                                            <div class="inbox-header">
                                                Compose New Message
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert"></div>
                                <form class="form-horizontal composeForm needs-validation" novalidate=""
                                    id="upload_image_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="email_address" name="email" class="form-control"
                                                required placeholder="TO">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="subject" name="subject" class="form-control" required
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                    <textarea class="summernote" id="content" name="content"></textarea>
                                    <div class="compose-editor m-t-20">
                                        <input type="file" class="default" name="attach" id="attach">
                                    </div>
                                    <input type="text" hidden name="status" id="status">
                                    <div class="mt-3">

                                        <button type="submit" class="btn btn-info btn-border-radius waves-effect"
                                            id="send">Send</button>
                                        <button type="submit"
                                            class="btn btn-danger btn-border-radius waves-effect" id="draft">Draft</button>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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
    $('#send').click(function (e) { 
        $('#status').val('send');
        statusCheck();
    });
    $('#draft').click(function (e) { 
        $('#status').val('draft');
        statusCheck();
    });

    function statusCheck() {  
        var status = $('#status').val();
                if (status == 'send') {
                    $('#send').addClass('btn-progress');
                }if(status == 'draft'){
                    $('#draft').addClass('btn-progress');
                }
    }
                
    $('#upload_image_form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "/admin/sendSingleMail/",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                this.reset();
                $('.alert').replaceWith('<div class="alert alert-success">'+data+'</div>');
                
                $('#draft').removeClass('btn-progress');
                $('#send').removeClass('btn-progress');
            },
            error: function(data) {
                 
                $('.alert').replaceWith(
                    '<div class="alert alert-danger">Errors</div>'); 
                
                $('#send').removeClass('btn-progress');
                $('#draft').removeClass('btn-progress');
            }
        });
    });
</script>
@endpush