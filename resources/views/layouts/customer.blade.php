
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TronicsPay</title>
        <link rel="shortcut icon" href="{{ url('./library/images/favicon.ico') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">

        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/plugins/toastr/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ url('library/plugins/sweetalert/dist/sweetalert.css') }}">
        <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
        @yield('page-css')
        <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/admin-style.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <style>
            .container, .container-md, .container-sm {
                max-width: 1000px !important;
            }
        </style>
    </head>
    <body class="hold-transition layout-top-nav" data-url="{{ url('/') }}">
        <div class="wrapper">

            @include('partial.front.sidebar')

            @yield('content')

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> {{ config('app.version') }}
                </div>
                <strong>Copyright &copy; 2021 TronicsPay.</strong> All rights reserved.
            </footer>
        </div>

        <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
        
        <script src="{{ url('assets/plugins/toastr/toastr.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('library/plugins/sweetalert/sweetalert_old.min.js')}}"></script>

        <script src="{{ url('library/js/jsfunctions.js') }}"></script>
        <script src="{{ url('library/js/customer/components.js') }}"></script>
        @yield('page-js')
    </body>
</html>
