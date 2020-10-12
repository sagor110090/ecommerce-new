@extends('layouts.app',['pageTitle' => __('Profile')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('Profile') }}
@endslot
@endcomponent

<!-- Main Content -->

<section class="section">
    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                    <div class="card-body">
                        <div class="author-box-center">
                        <img alt="image" src="{{AUth::user()->image ? Storage::url(AUth::user()->image) : asset('assets') .'/img/users/user-8.png'}}"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                            <div class="author-box-name">
                                <a href="javascript:0;">{{ucwords($user->fname.' '.$user->lname)}}</a>
                            </div>
                            <div class="author-box-job">{{ucwords(str_replace('-', ' ', $user->role)) }}</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="py-4">
                            <p class="clearfix">
                                <span class="float-left">
                                    Birthday
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->birthday}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Phone
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->phone}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Mail
                                </span>
                                <span class="float-right text-muted">
                                    {{$user->email}}
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Facebook
                                </span>
                                <span class="float-right text-muted">
                                    <a href="{{$user->facebook_link}}">{{$user->facebook_userName}}</a>
                                </span>
                            </p>
                            <p class="clearfix">
                                <span class="float-left">
                                    Twitter
                                </span>
                                <span class="float-right text-muted">
                                    <a href="{{$user->twitter_link}}">{{$user->twitter_userName}}</a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="padding-20" id="profile-hight">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                    aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                                    aria-selected="false">Setting</a>
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="about" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="row">
                                    <div class="col-md-3 col-6 b-r">
                                        <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">{{ucwords($user->fname.' '.$user->lname)}}</p>
                                    </div>
                                    <div class="col-md-3 col-6 b-r">
                                        <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">{{$user->phone}}</p>
                                    </div>
                                    <div class="col-md-3 col-6 b-r">
                                        <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <strong>Location</strong>
                                        <br>
                                        <p class="text-muted">{{Helper::country()}}</p>
                                    </div>
                                </div>
                                <p class="m-t-30">{{$user->bio}} </p>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                                <form method="post" class="needs-validation" action="{{ url('admin/profile/save') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-header">
                                        <h4>Edit Profile</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label>First Name</label>
                                                <input type="text" name="fname" class="form-control"
                                                    value="{{$user->fname}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the first name
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label>Last Name</label>
                                                <input type="text" name="lname" class="form-control"
                                                    value="{{$user->lname}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the last name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{$user->email}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the email
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label>Phone</label>
                                                <input type="number" name="phone" class="form-control"
                                                    value="{{$user->phone}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label>Facebook</label>
                                                <input type="text" name="facebook_userName" class="form-control"
                                                    value="{{$user->facebook_userName}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the facebook
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label>Facebook Link</label>
                                                <input type="link" name="facebook_link" class="form-control"
                                                    value="{{$user->facebook_link}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label>Twitter</label>
                                                <input type="text" name="twitter_userName" class="form-control"
                                                    value="{{$user->twitter_userName}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the Twitter
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label>Twitter Link</label>
                                                <input type="link" name="twitter_link" class="form-control"
                                                    value="{{$user->twitter_link}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label>Birthday</label>
                                                <input type="date" name="birthday" class="form-control"
                                                    value="{{$user->birthday}}">
                                                <div class="invalid-feedback">
                                                    Please fill in the Birthday
                                                </div>
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label>Profile Image</label>
                                                <input type="file" name="image" class="form-control"
                                                    value="{{$user->image}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>Bio</label>
                                                <textarea class="form-control summernote-simple"
                                                    name="bio">{{$user->bio}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Save Changes</button>
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
{{-- <div class="settingSidebar">
        <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
        </a>
        <div class="settingSidebar-body ps-container ps-theme-default">
          <div class=" fade show active">
            <div class="setting-panel-header">Setting Panel
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Select Layout</h6>
              <div class="selectgroup layout-color w-50">
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                  <span class="selectgroup-button">Light</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                  <span class="selectgroup-button">Dark</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Sidebar Color</h6>
              <div class="selectgroup selectgroup-pills sidebar-color">
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                  <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                    data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <h6 class="font-medium m-b-10">Color Theme</h6>
              <div class="theme-setting-options">
                <ul class="choose-theme list-unstyled mb-0">
                  <li title="white" class="active">
                    <div class="white"></div>
                  </li>
                  <li title="cyan">
                    <div class="cyan"></div>
                  </li>
                  <li title="black">
                    <div class="black"></div>
                  </li>
                  <li title="purple">
                    <div class="purple"></div>
                  </li>
                  <li title="orange">
                    <div class="orange"></div>
                  </li>
                  <li title="green">
                    <div class="green"></div>
                  </li>
                  <li title="red">
                    <div class="red"></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="mini_sidebar_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Mini Sidebar</span>
                </label>
              </div>
            </div>
            <div class="p-15 border-bottom">
              <div class="theme-setting-options">
                <label class="m-b-0">
                  <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                    id="sticky_header_setting">
                  <span class="custom-switch-indicator"></span>
                  <span class="control-label p-l-10">Sticky Header</span>
                </label>
              </div>
            </div>
            <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
              <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                <i class="fas fa-undo"></i> Restore Default
              </a>
            </div>
          </div>
        </div>
      </div> --}}

@endsection