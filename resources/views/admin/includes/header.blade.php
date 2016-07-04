<header class="header white-bg">
    <!--logo start-->
    <a href="{{url('/admin')}}" class="logo">Depot<span>Dash</span></a>
    <!--logo end-->
    <div class="top-nav ">
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder="Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">                    
                    <span class="username">{{(Auth::guard('admin')->user()->name)}}</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>                                 
                    <li><a href="{{route('admin-logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>           
        </ul>
    </div>
</header>
