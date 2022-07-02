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
                                Just a quick reminder! We are just to follow up this order # <b style="color: #007bff;">{{ $customer_transaction['order_no'] }}</b>
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="row">
                            <div class="form-group col-md-12">

                                <div class="background: #fff;">
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div class="" style="vertical-align: top;">
                                                    <div class="pad10rem">From</div>
                                                    <div>
                                                        <div class="pad10rem"><strong>{{ $customer_transaction['customer']['fullname'] }}</strong><br></div>
                                                        <div class="pad10rem">{{ $customer_transaction['customer']['bill']['address1'] }}<br></div>
                                                        <div class="pad10rem">Phone: {{ $customer_transaction['customer']['bill']['phone'] }}<br></div>
                                                        <div class="pad10rem">Email: {{ $customer_transaction['customer']['email'] }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="" style="vertical-align: top;">
                                                    <div class="pad10rem">To</div>
                                                    <div>
                                                        <div class="pad10rem"><strong>{{ $config['company_name'] }}</strong><br></div>
                                                        <div class="pad10rem">{{ $config['address1'] }}<br></div>
                                                        <div class="pad10rem">Phone: {{ $config['address1'] }}<br></div>
                                                        <div class="pad10rem">Email: {{ $config['company_email'] }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="" style="vertical-align: top;">
                                                    <div class="pad10rem"><b>Transaction # {{ $customer_transaction['order_no'] }}</b></div>
                                                    <br />
                                                    <div class="pad10rem"><b>Tracking Code:</b> {{ $customer_transaction['tracking_code'] }}<br /></div>
                                                    <div class="pad10rem"><b>Status:</b> {{ $customer_transaction['status']['name'] }}<br /></div>
                                                    <div class="pad10rem"><b>Delivery Due:</b> {{ $customer_transaction['display_delivery_due'] }}<br /></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />
                                    <table class="table table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="7%">
                                                    <center>#</center>
                                                </th>
                                                <th width="23%" style="text-align: left;">Product</th>
                                                <th width="14%">
                                                    <center>Storage</center>
                                                </th>
                                                <th width="14%">
                                                    <center>Qty</center>
                                                </th>
                                                <th width="14%">
                                                    <center>Condition</center>
                                                </th>
                                                <th width="14%">
                                                    <center>Carrier</center>
                                                </th>
                                                <th width="14%" style="text-align: right;">Cash Offer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer_transaction['order_item'] as $key => $value)
                                            <?php
                                            $subTotal = $value['quantity'] * $value['amount'];
                                            $overallSubTotal = $overallSubTotal + $subTotal;
                                            $displayCounter = $counter + $key;
                                            ?>
                                            <tr>
                                                <td align="center">{{ $displayCounter }}</td>
                                                <td>{{ $value['product']['brand']['name'] }} {{ $value['product']['model'] }}</td>
                                                <td align="center">{{ $value['product_storage']['title'] }}</td>
                                                <td align="center">{{ $value['quantity'] }}</td>
                                                <td align="center">
                                                    @if ($value['device_type'] == 1)
                                                    <label class="label label-success">Excellent</label>
                                                    @elseif ($value['device_type'] == 2)
                                                    <label class="label label-info">Good</label>
                                                    @elseif ($value['device_type'] == 3)
                                                    <label class="label label-warning">Fair</label>
                                                    @else
                                                    <label class="label label-danger">Poor</label>
                                                    @endif
                                                </td>
                                                <td align="center">{{ $value['network']['title'] }}</td>
                                                <td align="right">${{ number_format($subTotal, 2, '.', ',') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" class="valign-top">
                                                <table width="100%">
                                                    <tr>
                                                        <td class="lead">Payment Method:</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pad10rem">{{ $customer_transaction['payment_method'] }}</td>
                                                    </tr>
                                                    @if ($customer_transaction['payment_method'] == "Bank Transfer")
                                                    <tr>
                                                        <td class="pad10rem"><b>Bank Name: </b>{{ $customer_transaction['account_bank'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pad10rem"><b>Account Name: </b>{{ $customer_transaction['account_name'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pad10rem"><b>Account Number: </b>{{ $customer_transaction['account_number'] }}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td class="pad10rem"><b>Account Username: </b>{{ $customer_transaction['account_username'] }}</td>
                                                    </tr>
                                                    @endif
                                                </table>
                                            </td>
                                            <td width="50%" class="valign-top">
                                                <table class="table" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:50%">Cash Offer:</th>
                                                            <td>${{ number_format($overallSubTotal, 2, '.', ',') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping:</th>
                                                            <td>FREE</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td>${{ number_format($overallSubTotal, 2, '.', ',') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
