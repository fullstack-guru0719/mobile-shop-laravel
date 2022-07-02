<!DOCTYPE html>
<html lang="en">
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
        <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/verification.css') }}">
        <link rel="stylesheet" href="{{ url('library/plugins/sweetalert/dist/sweetalert.css') }}">

    </head>
    <body data-url="{{ url('/') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div id="wrapper">
                            <div id="dialog">
                                <button class="close">×</button>
                                <h3>Please enter the 4-digit verification code we sent via SMS:</h3>
                                <span>(we want to make sure it's you before we contact our movers)</span>
                                <div id="form">
                                    <input type="text" name="input[]" id="input1" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" name="input[]" id="input2" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" name="input[]" id="input3" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <input type="text" name="input[]" id="input4" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                                    <button class="btn btn-primary btn-embossed" id="verify">Verify</button>
                                </div>
                                
                                <div>
                                    Didn't receive the code?<br />
                                    <a href="javascript:void(0);" id="resend-code">Send code again</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('library/plugins/sweetalert/sweetalert_old.min.js')}}"></script>
        <script src="{{ url('library/js/jsfunctions.js') }}"></script>
        <script src="{{ url('library/js/customer/verification.js') }}"></script>
    </body>
</html>