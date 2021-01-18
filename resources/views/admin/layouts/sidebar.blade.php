<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>

                @foreach ($routes as $menuName => $menuInfo)
                @php $class = "App\Models\\" . $menuInfo['class']; @endphp
                @if( empty($menuInfo['class']) || Auth::user()->can('viewAny', $class ) )

                <li>
                    <a href="javascript: void(0);">
                        <i class="{{ $menuInfo['icon'] }}"></i><span> {{ trans('menu.' . $menuName) }} </span>
                        @if($menuInfo['new'] == true)
                            <span class="label label-danger" style="font-size: 7px">NEW</span>
                        @endif
                    </a>
                    <ul class="nav-second-level" aria-expanded=false>
                        @foreach ($menuInfo['routes'] as $routeName => $routePath)

                          @if( strstr($routePath, 'index') && Auth::user()->can('viewAny', $class ) )
                          <li><a href="{{ route($routePath) }}">{{ trans('menu.' . $routeName) }}</a></li>
                          @endif
                          @if( strstr($routePath, 'create') && Auth::user()->can('create', $class ) )
                          <li><a href="{{ route($routePath) }}">{{ trans('menu.' . $routeName) }}</a></li>
                          @endif
                          @if( !strstr($routePath, 'index') && !strstr($routeName, 'new'))
                          <li><a href="{{ route($routePath) }}">{{ trans('menu.' . $routeName) }}</a></li>
                          @endif

                        @endforeach

                    </ul>
                </li>
@endif
                @endforeach



            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
