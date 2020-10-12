<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @php
    $setting = DB::table('setting')->where('id',1)->first();
    @endphp
    <title>@isset($setting->title) {{$setting->title}} @endisset || @isset($pageTitle) {{$pageTitle}}@endisset</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/app.min.css">

    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets') }}/img/favicon.ico' />
    <link rel="stylesheet" href="{{ asset('assets') }}/bundles/izitoast/css/iziToast.min.css">
    <link rel="stylesheet" href=" {{asset('assets') }}/bundles/jquery-selectric/selectric.css">

    @stack('css')

</head>

<body class="{{Helper::layouts()}}">
    <div id="app">
        <button class="btn-progress" hidden></button> <!-- heddin loding btn  -->
        <div class="main-wrapper main-wrapper-1">
            <progressbar-component></progressbar-component>
            <div id="loading">
                <div class="navbar-bg"></div>
                @include('layouts.parts.navbar')
                <div class="main-sidebar sidebar-style-2">
                    @include('layouts.parts.sidebar')
                    </ul>
                    </aside>
                </div>
                <!-- Main Content -->

                <div class="main-content">
                    @yield('content')
                </div>
                @include('layouts.parts.footer')
            </div>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets') }}/js/app.min.js"></script>
    <script src="{{ asset('assets') }}/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('assets') }}/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets') }}/js/custom.js"></script>
    <script src="{{ asset('assets') }}/bundles/izitoast/js/iziToast.min.js"></script>
    <script src="{{ asset('assets') }}/bundles/sweetalert/sweetalert.min.js"></script>
    @include('layouts.parts.myjs')
    @stack('js')


</body>

</html>
