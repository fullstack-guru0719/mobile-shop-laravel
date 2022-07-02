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
    </head>
    <body>
        <div class="content" style="background: #e4e4e4;">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div style="padding: 5%;">
                        <div style="border: 1px solid #777; background: #fff; padding: 15px;">
                            <div class="row">
                                <div class="form-group col-md-12" align="center">
                                    <img src="{{ url('./assets/images/logo.png')}}" class="img-fluid">
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="row">
                                <div class="form-group col-md-12" style="font-size: 20px;">
                                    <p>
                                        Hi
                                    </p>
                                    <p>
                                        Thank you for choosing and trusting TronicsPay.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>