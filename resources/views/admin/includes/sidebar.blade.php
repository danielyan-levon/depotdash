<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a class="{{ (Request::is('admin/dashboard') ? "active" : '') }}" href="{{ url ('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a class="{{ (Request::is('admin/administrators/create') ? "active" : '') }}" href="{{ route ('admin.administrators.create') }}">
                    <i class="fa fa-user"></i>
                    <span>Account Admins</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ ((Request::is('admin/customer') || Request::is('admin/customer/create'))  ? "active" : '') }}" href="{{ url ('admin/customers') }}">
                    <i class="fa fa-users"></i>
                    <span>Customers</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{ route ('admin.customer.index') }}" class="{{ (Request::is('admin/customers') ? "active" : '') }}">Show Customers</a></li>
                    <li><a  href="{{ route ('admin.customer.create') }}" class="{{ (Request::is('admin/customer/create') ? "active" : '') }}">Add Customer</a></li>                        
                </ul>
            </li>

            <li>
                <a class="{{ (Request::is('admin/orders') ? "active" : '') }}" href="{{ url ('admin/orders') }}">
                    <i class="fa fa-first-order"></i>
                    <span>Orders</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>