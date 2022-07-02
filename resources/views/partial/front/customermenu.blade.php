<div class="collapse navbar-collapse order-3" id="navbarCollapse">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <form class="form-inline ml-0 ml-md-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- <li class="nav-item">
            <a href="#" class="nav-link">My Orders</a>
        </li> -->
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item">Some action </a></li>
                <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
        </li>
    </ul>
<!-- 
    <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form> -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link">My Orders</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-fw"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('customer.auth.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>