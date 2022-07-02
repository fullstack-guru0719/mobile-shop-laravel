<nav class="main-header navbar navbar-expand-md nav-theme navbar-light navbar-white">
    <div class="container">
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ url('assets/images/logo-bordered.png') }}" alt="TronicsPay Logo" class="brand-image b-image">
        </a>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('customer/dashboard') }}" class="nav-link {{ (isset($module) && $module == 'dashboard') ? 'active' : '' }}">
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('customer/my-bundles') }}" class="nav-link {{ (isset($module) && $module == 'mybundles') ? 'active' : '' }}">
                        <p>My Orders</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ url('customer/my-devices') }}" class="nav-link {{ (isset($module) && $module == 'mydevices') ? 'active' : '' }}">
                        <p>My Devices</p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="https://support.tronicspay.com" target="_blank" class="nav-link">
                        <p>FAQ & Support</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('customer/profile') }}" class="nav-link {{ (isset($module) && $module == 'profile') ? 'active' : '' }}">
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('customer.auth.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                </li>
            </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-danger navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li> -->
            <!-- <li class="nav-item dropdown show">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">
                    <i class="fa fa-cogs"></i>
                </a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                    <li>
                        <a href="{{ url('customer/profile') }}" class="nav-link font14px">
                            <i class="nav-icon fas fa-user fa-fw fontYellow"></i>
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a class="nav-link font14px" href="javascript:void(0)" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-fw fontYellow"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('customer.auth.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item">
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </li>
        </ul>
    </div>
</nav>

<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4 customer-sidebar">
    <a href="{{ url('home') }}" class="brand-link">
        <img src="{{ url('assets/images/logo-bordered.png') }}" alt="TronicsPay Logo" class="brand-image" style="opacity: .8;">
        <span>&nbsp;</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/').'/assets/dist/img/user4-128x128.jpg' }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Welcome {{ Auth::user()->fname.' '.Auth::user()->lname }}!</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ url('customer/dashboard') }}" class="nav-link {{ (isset($module) && $module == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('customer/my-bundles') }}" class="nav-link {{ (isset($module) && $module == 'mybundles') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>My Orders</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('customer/my-devices') }}" class="nav-link {{ (isset($module) && $module == 'mydevices') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>My Devices</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('customer/profile') }}" class="nav-link {{ (isset($module) && $module == 'profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>My Profile</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside> -->
