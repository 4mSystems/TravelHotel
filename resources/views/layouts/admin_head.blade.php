
<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
                <li class="nav-item"><a href="{{url('home')}}" class="navbar-brand nav-link"><img alt="logo" src="{{ asset('/app-assets/images/logo/robust-logo-.png') }}"
                                                                                             data-expand="{{ asset('/app-assets/images/logo/robust-logo-.png') }}"
                                                                                             data-collapse="{{ asset('/app-assets/images/logo/robust-logo-.png') }}"
                                                                                             class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav">
                    <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5">         </i></a></li>
                    <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-xs-right">
                    <li class="dropdown dropdown-language nav-item">
                        <a id="dropdown-flag" href="#" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link">

                            @if(session('lang')=='en')
                                <i class="flag-icon flag-icon-gb"></i><span class="selected-language">English</span></a>
                        @else
                            <i class="flag-icon flag-icon-kw"></i><span class="selected-language">العربيه</span></a>
                        @endif
                        <div aria-labelledby="dropdown-flag" class="dropdown-menu">
                            <a href="{{url('lang/en')}}" class="dropdown-item">
                                <i class="flag-icon flag-icon-gb"></i> English</a>
                            <a href="{{url('lang/ar')}}" class="dropdown-item">
                                <i class="flag-icon flag-icon-kw"></i> العربيه</a>


                        </div>
                    </li>


                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown"
                           class="dropdown-toggle nav-link
                            dropdown-user-link">
                            <span class="avatar avatar-online">
                                <img src="{{ asset('/app-assets/images/portrait/small/12.jpg') }}" alt="avatar"><i></i></span>
                            <span class="user-name">
                         
                            </span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                   
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="icon-key"></i>{{trans('admin.logout')}}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- ////////////////////////////////////////////////////////////////////////////-->
