<footer>
    <!-- footer top start -->
    <div class="footer-top bg-black pt-14 pb-14">
        <div class="container">
            <div class="footer-top-wrapper">
                <div class="newsletter__wrap">
                    <div class="newsletter__title">
                        <div class="newsletter__icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="newsletter__content">
                            <h3>sign up for newsletter</h3>
                        </div>
                    </div>
                    <div class="newsletter__box">
                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                        <form id="mc-form" method="POST" action="{{ url('subscribe') }}">
                            @csrf
                            <input type="email" id="mc-email" name="email" autocomplete="off" placeholder="Email"><br>


                            <button id="mc-submit">subscribe!</button>
                        </form>
                    </div>
                    <!-- mailchimp-alerts Start -->
                    <div class="mailchimp-alerts">
                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                        <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                        <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                    </div>
                    <!-- mailchimp-alerts end -->
                </div>
                @php
                $contact = Helper::contact();
                @endphp
                <div class="social-icons">
                    <a href="{{$contact->facebook_link}}" data-toggle="tooltip" data-placement="top" title="Facebook"><i
                            class="fa fa-facebook"></i></a>
                    <a href="{{$contact->twitter_link}}" data-toggle="tooltip" data-placement="top" title="Twitter"><i
                            class="fa fa-twitter"></i></a>
                    <a href="{{$contact->instagram_link}}" data-toggle="tooltip" data-placement="top"
                        title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="{{$contact->google_plus_link}}" data-toggle="tooltip" data-placement="top"
                        title="Google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="{{$contact->youtube_channal_link}}" data-toggle="tooltip" data-placement="top"
                        title="Youtube"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer top end -->

    <!-- footer main start -->
    <div class="footer-widget-area pt-40 pb-38 pb-sm-10">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>contact us</h4>
                        </div>

                        <div class="widget-body">
                            <ul class="location">
                                <li><i class="fa fa-envelope"></i>{{$contact->email}}</li>
                                <li><i class="fa fa-phone"></i>{{$contact->phone}}</li>
                                <li><i class="fa fa-map-marker"></i>{{$contact->address}}</li>
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>my account</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                <li><a href=" {{ url('/my-account') }} ">my account</a></li>
                                <li><a href="{{ url('/cart') }}">my cart</a></li>
                                <li><a href="{{ url('/checkout') }}">checkout</a></li>
                                <li><a href="{{ url('/wishlists') }}">my wishlist</a></li>
                                <li><a href="{{ url('/us-login') }}">login</a></li>
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>product types</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                @foreach (Helper::getAll('brands') as $item)
                                <li><a href="{{ url('brand', [$item->slug]) }}">{{$item->name}}</a></li>

                                <?php 
                                if ($loop->iteration == 5){
                                break;
                                }
                                ?>

                                @endforeach
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
                <div class="col-md-3 col-sm-6">
                    <div class="footer-widget mb-sm-30">
                        <div class="widget-title mb-10 mb-sm-6">
                            <h4>product types</h4>
                        </div>
                        <div class="widget-body">
                            <ul>
                                @foreach (Helper::getAll('types') as $item)
                                <li><a href="{{ url('type', [$item->slug]) }}">{{$item->name}}</a></li>
                                <?php 
                                if ($loop->iteration == 5){
                                break;
                                }
                                ?>
                                @endforeach
                            </ul>
                        </div>
                    </div> <!-- single widget end -->
                </div> <!-- single widget column end -->
            </div>
        </div>
    </div>
    <!-- footer main end -->

    <!-- footer bootom start -->
    <div class="footer-bottom-area bg-gray pt-20 pb-20">
        <div class="container">
            <div class="footer-bottom-wrap">
                <div class="copyright-text">
                    <p><a target="_blank" href="">@isset($setting->title) {{$setting->title}} @endisset </a></p>
                </div>
                <div class="payment-method-img">
                    <img src="{{ asset('frontEnd') }}/assets/img/payment.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- footer bootom end -->

</footer>
