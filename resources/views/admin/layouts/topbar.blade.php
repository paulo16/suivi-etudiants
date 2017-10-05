<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="{{route('ADMIN')}}" class="logo"><i class="glyphicon glyphicon-font "></i><span>SECAM</span></a>
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <ul class="nav navbar-nav navbar-right pull-right">

                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                    class="icon-size-fullscreen"></i></a>
                    </li>
                    <li class="hidden-xs">
                        <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                    </li>
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown"
                           aria-expanded="true"><img src="{{asset('/assets/admin/images/users/avatar-1.jpg')}}"
                                                     alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a>
                            </li>
                            <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{route('logout')}}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="ti-power-off m-r-10 text-danger"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>