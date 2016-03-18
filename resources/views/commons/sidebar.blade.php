<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="{{URL::to('home')}}" class="site_title">
                <i class="fa fa-file-text"></i>
                <span>Optimus</span>
            </a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Full name</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <div class="clearfix"></div>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-dashboard"></i> Dashboard <span class="fa fa-chevron-down"></span> </a>
                        <ul class="nav child_menu" style="display: none">
                          <li><a href="{{ url('/podcast/manage') }}">Manage Feeds</a></li>
                          <li><a href="{{ url('/podcast/manage_categories') }}">Manage Categories</a></li>
                          <li><a href="{{ url('/podcast/favorites') }}">Favorites</a></li>
                          <li><a href="{{ url('/podcast/player') }}">Listen</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Full name
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li><a href="#">Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('user/manage_categories') }}">Manage Categories</a></li>
                        <li><a href="{{URL::to('user/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        <li>
                            <a>
                                <span>
                                    <span>Full name</span>
                                </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
