<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                        collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>

        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
                <span class="badge headerBadge1">
                    {{App\Order::where('show',0)->count()}} </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    All Notification
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    @forelse (App\Order::where('show',0)->get() as $item)
                    <a href="{{ url('admin/invoice/'.$item->id) }}" class="dropdown-item"> <span class="dropdown-item-avatar
                                    text-white"> <img alt="image" src="{{ asset('assets') }}/img/order.png"
                                class="rounded-circle">
                        </span> <span class="dropdown-item-desc"> <span
                                class="message-user">{{$item->customer->user->fname.' '.$item->customer->user->lname}}</span>
                            <span class="time messege-text">Please check the order!!</span>
                            <span class="time">{{Helper::notificationTime($item->created_at)}} </span>
                        </span>
                    </a>
                    @empty
                    <span class="dropdown-item">NO NOtification </span>
                    @endforelse

                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="{{AUth::user()->image ? Storage::url(AUth::user()->image) : asset('assets') .'/img/users/user-8.png'}}"
                    class="user-img-radious-style"><span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello {{Auth::user()->fname.' '.Auth::user()->lname}}</div>
                <a href="{{ url('admin/profile') }}" class="dropdown-item has-icon"> <i class="far
                            fa-user"></i> Profile
                </a> <a href="{{ url('admin\activities') }}" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                    Activities
                </a> <a href="{{ url('admin\settings') }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"> <i
                        class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
