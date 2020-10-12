<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    @php
    $setting = DB::table('setting')->where('id',1)->first();
    @endphp
    <title> @isset($setting->title) {{$setting->title}} @endisset || @isset($pageTitle) {{$pageTitle}}@endisset</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href=" {{Storage::url($setting->favicon)}} " type="image/x-icon" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontEnd') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="{{ asset('frontEnd') }}/assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- helper class css -->
    <link href="{{ asset('frontEnd') }}/assets/css/helper.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="{{ asset('frontEnd') }}/assets/css/plugins.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="{{ asset('frontEnd') }}/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets') }}/bundles/izitoast/css/iziToast.min.css">


    @stack('css')

</head>

<body>
    <div class="loader"></div>
    @if(session('success'))
    <!-- Small modal -->
    @endif
    <div class="wrapper" id="app">

        <!-- header area start -->

        @include('frontEnd.layouts.parts.navbar')
        <!-- header arebreadcrumba end -->
        @yield('content')
        <!-- footer area start -->
        @include('frontEnd.layouts.parts.footer')
        <!-- footer area end -->

    </div>
    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div id="product-quick-view" class="col-lg-5">
                                <div class="product-large-slider slick-arrow-style_2 mb-20">
                                    <div class="pro-large-img">
                                        <img src="http://127.0.0.1:8000/assets/img/product/product-details-img1.jpg"
                                            alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="http://127.0.0.1:8000/assets/img/product/product-details-img2.jpg"
                                            alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="http://127.0.0.1:8000/assets/img/product/product-details-img3.jpg"
                                            alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="http://127.0.0.1:8000/assets/img/product/product-details-img4.jpg"
                                            alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="http://127.0.0.1:8000/assets/img/product/product-details-img5.jpg"
                                            alt="" />
                                    </div>
                                </div>
                                <div class="pro-nav slick-padding2 slick-arrow-style_2">
                                    <div class="pro-nav-thumb"><img
                                            src="http://127.0.0.1:8000/assets/img/product/product-details-img1.jpg"
                                            alt="" /></div>
                                    <div class="pro-nav-thumb"><img
                                            src="http://127.0.0.1:8000/assets/img/product/product-details-img2.jpg"
                                            alt="" /></div>
                                    <div class="pro-nav-thumb"><img
                                            src="http://127.0.0.1:8000/assets/img/product/product-details-img3.jpg"
                                            alt="" /></div>
                                    <div class="pro-nav-thumb"><img
                                            src="http://127.0.0.1:8000/assets/img/product/product-details-img4.jpg"
                                            alt="" /></div>
                                    <div class="pro-nav-thumb"><img
                                            src="http://127.0.0.1:8000/assets/img/product/product-details-img5.jpg"
                                            alt="" /></div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des mt-md-34 mt-sm-34">
                                    <div id="quick-product-info">
                                        <h3><a href="product-details.html">external product 12</a></h3>

                                        <div id="product-availability" class="availability mt-10">
                                            <h5>Availability:</h5>
                                            <span>1 in stock</span>
                                        </div>
                                        <div class="pricebox" id="price-pricebox">
                                            <span class="regular-price">$160.00</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                            eirmod
                                            tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                                            voluptua.<br>
                                            Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse
                                            platea
                                            dictumst. Suspendisse ultrices mauris diam. Nullam sed aliquet elit. Mauris
                                            consequat nisi ut mauris efficitur lacinia.</p>
                                    </div>
                                    <div class="quantity-cart-box d-flex align-items-center mt-20">
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="text" class="quantity-value" min="1"
                                                    value="1"></div>
                                        </div>
                                        <div class="action_link" id="quickViewCartBtn">
                                            <a class="buy-btn" href="#">add to cart<i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

    <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
    <script src="{{ asset('frontEnd') }}/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- Jquery Min Js -->
    <script src="{{ asset('frontEnd') }}/assets/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Popper Min Js -->
    <script src="{{ asset('frontEnd') }}/assets/js/vendor/popper.min.js"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('frontEnd') }}/assets/js/vendor/bootstrap.min.js"></script>
    <!-- Plugins Js-->
    <script src="{{ asset('frontEnd') }}/assets/js/plugins.js"></script>

    <script src="{{ asset('assets') }}/bundles/izitoast/js/iziToast.min.js"></script>

    <!-- Active Js -->
    <script src="{{ asset('frontEnd') }}/assets/js/main.js"></script>
    <!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
    <script src="{{ asset('assets') }}/bundles/sweetalert/sweetalert.min.js"></script>
    <script src="{{ asset('frontEnd') }}/assets/js/custom.js"></script>
    <script>
        @if(Session::has('success'))
        iziToast.success({
            title: '{{Session::get('
            success ')}}',
            message: '',
            position: 'topRight'
        });
        @endif
        @if(Session::has('warning'))
        iziToast.warning({
            title: '{{Session::get('
            warning ')}}',
            position: 'topRight'
        });
        @endif

    </script>
    @stack('js')
</body>

</html>
