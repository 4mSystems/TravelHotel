<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">

    <!-- main menu content-->
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

            <li class=" nav-item">
                <a href="{{url('home')}}"><i class="icon-home3"></i>
                    <span data-i18n="nav.dash.main"
                          class="menu-title">{{trans('admin.nav_home')}}</span></a>

            </li>

            <li class=" nav-item">
                <a href="{{url('super_Admin')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_add_Super_Admin')}}</span></a>

            </li>

            <li class=" nav-item">
                <a href="{{url('provider')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_Provider')}}</span></a>

            </li>


        </ul>

        {{--        </ul>--}}
    </div>
    <!-- /main menu content-->

</div>
<!-- / main menu-->
