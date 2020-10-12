<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ url('/dashboard') }}"> <img alt="image" src="{{ asset('assets') }}/img/logo.png"
                class="header-logo" /> <span class="logo-name">Ecommerce</span>
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main</li>
        <li class="dropdown {{ Request::is('dashboard') ? 'active':''}}">
            <a href="{{ url('/dashboard') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
        </li>
        @if(Helper::authCheck("product-show") || Helper::authCheck("product-create")) <li
            class="dropdown {{ Request::is("admin/product*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Product </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("product-create"))<li
                    class="{{ Request::is("admin/product/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/product/create") }}">New Product</a></li> @endif
                @if(Helper::authCheck("product-show")) <li class="{{ Request::is("admin/product") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/product") }}">Product List</a></li> @endif </ul>
        </li> @endif

        @if(Helper::authCheck("purchaseitem-show") || Helper::authCheck("purchaseitem-create")) <li
            class="dropdown {{ Request::is("admin/purchase-item*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Purchase Item </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("purchaseitem-create"))<li
                    class="{{ Request::is("admin/purchase-item/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/purchase-item/create") }}">New Purchase Item</a></li> @endif
                @if(Helper::authCheck("purchaseitem-show")) <li
                    class="{{ Request::is("admin/purchase-item") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/purchase-item") }}">Purchase Item List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("order-list"))
        <li class="dropdown {{ Request::is('admin/order*') ? 'active':''}}">
            <a href="{{ url('admin/order') }}" class="nav-link"><i data-feather="file"></i><span>Order
                    Management</span></a>
        </li>
        @endif
        @if(Helper::authCheck("customer-list"))
        <li class="dropdown {{ Request::is('admin/customer*') ? 'active':''}}">
            <a href="{{ url('admin/customer') }}" class="nav-link"><i data-feather="file"></i><span>Customer
                    List</span></a>
        </li>
        @endif
        <li class="menu-header">Administration</li>
        @if (Auth::user()->role == 'Super Admin')
        <li class="dropdown {{ Request::is('admin/user*') ? 'active':''}}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>User
                    Management</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('admin/user/create*') ? 'active':''}}"><a class="nav-link"
                        href="{{ url('admin/user/create') }}">New User</a></li>
                <li class="{{ Request::is('admin/user') ? 'active':''}}"><a class="nav-link"
                        href="{{ url('admin/user') }}">User List</a></li>
            </ul>
        </li>
        <li class="dropdown {{ Request::is('admin/role*') ? 'active':''}}">
            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>Role
                    Management</span></a>
            <ul class="dropdown-menu">
                <li class="{{ Request::is('admin/role/create*') ? 'active':''}}"><a class="nav-link"
                        href="{{ url('admin/role/create') }}">New Role</a></li>
                <li class="{{ Request::is('admin/role') ? 'active':''}}"><a class="nav-link"
                        href="{{ url('admin/role') }}">Role List</a></li>
            </ul>
        </li>
        @endif
        <li class="dropdown {{ Request::is('admin/email*') ? 'active':''}}">
            <a href="{{ url('admin/email/send') }}" class="nav-link"><i data-feather="mail"></i><span>Email
                    Management</span></a>
        </li>

        <li class="menu-header">Product Setup</li>

        @if(Helper::authCheck("category-show") || Helper::authCheck("category-create")) <li
            class="dropdown {{ Request::is("admin/category*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Category </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("category-create"))<li
                    class="{{ Request::is("admin/category/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/category/create") }}">New Category</a></li> @endif
                @if(Helper::authCheck("category-show")) <li class="{{ Request::is("admin/category") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/category") }}">Category List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("subcategory-show") || Helper::authCheck("subcategory-create")) <li
            class="dropdown {{ Request::is("admin/sub-category*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Sub Category </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("subcategory-create"))<li
                    class="{{ Request::is("admin/sub-category/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/sub-category/create") }}">New Sub Category</a></li> @endif
                @if(Helper::authCheck("subcategory-show")) <li
                    class="{{ Request::is("admin/sub-category") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/sub-category") }}">Sub Category List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("minicategory-show") || Helper::authCheck("minicategory-create")) <li
            class="dropdown {{ Request::is("admin/mini-category*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Mini Category </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("minicategory-create"))<li
                    class="{{ Request::is("admin/mini-category/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/mini-category/create") }}">New Mini Category</a></li> @endif
                @if(Helper::authCheck("minicategory-show")) <li
                    class="{{ Request::is("admin/mini-category") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/mini-category") }}">Mini Category List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("type-show") || Helper::authCheck("type-create")) <li
            class="dropdown {{ Request::is("admin/type*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Type </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("type-create"))<li
                    class="{{ Request::is("admin/type/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/type/create") }}">New Type</a></li> @endif
                @if(Helper::authCheck("type-show")) <li class="{{ Request::is("admin/type") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/type") }}">Type List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("brand-show") || Helper::authCheck("brand-create")) <li
            class="dropdown {{ Request::is("admin/brand*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Brand </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("brand-create"))<li
                    class="{{ Request::is("admin/brand/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/brand/create") }}">New Brand</a></li> @endif
                @if(Helper::authCheck("brand-show")) <li class="{{ Request::is("admin/brand") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/brand") }}">Brand List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("size-show") || Helper::authCheck("size-create")) <li
            class="dropdown {{ Request::is("admin/size*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Size </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("size-create"))<li
                    class="{{ Request::is("admin/size/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/size/create") }}">New Size</a></li> @endif
                @if(Helper::authCheck("size-show")) <li class="{{ Request::is("admin/size") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/size") }}">Size List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("color-show") || Helper::authCheck("color-create")) <li
            class="dropdown {{ Request::is("admin/color*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Color </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("color-create"))<li
                    class="{{ Request::is("admin/color/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/color/create") }}">New Color</a></li> @endif
                @if(Helper::authCheck("color-show")) <li class="{{ Request::is("admin/color") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/color") }}">Color List</a></li> @endif </ul>
        </li> @endif

        @if(Helper::authCheck("supplier-show") || Helper::authCheck("supplier-create")) <li
            class="dropdown {{ Request::is("admin/supplier*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Supplier </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("supplier-create"))<li
                    class="{{ Request::is("admin/supplier/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/supplier/create") }}">New Supplier</a></li> @endif
                @if(Helper::authCheck("supplier-show")) <li class="{{ Request::is("admin/supplier") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/supplier") }}">Supplier List</a></li> @endif </ul>
        </li> @endif
        <li class="menu-header">Site Setup</li>

        @if(Helper::authCheck("slider-show") || Helper::authCheck("slider-create")) <li
            class="dropdown {{ Request::is("admin/slider*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Slider </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("slider-create"))<li
                    class="{{ Request::is("admin/slider/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/slider/create") }}">New Slider</a></li> @endif
                @if(Helper::authCheck("slider-show")) <li class="{{ Request::is("admin/slider") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/slider") }}">Slider List</a></li> @endif </ul>
        </li> @endif

        @if(Helper::authCheck("banner-edit"))
        <li class="dropdown {{ Request::is('admin/banner*') ? 'active':''}}">
            <a href="{{ url('admin/banner') }}" class="nav-link"><i data-feather="file"></i><span>Banner Set
                </span></a>
        </li>
        @endif

        @if(Helper::authCheck("country-show") || Helper::authCheck("country-create")) <li
            class="dropdown {{ Request::is("admin/country*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Set Country </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("country-create"))<li
                    class="{{ Request::is("admin/country/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/country/create") }}">New Country</a></li> @endif
                @if(Helper::authCheck("country-show")) <li class="{{ Request::is("admin/country") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/country") }}">Country List</a></li> @endif </ul>
        </li> @endif

        @if(Helper::authCheck("blog-show") || Helper::authCheck("blog-create")) <li
            class="dropdown {{ Request::is("admin/blog*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Blog </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("blog-create"))<li
                    class="{{ Request::is("admin/blog/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/blog/create") }}">New Blog</a></li> @endif
                @if(Helper::authCheck("blog-show")) <li class="{{ Request::is("admin/blog") ? "active":""}}"><a
                        class="nav-link" href="{{ url("admin/blog") }}">Blog List</a></li> @endif </ul>
        </li> @endif

        @if(Helper::authCheck("shippingcharge-show") || Helper::authCheck("shippingcharge-create")) <li
            class="dropdown {{ Request::is("admin/shipping-charge*") ? "active":""}}"> <a href="#"
                class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Shipping Charge </span></a>
            <ul class="dropdown-menu"> @if(Helper::authCheck("shippingcharge-create"))<li
                    class="{{ Request::is("admin/shipping-charge/create*") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/shipping-charge/create") }}">New Shipping Charge</a></li> @endif
                @if(Helper::authCheck("shippingcharge-show")) <li
                    class="{{ Request::is("admin/shipping-charge") ? "active":""}}"><a class="nav-link"
                        href="{{ url("admin/shipping-charge") }}">Shipping Charge List</a></li> @endif </ul>
        </li> @endif
        @if(Helper::authCheck("paypal-edit"))
        <li class="dropdown {{ Request::is('admin/paypal-info*') ? 'active':''}}">
            <a href="{{ url('admin/paypal-info') }}" class="nav-link"><i data-feather="file"></i><span>Paypal Info
                </span></a>
        </li>
        @endif
        @if(Helper::authCheck("contact-edit"))
        <li class="dropdown {{ Request::is('admin/contact*') ? 'active':''}}">
            <a href="{{ url('admin/contact-us') }}" class="nav-link"><i data-feather="file"></i><span>Contact
                </span></a>
        </li>
        @endif
        @if(Helper::authCheck("newsletter-show"))
        <li class="dropdown {{ Request::is('admin/newsletter*') ? 'active':''}}">
            <a href="{{ url('admin/newsletters') }}" class="nav-link"><i data-feather="file"></i><span>Newsletter
                </span></a>
        </li>
        @endif
        @if(Helper::authCheck("termsAndConditions-edit"))
        <li class="dropdown {{ Request::is('admin/terms-and-conditions*') ? 'active':''}}">
            <a href="{{ url('admin/terms-and-conditions') }}" class="nav-link"><i data-feather="file"></i><span>Terms
                    And Conditions
                </span></a>
        </li>
        @endif
        @if(Helper::authCheck("setting-edit"))
        <li class="dropdown {{ Request::is('admin/setting*') ? 'active':''}}">
            <a href="{{ url('admin/setting') }}" class="nav-link"><i data-feather="file"></i><span>Setting
                </span></a>
        </li>
        @endif

@if(Helper::authCheck("offer-show") || Helper::authCheck("offer-create")) <li class="dropdown {{ Request::is("admin/offer*") ? "active":""}}"> <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="copy"></i><span>Offer </span></a><ul class="dropdown-menu"> @if(Helper::authCheck("offer-create"))<li class="{{ Request::is("admin/offer/create*") ? "active":""}}"><a class="nav-link" href="{{ url("admin/offer/create") }}">New Offer</a></li> @endif  @if(Helper::authCheck("offer-show")) <li class="{{ Request::is("admin/offer") ? "active":""}}"><a class="nav-link" href="{{ url("admin/offer") }}">Offer List</a></li> @endif </ul></li> @endif