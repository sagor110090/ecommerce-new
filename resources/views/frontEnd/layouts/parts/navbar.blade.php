<header>

    <!-- header top start -->
    <div class="header-top-area bg-gray text-center text-md-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="header-call-action">
                        <a href="#">
                            @php
                            $contact = Helper::contact();
                            @endphp
                            <i class="fa fa-envelope"></i>
                            {{$contact->email}}
                        </a>
                        <a href="#">
                            <i class="fa fa-phone"></i>
                            {{$contact->phone}}
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="header-top-right float-md-right float-none">
                        <nav>
                            <ul>
                                <li>
                                    <div class="dropdown header-top-dropdown">
                                        <a class="dropdown-toggle" id="myaccount" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            my account
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="myaccount">
                                            @if (Auth::check() == false)
                                            <a class="dropdown-item" href="{{ url('/login-register') }}"> login</a>
                                            <a class="dropdown-item" href="{{ url('/login-register') }}">register</a>
                                            @else
                                            <a class="dropdown-item" href="{{ url('/my-account') }}">my account</a>
                                            <a class="dropdown-item" href="{{ url('/user-logout') }}">Logout</a>

                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{ url('/wishlists') }}">my wishlist</a>
                                </li>
                                <li>
                                    <a href="{{url('/cart')}}">my cart</a>
                                </li>
                                <li>
                                    <a href="{{ url('/checkout') }}">checkout</a>
                                </li>
                                <li>
                                    <a href="{{ url('/compare') }}">compare list</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header top end -->

    <!-- header middle start -->
    <div class="header-middle-area pt-20 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="brand-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{Storage::url($setting->logo)}}" alt=" {{$setting->site_name}} ">
                        </a>
                    </div>
                </div> <!-- end logo area -->
                <div class="col-lg-9">
                    <div class="header-middle-right">
                        <div class="header-middle-shipping mb-20">
                            <div class="single-block-shipping">
                                <div class="shipping-icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <div class="shipping-content">
                                    <h5>Working time</h5>
                                    <span>{{$contact->working_day}}: {{$contact->working_hours}}</span>
                                </div>
                            </div> <!-- end single shipping -->

                            <div class="single-block-shipping">
                                <div class="shipping-icon">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="shipping-content">
                                    <h5>money back 100%</h5>
                                    <span>Within 30 Days after delivery</span>
                                </div>
                            </div> <!-- end single shipping -->
                        </div>
                        <div class="header-middle-block">
                            <form action="{{ url('/search') }}" class="search-form" method="get">
                                <input type="hidden" placeholder="Search..." id="search-input-set" name="search">

                            </form>

                            <div class="header-middle-searchbox">
                                <input type="text" placeholder="Search..." id="search-input-get" name="search">
                                <button class="search-btn" id="search"><i class="fa fa-search"></i></button>
                            </div>
                            <div class="header-mini-cart">
                                <div class="mini-cart-btn">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span class="cart-notification">
                                        <div id="cartTotalQuantity"></div>
                                    </span>
                                </div>
                                <div class="cart-total-price" id="sub-total">
                                    <span>total</span>
                                </div>
                                <ul class="cart-list">
                                    <div id="cart-preview"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header middle end -->

    <!-- main menu area start -->
    <div class="main-header-wrapper bdr-bottom1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-header-inner">
                        <div class="category-toggle-wrap">
                            <div class="category-toggle">
                                category
                                <div class="cat-icon">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <nav class="category-menu {{ Request::is('/') ? 'hm-1':''}} ">
                                <ul>
                                    @foreach (Helper::categories() as $category)
                                    @php
                                    if ($loop->iteration == 10){
                                    break;
                                    }
                                    @endphp
                                    <li class="menu-item-has-children"><a
                                            href="{{ url('shop/category', [$category->slug]) }}"><img
                                                id="category-image" src="{{Storage::url($category->image)}}"
                                                alt="">&nbsp;&nbsp;&nbsp;{{$category->name}}</a>
                                        <!-- Mega Category Menu Start -->
                                        @if (count($category->subCategory) != 0)
                                        <ul class="category-mega-menu">
                                            @foreach ($category->subCategory as $subCategory)
                                            <li class="menu-item-has-children">
                                                <a
                                                    href="{{ url('shop/sub-category', [$subCategory->slug]) }}">{{$subCategory->name}}</a>
                                                <ul>
                                                    @foreach ($subCategory->miniCategory as $miniCategory)
                                                    <li><a href="{{ url('shop/mini-category', [$miniCategory->slug]) }}"
                                                            class="subCategory-link">{{$miniCategory->name}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul><!-- Mega Category Menu End -->
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="active"><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home </a>
                                    </li>
                                    <li><a href="{{ url('/shop') }}">shop </a>

                                    </li>
                                    <li><a href="{{ url('blog') }}">Blog </a>
                                    </li>
                                    <li><a href="{{ url('contact-us') }}">Contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- main menu area end -->

</header>
