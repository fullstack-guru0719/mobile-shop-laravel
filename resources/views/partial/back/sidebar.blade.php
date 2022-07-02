<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ url('assets/images/logo-bordered.png') }}" alt="TronicsPay Logo" class="brand-image" style="opacity: .8;">
        <span>&nbsp;</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (Auth::user() != null) ? Auth::user()->photo : '' }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ (isset($module) && $module == 'dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/orders') }}" class="nav-link {{ (isset($module) && $module == 'order') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/customers') }}" class="nav-link {{ (isset($module) && $module == 'customer') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/pagebuilder') }}" class="nav-link {{ (isset($module) && $module == 'page') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Pages</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/products') }}" class="nav-link {{ (isset($module) && $module == 'product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>Product List</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('admin/sorting') }}" class="nav-link {{ (isset($module) && $module == 'sorting') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sort-alpha-down"></i>
                        <p>Products Order</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="https://dashboard.tawk.to/" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-headset"></i>
                        <p>Live Chat</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="https://support.tronicspay.com/staff/login" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>Tickets</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ (isset($tvtemplates) && $tvtemplates == true) ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ (isset($tvtemplates) && $tvtemplates == true) ? 'active' : '' }}">
                        <i class="nav-icon fas fa fa-clone"></i>
                        <p>Templates<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/templates/email') }}" class="nav-link {{ (isset($module) && $module == 'email') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/templates/sms') }}" class="nav-link {{ (isset($module) && $module == 'sms') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Template</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-item has-treeview {{ (isset($tvproducts) && $tvproducts == 'product') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ (isset($tvproducts) && $tvproducts == 'product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-basket"></i>
                        <p>Products<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/products') }}" class="nav-link {{ (isset($module) && $module == 'product') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/products/map/condition') }}" class="nav-link {{ (isset($module) && $module == 'productmap') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Map</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="nav-item has-treeview {{ (isset($tvsettings) && $tvsettings == true) ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link {{ (isset($tvsettings) && $tvsettings == true) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/config') }}" class="nav-link {{ (isset($module) && $module == 'config') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Config</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/brands') }}" class="nav-link {{ (isset($module) && $module == 'brand') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/categories') }}" class="nav-link {{ (isset($module) && $module == 'category') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/menus') }}" class="nav-link {{ (isset($module) && $module == 'menu') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Menus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/status') }}" class="nav-link {{ (isset($module) && $module == 'status') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Status</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/phone-carriers') }}" class="nav-link {{ (isset($module) && $module == 'phone-carriers') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Phone Carriers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/phone-storages') }}" class="nav-link {{ (isset($module) && $module == 'phone-storages') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Phone Storages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/settings/users') }}" class="nav-link {{ (isset($module) && $module == 'user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- </li>
            </ul> -->
        </nav>
    </div>
</aside>
