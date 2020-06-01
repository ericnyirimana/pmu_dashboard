<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <span>
                @svg('pmu-logo-base64', 'image-logo')
            </span>
            <i>
                @svg('pmu-small-logo', 'image-small-logo')
            </i>
        </a>
    </div>
    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#"
                   role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-pink noti-icon-badge">{{$totalNotifications}}</span>
                </a>

                @if($totalNotifications != 0)
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5><span
                                    class="badge badge-danger float-right">{{$totalNotifications}}</span>{{ __('labels.notifications_center') }}
                            </h5>
                        </div>
                    @if(Auth::user()->is_super)
                        @if($notifications['totMediaToApprove'] > 0)
                            <!-- item-->
                                <a href="{{ route('media.index') }}" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-info"></i></div>
                                    <p class="notify-details">{{ $notifications['totMediaToApprove'] }}  {{ __('labels.media_to_approve') }}</p>
                                </a>
                        @endif
                        @if($notifications['totProductsToApprove'] > 0)
                            <!-- item-->
                                <a href="{{ route('products.index') }}" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-info"></i></div>
                                    <p class="notify-details">{{ $notifications['totProductsToApprove'] }}  {{  __('labels.products_to_approve') }}</p>
                                </a>
                        @endif
                        @if($notifications['totMenusToApprove'] > 0)
                            <!-- item-->
                                <a href="{{ route('menu.index') }}" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-info"></i></div>
                                    <p class="notify-details">{{ $notifications['totMenusToApprove'] }}  {{  __('labels.menus_to_approve') }}</p>
                                </a>
                            @endif
                        @else
                            <a href="" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="icon-info"></i></div>

                                <p class="notify-details">{{ $totalNotifications }} @if($totalNotifications == 1){{
                                __('labels.new_order') }} @else {{__('labels.new_orders')}} @endif</p>
                            </a>
                        @endif
                    </div>

                @endif

            </li>


            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#"
                   role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <i class="fa fa-user fa-2x"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5 class="text-overflow">
                            <small>{{ __('labels.welcome') }}, {{ Auth::user()->name }}!</small>
                        </h5>
                    </div>

                    <!-- item-->
                    <a href="{{ route('users.profile') }}" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-circle"></i> <span>{{ __('labels.profile') }}</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-settings"></i> <span>{{ __('labels.settings') }}</span>
                    </a>

                    <!-- item
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="mdi mdi-lock-open"></i> <span>Lock Screen</span>
                    </a>
                    -->
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="dropdown-item notify-item" style="cursor: pointer;"><i
                                class="mdi mdi-power"></i> <span>{{ __('labels.logout') }}</span></button>
                    </form>

                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>
            <li class="hide-phone app-search">
                <form role="search" class="">
                    <input type="text" placeholder="{{ __('labels.search_placeholder') }}" class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>
            </li>
        </ul>

    </nav>

</div>
