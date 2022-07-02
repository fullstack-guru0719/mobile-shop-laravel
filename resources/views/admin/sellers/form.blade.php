<?php
$shippingFee = 10;
$overallSubTotal = 0;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if(isset($customer_transaction) && count($customer_transaction['customersells']) >= 1)
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h3 class="page-header">
                            <img src="{{ url('./assets/images/logo.png')}}">
                        </h3>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div style="float: right !important;">Date: {{ $customer_transaction['display_transaction_date'] }}</div>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>{{ $customer_transaction['customer']['fullname'] }}</strong><br>
                            {{ $customer_transaction['customer']['bill']['address1'] }}<br>
                            Phone: {{ $customer_transaction['customer']['bill']['phone'] }}<br>
                            Email: {{ $customer_transaction['customer']['email'] }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ $config->company_name }}</strong><br>
                            {{ $config->address1 }}<br>
                            Phone: {{ $config->address1 }}<br>
                            Email: {{ $config->company_email }}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Transaction #{{ $customer_transaction['transaction_id'] }}</b><br />
                        <br />
                        <b>Tracking Code:</b> {{ $customer_transaction['tracking_code'] }}<br />
                        <b>Status:</b> {{ $customer_transaction['status'] }}<br />
                        <b>Delivery Due:</b> {{ $customer_transaction['display_delivery_due'] }}<br />
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 table-responsive" align="center">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="7%">
                                        <center>#</center>
                                    </th>
                                    <th width="21%">Product</th>
                                    <th width="12%">
                                        <center>Storage</center>
                                    </th>
                                    <th width="12%">
                                        <center>Qty</center>
                                    </th>
                                    <th width="12%">
                                        <center>Condition</center>
                                    </th>
                                    <th width="12%">
                                        <center>Carrier</center>
                                    </th>
                                    <th width="12%" style="text-align: right;">Cash Offer</th>
                                    <th width="12%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customer_transaction['customersells'] as $key => $value)
                                <tr>
                                    <td align="center">{{ $key + 1 }}</td>
                                    <td>{{ $value['product']['brand']['name'] }} {{ $value['product']['model'] }}</td>
                                    <td align="center">{{ $value['product_storage']['title'] }}</td>
                                    <td align="center">{{ $value['quantity'] }}</td>
                                    <td align="center">
                                        @if($value['device_type'] == 1)
                                        <label class="label label-success">Excellent</label>
                                        @elseif($value['device_type'] == 2)
                                        <label class="label label-info">Good</label>
                                        @elseif($value['device_type'] == 3)
                                        <label class="label label-warning">Broken</label>
                                        @elseif($value['device_type'] == 0)
                                        <label class="label label-danger">Broken</label>
                                        @else
                                        <label class="label label-danger">Unknown</label>
                                        @endif
                                    </td>
                                    <td align="center">{{ $value['network']['title'] }}</td>
                                    <td align="right">
                                        <?php
                                        $subTotal = $value['quantity'] * $value['amount'];
                                        $overallSubTotal = $overallSubTotal + $subTotal;
                                        echo '$' . number_format($subTotal, 2, '.', ',');
                                        ?>
                                    </td>
                                    <td align="center">
                                        <a href="javascript:void(0);" data-attr-id="{{ $value['hashedid'] }}" class="btn btn-xs btn-primary btn-edit-sell-device">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="" class="btn btn-xs btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <p class="lead">Payment Method:</p>

                        <div class="row">
                            <div class="col-md-2 form-group">
                                @if(isset($customer_transaction) && $customer_transaction['payment_method'] != '')
                                @if($customer_transaction['payment_method'] == "Bank Transfer")
                                <img src="{{ url('/assets/images/payments/6.png') }}" alt="Bank Transfer" style="width: 60px;">
                                @elseif ($customer_transaction['payment_method'] == "Apple Pay")
                                <img src="{{ url('/assets/images/payments/1.png') }}" alt="Apple Pay" style="width: 60px;">
                                @elseif ($customer_transaction['payment_method'] == "Google Pay")
                                <img src="{{ url('/assets/images/payments/2.png') }}" alt="Google Pay" style="width: 60px;">
                                @elseif ($customer_transaction['payment_method'] == "Venmo")
                                <img src="{{ url('/assets/images/payments/3.png') }}" alt="Venmo" style="width: 60px;">
                                @elseif ($customer_transaction['payment_method'] == "Cash App")
                                <img src="{{ url('/assets/images/payments/4.png') }}" alt="Cash App" style="width: 60px; height: 30px;">
                                @elseif ($customer_transaction['payment_method'] == "Paypal")
                                <img src="{{ url('/assets/images/payments/5.png') }}" alt="Paypal" style="width: 60px;">
                                @endif
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>{{ $customer_transaction['payment_method'] }}</b>
                                    </div>
                                </div>
                                @if($customer_transaction['payment_method'] == "Bank Transfer")
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Bank Name: </b>{{ $customer_transaction['account_bank'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Account Name: </b>{{ $customer_transaction['account_name'] }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Account Number: </b>{{ $customer_transaction['account_number'] }}
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <b>Account Username: </b>{{ $customer_transaction['account_username'] }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-6 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:50%">Cash Offer:</th>
                                        <td>${{ number_format($overallSubTotal, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping:</th>
                                        <td>${{ number_format($shippingFee, 2, '.', ',') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>
                                            <?php
                                            $total = $overallSubTotal + $shippingFee;
                                            echo '$' . number_format($overallSubTotal + $shippingFee, 2, '.', ',');
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('admin/device-sellers/'.$hashedId.'/generatePDF') }}" class="btn btn-danger btn-sm pull-right">
                                    Generate PDF
                                </a>
                                <a href="{{ url('admin/device-sellers/'.$hashedId.'/generatePDF') }}" class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-pdf"></i> Change Status
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-danger" style="margin-bottom: 0!important;">
                            <h4><i class="fa fa-info"></i> Note:</h4>
                            There are no transaction record.
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
