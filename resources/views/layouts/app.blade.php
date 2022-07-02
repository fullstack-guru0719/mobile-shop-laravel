<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TronicsPay | Admin</title>
        <link rel="shortcut icon" href="{{ url('./library/images/favicon.ico') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ url('library/plugins/sweetalert/dist/sweetalert.css') }}">
        @yield('page-css')

                
        <style>
        .tooltip {
        position: relative;
        display: inline-block;
        }

        .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
        }
        </style>

        @if(isset($is_dark_mode) && $is_dark_mode == true)
            <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte-darkmode.min.css') }}">
        @else
            <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
        @endif
        <link rel="stylesheet" href="{{ url('css/admin-style.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>
    <body class="{{ (isset($is_dark_mode) && $is_dark_mode == true) ? 'dark-mode' : '' }} hold-transition sidebar-mini" data-url="{{ url('/') }}">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand {{ (isset($is_dark_mode) && $is_dark_mode == false) ? 'navbar-white navbar-light' : 'dark-mode-nav' }}">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{ url('assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{ url('assets/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>

                            <div class="dropdown-divider"></div>
                                        
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <img src="{{ url('assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>

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
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="javascript:void(0)" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            
            @include('partial.back.sidebar')
            @yield('content')
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> {{ config('app.version') }}
                </div>
                <strong>Copyright &copy; 2021 TronicsPay.</strong> All rights reserved.
            </footer>
        </div>

        <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        <script src="{{ url('assets/plugins/toastr/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('library/plugins/sweetalert/sweetalert_old.min.js')}}"></script>

        <script src="{{ url('library/js/jsfunctions.js') }}"></script>
        @yield('page-js')
        <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        
        <!-- <script>
            $(function () {   
                $('[data-toggle="popover"]').popover(); 
                $('[data-toggle="tooltip"]').tooltip();

                var baseUrl = $('body').attr('data-url');
                $.ajax({
                    type: "GET",
                    url: baseUrl+"/api/templates/sms/credits/remaining",
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 200) {
                            $('.navbar-sms-credit').html('$'+Math.round(response.model.cashCredits * 100) / 100);
                        }
                    }
                });
            });
        </script> -->
    </body>
</html>