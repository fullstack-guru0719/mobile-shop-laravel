<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TronicsPay</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{ url('/library/plugins/fontawesome/css/font-awesome.css') }}"> -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/admin-style.css') }}">
    <style>
        body {
            /* background: #e4e4e4; */
        }

        body,
        td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .bordered {
            border: 1px solid #000;
        }

        .table:not(.table-dark) {
            color: inherit;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }

        table {
            border-collapse: collapse;
        }

        table {
            // border-collapse: separate;
            text-indent: initial;
            border-spacing: 2px;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .table th,
        .table td {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .valign-top {
            vertical-align: top;
        }

        .label {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }

        .label-default {
            background-color: #777;
        }

        .label-primary {
            background-color: #337ab7;
        }

        .label-success {
            background-color: #5cb85c;
        }

        .label-info {
            background-color: #5bc0de;
        }

        .label-warning {
            background-color: #f0ad4e;
        }

        .label-danger {
            background-color: #d9534f;
        }

        .pad10rem {
            padding: .10rem;
        }

        .lead {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.25rem;
            font-weight: 300;
        }

        img {
            display: block
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div style="padding: 50px;">
                    <div style="padding: 15px;">
                        <div class="row">
                            <div class="form-group col-md-12" align="center">
                                <img src="{{ url('./assets/images/logo.png')}}">
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="row">
                            <div class="form-group col-md-12" style="font-size: 20px;">
                                Howdy {{ $fname }},<br><br>
                                Thank you for selling a device {{ $model }} to us.
                                We currently reviewing your application and we will get back to you as soon as possible.<br><br>
                                You can see your device by logging in to your account<br /> <br />
                                <p>Regards,<br><b>TronicsPay</b></p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>