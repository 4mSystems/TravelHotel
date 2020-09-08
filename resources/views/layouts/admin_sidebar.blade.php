<!-- main menu-->
<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">

    <!-- main menu content-->

    <br>
    <br>
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

            <li class=" nav-item">
                <a  href="{{url('home')}}"><i class="icon-home3"></i>
                    <span data-i18n="nav.dash.main"
                          class="menu-title">{{trans('admin.nav_home')}}</span></a>

            </li>

            

            @if(Auth::user()->type == "provider")
            <li class=" nav-item">
                <a href="{{url('ads')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_ads')}}</span></a>

            </li>
            @endif
            
            @if(Auth::user()->type == "super admin")

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
            <li class=" nav-item">
                <a href="{{url('ads_admin')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_ads_admin')}}</span></a>

            </li>

            <li class=" nav-item">
                <a href="{{url('category')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_cat')}}</span></a>

            </li>

            <li class=" nav-item">
                <a href="{{url('notifications')}}"><i class="icon-users"></i>
                    <span data-i18n="nav.dash.main"
                            class="menu-title">{{trans('admin.nav_send_notif')}}</span></a>

            </li>
            @endif


        </ul>

        {{--        </ul>--}}
    </div>
    <!-- /main menu content-->

</div>
<!-- / main menu-->
