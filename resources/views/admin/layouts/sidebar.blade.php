<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>

                @foreach ($routes as $menuName => $menuInfo)
                <li>
                    <a href="javascript: void(0);">
                        <i class="{{ $menuInfo['icon'] }}"></i><span> {{ $menuName }} </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @foreach ($menuInfo['routes'] as $routeName => $routePath)
                          <li><a href="{{ route($routePath) }}">{{ $routeName }}</a></li>
                        @endforeach

                    </ul>
                </li>

                @endforeach



            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
