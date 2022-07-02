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

        .page-sub-header {
            font-weight: bold;
            color: #17c119;
            font-size: 18px;
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

        .font12 {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div style="padding: 10px;">
                    <div>
                        <!-- <div style="border: 1px solid #777; background: #fff; padding: 15px;"> -->
                        <div class="row">
                            <div class="form-group col-md-12" align="center">
                                <img src="{{ url('./assets/images/logo.png')}}">
                            </div>
                        </div>
                        <br />
                        <br />
                        <div class="row">
                            <div class="form-group col-md-12" style="font-size: 20px;">
                                <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <tbody>
                                        <!-- <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <td class="content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                          {!! $header !!}
                                        </td>
                                      </tr> -->
                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <td class="content-block" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                <p class="font12">
                                                    Howdy {{ $fname }} {{ $lname }},<br><br>
                                                    We're excited that you've decided to sell your device to TronicsPay.

                                                    We currently reviewing your application and we will get back to you as soon as possible.

                                                    To print your free shipping label you can click <a clicktracking="off" href="{{ url('order/'.$order['hashedId'].'/shippinglabel') }}" target="_blank">here</a>.
                                                </p>
                                                <?php if ($isRegistered == false) { ?>
                                                <p class="font12">
                                                    We also created an account for you, you can login at <a href="{{ url('customer/auth/login') }}" target="_blank">Member Login</a> using these email {{ $email }} with the password <b>{{ $password }}</b>.
                                                </p>
                                                <?php } ?>
                                                <p>
                                                    <span class="page-sub-header">Shipping to TronicsPay:</span>
                                                </p>
                                                <div style="margin-left: 15px;">
                                                    <table width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 1. -->
                                                                </td>
                                                                <td width="97%">
                                                                    1. Prepare your device for shipping by following this
                                                                    <a href="{{ url('/library/docs/Shipping-checklist.pdf') }}" target="_blank">checklist</a>.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 2. -->
                                                                </td>
                                                                <td width="97%">
                                                                    2. Make sure your Apple / Android device is not iCloud / Google Locked. Also make sure your device is not financed / debt to any carrier. We can still buy your item but will greatly reduce your cash offer.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 3. -->
                                                                </td>
                                                                <td width="97%">
                                                                    3. When selling Samsung and Apple smart watches please include the charger.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 4. -->
                                                                </td>
                                                                <td width="97%">
                                                                    4. Find a strong box with plenty of packing materials to pack your Phone. We do not offer boxes. Any box of your choice will do fine.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 5. -->
                                                                </td>
                                                                <td width="97%">
                                                                    5. Pack your item in the box with plenty of packing materials. Tape your prepaid shipping label to the box.
                                                                    To print your prepaid shipping label click <a clicktracking="off" href="{{ url('order/'.$order['hashedId'].'/shippinglabel') }}" target="_blank">here</a>. <br />
                                                                    Feel free to include any orginal boxes, accessories, and chargers in your shipment.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    <!-- 6. -->
                                                                </td>
                                                                <td width="97%">
                                                                    6. Drop your box off for shipping at the nearest USPS location. Find the closest location
                                                                    <a href="https://tools.usps.com/find-location.htm" target="_blank">here</a>.
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br />
                                                <br />
                                                <p>
                                                    <span class="page-sub-header">Make sure "Find my iPhone" is turned off</span>
                                                    <br />
                                                    <br />
                                                    <span class="font12">
                                                        Leaving this feature on will lock your device and delay or reduce your payment. Before sending us your device, here are the steps to deactivate:
                                                    </span>
                                                </p>
                                                <div style="margin-left: 15px;">
                                                    <table width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    1.
                                                                </td>
                                                                <td width="97%">
                                                                    Find and tap the "Settings" icon on your device.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    2.
                                                                </td>
                                                                <td width="97%">
                                                                    Tap iCloud from the menu.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="3%" class="valign-top" align="center">
                                                                    3.
                                                                </td>
                                                                <td width="97%">
                                                                    If "Find My iPhone" is on, tap the slider to turn it off.
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br />
                                                <br />
                                                <br />
                                                <p>
                                                    <span class="page-sub-header">7-days price guarantee</span>
                                                    <br />
                                                    <br />
                                                    <span class="font12">
                                                        Price may decline / decrease after the 7 day price guarantee. We do not want you to miss out on higher prices.
                                                    </span>
                                                </p>
                                                <br />
                                                <div style="margin-left: 15px;">
                                                    <table width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td width="5%" class="valign-top" align="center">
                                                                    <img src="{{ url('./library/images/play.png')}}" width="30px">
                                                                </td>
                                                                <td width="95%" style="vertical-align: center;">
                                                                    For a visual guide on how to turn off "Find My iPhone,"
                                                                    <a href="https://www.youtube.com/watch?v=botPDGC2wS0&ab_channel=NorthvilleTech" target="_blank">watch this video</a>.
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br />
                                                <p class="font12">
                                                    We'll let you know as soon as we receive your item. If you have any questions along the way, you can
                                                    <a href="{{$order['shipping_tracker']}}" target="_blank">
                                                        check the status of your item on our website
                                                    </a> or
                                                    <a href="https://support.tronicspay.com" target="_blank">
                                                        visit our help center.
                                                    </a>
                                                </p>

                                                <hr />
                                                <div class="row">
                                                    <div class="form-group col-md-12" style="border: 2px solid #dfdfdf;">

                                                        <div class="background: #fff;">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td>
                                                                        <div class="" style="vertical-align: top;">
                                                                            <div class="pad10rem">From</div>
                                                                            <div>
                                                                                <div class="pad10rem"><strong>{{ $order['customer']['fullname'] }}</strong><br></div>
                                                                                <div class="pad10rem">{{ $order['customer']['bill']['address1'] }}<br></div>
                                                                                <div class="pad10rem">{{ $order['customer']['bill']['city'] }}, {{ $order['customer']['bill']['state'] }} <br></div>
                                                                                <div class="pad10rem">{{ $order['customer']['bill']['zip'] }}<br></div>
                                                                                <div class="pad10rem">Phone: {{ $order['customer']['bill']['phone'] }}<br></div>
                                                                                <div class="pad10rem">Email: {{ $order['customer']['email'] }}</div>
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
                                                                            <div class="pad10rem"><b>Transaction # {{ $order['order_no'] }}</b></div>
                                                                            <br />
                                                                            <div class="pad10rem"><b>Tracking Code:</b> {{ $order['tracking_code'] }}<br /></div>
                                                                            <div class="pad10rem"><b>Status:</b> {{ $order['status_details']['name'] }}<br /></div>
                                                                            <div class="pad10rem"><b>Delivery Due:</b> {{ $order['display_delivery_due'] }}<br /></div>
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
                                                                    @foreach($order['order_item'] as $key => $value)
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
                                                                            @elseif ($value['device_type'] == 0)
                                                                            <label class="label label-danger">Poor</label>
                                                                            @else
                                                                            <label class="label label-danger">Unknown</label>
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
                                                                                <td class="pad10rem">{{ $order['payment_method'] }}</td>
                                                                            </tr>
                                                                            @if ($order['payment_method'] == "Bank Transfer")
                                                                            <tr>
                                                                                <td class="pad10rem"><b>Bank Name: </b>{{ $order['account_bank'] }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="pad10rem"><b>Account Name: </b>{{ $order['account_name'] }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="pad10rem"><b>Account Number: </b>{{ $order['account_number'] }}</td>
                                                                            </tr>
                                                                            @else
                                                                            <tr>
                                                                                <td class="pad10rem"><b>Account Username: </b>{{ $order['account_username'] }}</td>
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
                                                                                    <!-- <td>${{ number_format($shippingFee, 2, '.', ',') }}</td> -->
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Total:</th>
                                                                                    <td>${{ number_format($overallSubTotal, 2, '.', ',') }}</td>
                                                                                    <!-- <td>${{ number_format($overallSubTotal + $shippingFee, 2, '.', ',') }}</td> -->
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="font12">
                                                    Thanks,<br />
                                                    <b>The TronicsPay Team</b>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <td class="content-block" style="text-align: center; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
                                                &copy; <?php echo date('Y'); ?> TronicsPay
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
