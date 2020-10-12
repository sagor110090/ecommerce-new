@extends('layouts.app',['pageTitle' => __('layout Setting')])
@section('content')

@component('layouts.parts.breadcrumb')
@slot('title')
{{ __('Layout Setting') }}
@endslot
@endcomponent

<!-- Main Content -->

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">{{ __('Setting Panel') }}</div>

        <div class="card-body">
            
                <div class="settingSidebar-body ps-container ps-theme-default">
                  <div class=" fade show active">
                    <div class="p-15 border-bottom">
                      <h6 class="font-medium m-b-10">Select Layout</h6>
                      <div class="selectgroup layout-color w-50">
                        <label class="selectgroup-item">
                          <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" {{Helper::layouts() == 'light light-sidebar theme-white' ? 'checked' : ''}}>
                          <span class="selectgroup-button">Light</span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout" {{Helper::layouts() == 'dark dark-sidebar theme-black' ? 'checked' : ''}}>
                          <span class="selectgroup-button">Dark</span>
                        </label>
                      </div>
                    </div>
                    <div class="p-15 border-bottom">
                      <h6 class="font-medium m-b-10">Sidebar Color</h6>
                      <div class="selectgroup selectgroup-pills sidebar-color">
                        <label class="selectgroup-item">
                          <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar" {{Helper::layouts() == 'dark theme-white theme-black' ? 'checked' : ''}}>
                          <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                        </label>
                        <label class="selectgroup-item">
                          <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" {{Helper::layouts() == 'light theme-white dark-sidebar' ? 'checked' : ''}} >
                          <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                            data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                        </label>
                      </div>
                    </div>
                    {{-- <div class="p-15 border-bottom">
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
                    </div> --}}
                    <div class="p-15 border-bottom">
                      <div class="theme-setting-options">
                        <label class="m-b-0">
                          <input type="checkbox" value="1" name="custom-switch-checkbox" class="custom-switch-input"
                            id="mini_sidebar_setting" {{Helper::sidebar() == 'sidebar-mini' ? 'checked' : ''}}>
                          <span class="custom-switch-indicator"></span>
                          <span class="control-label p-l-10">Mini Sidebar</span>
                        </label>
                      </div>
                    </div>
                    <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                      <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme" id="restore">
                        <i class="fas fa-undo"></i> Restore Default
                      </a>
                    </div>
                  </div>
                </div>
               

        </div>
    </div>
</div>

@endsection
@push('js')
    <script>
          $('.select-layout').click(function(e) {
            
            var data = $(this).val();
            $.get("/admin/layoutSet/"+data+"/"+0+"/0",
              function(data, textStatus, jqXHR) {
                jQuery("body").addClass(data)

              },
              "json"
            );
     

          });
          $('.select-sidebar').click(function(e) {
            // alert('click');
            var data = $(this).val();
            $.get("/admin/layoutSet/0/"+data+"/0",
              function(data, textStatus, jqXHR) {
                jQuery("body").addClass(data)

              },
              "json"
            );
          });
          $('#mini_sidebar_setting').click(function(e) {
            // alert('click');
            var data = $(this).val();
            $.get("/admin/layoutSet/0/0/"+data,
              function(data, textStatus, jqXHR) {
                jQuery("body").addClass(data)

              },
              "json"
            );
          });
          $('#restore').click(function(e) { 
            e.preventDefault();

            $.get("/admin/restore",
              function(data, textStatus, jqXHR) {
              },
              "json"
            );
            location.reload(true);

          });
    </script>
@endpush
