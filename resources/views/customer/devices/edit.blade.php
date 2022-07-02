@extends('layouts.customer')
@section('content')

<div style="display:none">{{$data['product_storage']}}</div>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2><i class="nav-icon fas fa-mobile-alt"></i> My Devices</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('customer/dashboard') }}" class="fontGray1"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('customer/my-devic') }}" class="fontGray1"><i class="nav-icon fas fa-mobile-alt"></i> My Devices</a></li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order #: <b>{{ $data['order']['order_no'] }}</b></h3>

                <div class="card-tools">
                    <span class="label {{ $data['order']['status_details']['badge'] }}">
                        {{ $data['order']['status_details']['name'] }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-5">
                        <h3 class="d-inline-block d-sm-none">{{ $data['product']['model'] }} Review</h3>
                        <div class="col-12" align="center">
                            <img src="{{ url('/'.$data['product']['photo']['full_size']) }}" class="product-image " alt="Product Image" style="max-width: 250px;">
                        </div>
                    </div>
                    <div class="col-12 col-sm-7">
                        <h3 class="my-3">{{ $data['product']['model'] }} Review</h3>
                        <p>{!! $data['product']['description'] !!}</p>

                        <hr>

                        <h4 class="mt-3">Storage Size 
                            <!-- <small>(Please select one)</small> -->
                    </h4>
                        <div class="table table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="border0">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-default text-center w90px @if($data['product_storage']['title'] == '32GB') bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">32</span>
                                                    <br>
                                                    GB
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['product_storage']['title'] == '64GB') bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">64</span>
                                                    <br>
                                                    GB
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['product_storage']['title'] == '128GB') bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">128</span>
                                                    <br>
                                                    GB
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['product_storage']['title'] == '256GB') bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">256</span>
                                                    <br>
                                                    GB
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['product_storage']['title'] == '512GB') bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">512</span>
                                                    <br>
                                                    GB
                                                </label>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <h4 class="mt-3">Available Network 
                            <!-- <small>(Please select one)</small> -->
                        </h4>
                        <div class="table table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="border0">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-default text-center w95px @if($data['network']['id'] == 1) bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">
                                                        <img src="{{ url('/').'/assets/images/network/1.png' }}" style="width: 60px">
                                                    </span>
                                                    <br>
                                                    AT&T
                                                </label>
                                                <label class="btn btn-default text-center w95px @if($data['network']['id'] == 2) bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">
                                                        <img src="{{ url('/').'/assets/images/network/2.png' }}" style="width: 60px">
                                                    </span>
                                                    <br>
                                                    Sprint
                                                </label>
                                                <label class="btn btn-default text-center w95px @if($data['network']['id'] == 3) bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">
                                                        <img src="{{ url('/').'/assets/images/network/3.png' }}" style="width: 60px">
                                                    </span>
                                                    <br>
                                                    T-Mobile
                                                </label>
                                                <label class="btn btn-default text-center w95px @if($data['network']['id'] == 4) bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">
                                                        <img src="{{ url('/').'/assets/images/network/4.png' }}" style="width: 60px">
                                                    </span>
                                                    <br>
                                                    Verizon
                                                </label>
                                                <label class="btn btn-default text-center w95px @if($data['network']['id'] == 5) bg-theme @endif">
                                                    <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                                    <span class="text-xl">
                                                        <img src="{{ url('/').'/assets/images/network/5.png' }}" style="width: 60px">
                                                    </span>
                                                    <br>
                                                    Unlocked
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  

                        <hr>

                        <h4 class="mt-3">Device Condition
                             <!-- <small>(Please select one)</small> -->
                            </h4>
                        <div class="table table-responsive">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="border0">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-default text-center w90px @if($data['device_type'] == 1) bg-theme @endif">
                                                    <div class="ptb20px">
                                                        <input type="radio" name="device_type" id="device_type_option1" autocomplete="off">
                                                        Excellent
                                                    </div>
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['device_type'] == 2) bg-theme @endif">
                                                    <div class="ptb20px">
                                                        <input type="radio" name="device_type" id="device_type_option2" autocomplete="off">
                                                        Good
                                                    </div>
                                                </label>
                                                <label class="btn btn-default text-center w90px @if($data['device_type'] == 3) bg-theme @endif">
                                                    <div class="ptb20px">
                                                        <input type="radio" name="device_type" id="device_type_option3" autocomplete="off">
                                                        Fair
                                                    </div>
                                                </label>
                                                <label class="btn btn-default text-center active w90px @if($data['device_type'] == 4) bg-theme @endif">
                                                    <div class="ptb20px">
                                                        <input type="radio" name="device_type" id="device_type_option4" autocomplete="off">
                                                        Poor
                                                    </div>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <h4 class="mt-3">Quantity 
                            <!-- <small>(Please select one)</small> -->
                        </h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number"  disabled name="quantity" class="form-control" min="1" value="{{ $data['quantity'] }}">
                                </div>
                            </div>
                        </div>


                        <hr>

                        <!-- <h4 class="mt-3">Color </h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center active">
                                <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                {{ $data['product']['color'] }}
                                <br>
                                <i class="fas fa-circle fa-2x text-{{ $data['product']['color'] }}"></i>
                            </label>
                        </div> -->

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                ${{ number_format($data['amount'], 2, '.', ',') }}
                            </h2>
                            <h4 class="mt-0">
                                <small>Shipping Fee: ${{ number_format($data['order']['shipping_fee'], 2, '.', ',') }}</small>
                            </h4>
                        </div>

                        <!-- <div class="mt-4">
                            <div class="btn btn-primary btn-lg btn-flat font1rem">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                                <span>Update Device Details</span>
                            </div>

                            <div class="btn btn-danger btn-lg btn-flat font1rem">
                                <i class="fas fa-trash fa-lg mr-2"></i> 
                                Remove From List
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="payment-summary-tab" data-toggle="tab" href="#payment-summary" role="tab" aria-controls="payment-summary" aria-selected="true">Payment Summary</a>
                            <a class="nav-item nav-link" id="other-details-tab" data-toggle="tab" href="#other-details" role="tab" aria-controls="other-details" aria-selected="false">Other Details</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3 table table-responsive" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="payment-summary" role="tabpanel" aria-labelledby="payment-summary-tab"> 
                            @if($data['order']['payment_method'] != 'Bank Transfer')
                                <div class="row">
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <b>Payment Method</b>
                                        <div class="mt5">{{ $data['order']['payment_method'] }}</div>
                                    </div>
                                    <div class="col-md-4 col-xs-12 form-group">
                                        <b>Payment Method</b>
                                        <div class="mt5">{{ $data['order']['account_username'] }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="row d-block d-sm-none">
                                    <div class="col-md-12 form-group">
                                        <b>Payment Method</b>
                                        <div class="mt5">{{ $data['order']['payment_method'] }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <b>Bank Name</b>
                                        <div class="mt5">{{ $data['order']['account_bank'] }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <b>Account Name</b>
                                        <div class="mt5">{{ $data['order']['account_name'] }}</div>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <b>Account Number</b>
                                        <div class="mt5">{{ $data['order']['account_number'] }}</div>
                                    </div>
                                </div>
                                <div class="d-none d-sm-block">
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <th>Payment Method</th>
                                                <th>Bank Name</th>
                                                <th>Account Name</th>
                                                <th>Account Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $data['order']['payment_method'] }}</td>
                                                <td>{{ $data['order']['account_bank'] }}</td>
                                                <td>{{ $data['order']['account_name'] }}</td>
                                                <td>{{ $data['order']['account_number'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="other-details" role="tabpanel" aria-labelledby="other-details-tab"> 
                
                            <div class="row d-block d-sm-none">
                                <div class="col-md-12 form-group">
                                    <b>Tracking #</b>
                                    <div class="mt5">{{ $data['order']['tracking_code'] }}</div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <b>Shipping Label</b>
                                    <div class="mt5">{{ $data['order']['shipping_label'] }}</div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <b>Delivery Duration</b>
                                    <div class="mt5">{{ $data['order']['delivery_days'] }} days</div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <b>Transaction Date</b>
                                    <div class="mt5">{{ $data['order']['display_transaction_date'] }}</div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <b>Delivery Due Date</b>
                                    <div class="mt5">{{ $data['order']['display_delivery_due'] }}</div>
                                </div>
                            </div>
                            <div class="d-none d-sm-block">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tracking #</th>
                                            <th>Shipping Status</th>
                                            <th>Track Order</th>
                                            <th>Transaction Date</th>
                                            <th>Delivery Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $data['order']['tracking_code'] }}</td>
                                            <td>{{ strtoupper(str_replace("_", " ", $data['order']['shipping_status'])) }}</td>
                                            <td><a href="{{ $data['order']['shipping_tracker'] }}" target="_blank">[Click here]</i></a></td>
                                            <!-- <td><a href="javascript:void(0);" onClick="modalTrackShipping('{{ $data['order']['shipping_tracker'] }}')">[Click here]</i></a></td> -->
                                            <td>{{ $data['order']['display_transaction_date'] }}</td>
                                            <td>{{ $data['order']['display_delivery_due'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection