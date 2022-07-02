@extends('layouts.front')
@section('content')
<div class="pt-70" id="device-content" data-brand="{{ $brand }}">
    @if($status == 200)
    <section>
        <div class="container pb-50">

            <div class="row" id="row-checkout" style="padding-top: 15px;">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="medias" id="condition-div">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4 class="p-2">{{ $product->brand->name }} {{ $product->model }}</h4>
                                        <div class="py-4 text-center">
                                            <img src="{{ url($product->photo->photo) }}" class="img-fluid" id="device-image">
                                        </div>
                                        <div class="p-3 border border-2 border-dark font-weight-bold">
                                            {!!$product->description !!}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 id="select-network-title">Select Network</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center" id="network-section-loading-label">
                                                <h3>Loading...</h3>
                                            </div>
                                            <div class="col-md-12 d-none text-center" id="network-section">
                                                <div class="btn-group-toggle" data-toggle="buttons">
                                                    @forelse ($networks as $network)
                                                    <label class="mb-1 btn btn-outline-warning radio-btn btn-carrier" id="" data-network_id="{{ $network->id }}" onClick="selectDeviceCarrier({{ $network->id }})">
                                                        <img style="width: 90px; height: 50px;" src="{{ asset('/uploads/phone-carriers/'.$network->image) }}" class="img-fluid">
                                                    </label>
                                                    @empty
                                                    <h3>Sorry we don't have available device at the moment</h3>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1 d-none" id="device-condition-title">
                                            <div class="col-md-12">
                                                <h3>What condition is your device in?</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="device-condition-section">
                                            <div class="col-md-12">
                                                <div class="btn-group-toggle" data-toggle="buttons" id="device-condition-buttons">
                                                    <label class="mb-1 btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" id="condition-excellent-button" name="device_type" value="excellent_offer" autocomplete="off"> Excellent
                                                    </label>
                                                    <label class="mb-1 btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" id="condition-good-button" name="device_type" value="good_offer" autocomplete="off"> Good
                                                    </label>
                                                    <label class="mb-1 btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" id="condition-fair-button" name="device_type" value="fair_offer" autocomplete="off"> Fair
                                                    </label>
                                                    <label class="mb-1 btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" id="condition-broken-button" name="device_type" value="poor_offer" autocomplete="off"> Broken
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-1 d-none" id="condition-status">
                                                <div class="form-group">
                                                    <div class="card">
                                                        <div class="card-body" style="font-size: 14px;">
                                                            If ALL of the following are true:
                                                            <ul id="description-list">

                                                            </ul>
                                                        </div>
                                                        {{-- {!! $condition !!} --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="device-size-title">
                                            <div class="col-md-12">
                                                <br>
                                                <h3>Size</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row d-none" id="device-size-section">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="btn-group-toggle" data-toggle="buttons" id="device-size-buttons">
                                                        {{-- <label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">
                                                                    <input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage()" autocomplete="off"> 123GB
                                                                </label>
                                                                <label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">
                                                                    <input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage()" autocomplete="off"> 214GB
                                                                </label>
                                                                <label class="btn btn-outline-warning radio-btn'.$active.'" style="margin-right: 4px;">
                                                                    <input type="radio" class="device-storage" name="storage" value="'.$psVal->title.'" onchange="storage()" autocomplete="off"> 514GB
                                                                </label> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row d-none mt-3" id="device-description-section">
                                                <div class="col-md-12 text-center">
                                                    <h5>Your Cash Offer</h5>
                                                    <div class="ml-auto" style="font-size: 40px; padding-bottom: 15px; font-weight: bold;" id="device-amount"><b id="cash-offer">$</b></div>
                                                    {{-- <a href="javascript:void(0)" id="addToCart" class="btn btn-warning btn-md btn-block">Add to Cart</a> --}}
                                                    <button id="addToCart" class="btn btn-warning btn-md btn-block">Add to Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h3>Available Network</h3>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <div id="section-networks" class="btn-group-toggle" data-toggle="buttons">
                                                                @foreach($product['networks'] as $key => $val)
                                                                    <?php $isActive = ($key == 0) ? 'active' : ''; ?>
                                                                    <label class="mb-1 btn btn-outline-warning radio-btn btn-carrier {{ $isActive }}" data-attr-id="{{ $val->network_id }}" id="label-carrier-{{ $val->network_id }}" onClick="selectDeviceCarrier({{ $val->network_id }})">
                                <img src="{{ url('/assets/images/network/'.$val->network_id.'.png') }}" class="img-fluid">
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
</div>

<div class="media">
    <div class="media-body" id="checkout-div" style="display:none">
        <div>
            <div id="chk-offer"></div>
            <form action="{{ url('device') }}" method="POST">
                @csrf
                <h5>Provide your shipping address</h5>
                <p>We use this information to create your shipping labels so you can send your item to us for free!</p>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">First Name</label>
                        <input type="text" name="fname" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Last Name</label>
                        <input type="text" name="lname" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Address Line 1</label>
                        <input type="text" name="address1" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Address Line 2 (Optional)</label>
                        <input type="text" name="address2" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label col-form-label-sm">City</label>
                        <input type="text" name="city" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label col-form-label-sm">State</label>
                        {!! Form::select('state_id', $stateList, '', ['class'=>'custom-select select-sm']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label col-form-label-sm">Zip Code</label>
                        <input type="text" name="zip_code" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-sm">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label col-form-label-sm">How would you like to be paid?</label>
                        {!! Form::select('payment_method', $paymentList, '', ['class'=>'custom-select select-sm','id'=>'payment_method']) !!}
                    </div>
                </div>
                <div class="form-row" id="payment-row"></div>
                <div class="form-group">
                    <div class="float-right">
                        <input type="hidden" name="amount" id="input-amount">
                        <input type="hidden" name="storage" id="input-storage">
                        <input type="hidden" name="network" id="input-network">
                        <input type="hidden" name="brand" id="input-brand">
                        <input type="hidden" name="device_type" id="input-device_type">
                        <input type="hidden" name="model" id="input-model">
                        <button type="submit" class="btn btn-warning btn-md">Checkout</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@else
<section>
    <div class="container pt-70 pb-50">
        <h2 id="header">{{ $brand }}</h2>
        <div class="row" id="row-network" style="padding-top: 15px;">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    No available devices for {{ $brand }}. Please try other brand.
                </div>
            </div>
        </div>
    </div>
</section>
@endif
</div>
@endsection

@section('page-css')
<link href="{{ url('assets/css/products.css') }}" rel="stylesheet">
<style>
    .radio-btn {
        width: 110px;
        color: #000;
    }

    .select-sm {
        height: 31px;
        padding: 0px 8px;
        font-size: 14px;
    }

</style>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\SellRequest') !!}
<script>
    $(document).ready(function() {
        // Values
        let condition = null;
        let size = null;

        // Sections
        var network_section_loading_label = $("#network-section-loading-label");
        var network_section = $("#network-section");
        var size_section = $("#device-size-section");
        var size_section_title = $("#device-size-title");
        var size_buttons = $("#device-size-buttons")
        var condition_section = $("#device-condition-section");
        var condition_section_title = $("#device-condition-title");
        var description_section = $("#device-description-section");
        var condition_status = $("#condition-status");
        var sections = [size_section, size_section_title, condition_section, condition_section_title];

        // Condition buttons
        var excellent_button = $("#device-excellent-button");
        var good_button = $("#device-good-button");
        var fair_button = $("#device-fair-button");
        var poor_button = $("#device-poor-button");

        // Cash offer text
        let cash_offer = $("#cash-offer");

        var specs = null;
        var product_id = "{{ optional($product)->hashedid }}";
        var link = "{{ url('products/storages/') }}";
        var network_id = null;
        if (product_id) {
            $.ajax(`${link}/${product_id}`, {
                method: "GET"
                , success: res => {
                    specs = res.specs;
                    network_section_loading_label.remove();
                    network_section.removeClass('d-none');
                }
                , error: err => {}
            })
        }

        $(".btn-carrier").on("click", function(e) {
            if (network_id == this.dataset.network_id) {
                $(this).attr('checked', true);
                return;
            }
            network_id = this.dataset.network_id;

            // Remove d-none class
            sections.map(section => {
                section.removeClass('d-none');
            });

            size_buttons.empty();
            specs[network_id].map(spec => {
                let size_button = `<label class="mb-1 btn btn-outline-warning radio-btn" style="margin-right: 4px;">
                                            <input type="radio" class="device-storage"
                                            name="storage" value="${spec.title}"
                                            onchange="storage()" autocomplete="off"> ${spec.title}
                                        </label>`;
                size_buttons.append(size_button);
                size = null;
                showDescription();
            });
        });

        $('.radio-device').change(function() {
            var brand = '<?php echo ($status == 200) ? $brand : '
            ' ?>';
            var network = '<?php echo ($status == 200) ? $product->hashedid : '
            ' ?>';
            var id = '<?php echo ($status == 200) ? $product->hashedid : '
            ' ?>';
            condition = this.value;
            condition_status.removeClass('d-none');
            showDescription();
            // $.ajax({
            //     type: "POST",
            //     url: "{{ url('products/model/filter') }}",
            //     data: {
            //         id: id,
            //         brand_id: brand,
            //         network: network,
            //         device_type: $('.radio-device:checked').val(), // $(this).val(),
            //         storage: $('input[name=storage]:checked').val()
            //     },
            //     dataType: "json",
            //     success: function (response) {
            //         console.log(response);
            //         $('#condition').html(response.condition);
            //         $('#device-amount').html('<b>$'+response.amount+'</b>');

            //     }
            // });
        });

        $(document).on("change", "input[name=storage]", function() {
            size = this.value;
            showDescription();
        });


        function showDescription() {
            if (condition) {
                let items = [];
                switch (condition) {
                    case 'excellent_offer':
                        items = ['Fully functional', 'Appears to be brand new', 'No Scratches, scuffess or marks', 'Phone has agood ESN/IMEI'];
                        break;
                    case 'good_offer':
                        items = ['Fully functional', 'No major scratches, scuffs or nicks', 'No cracks or broken hardware', 'Phone has a good ESN / IMEI'];
                        break;
                    case 'fair_offer':
                        items = ['Cracked back', 'Defective buttons', 'Significant wear and tear', 'Housing Damage'];
                        break;
                    case 'poor_offer':
                        items = ['Does NOT power on', 'Damaged LCD', 'Missing parts or bent frame', 'Any Password lock', ];
                        break;
                }
                $("#description-list").empty();
                items.map(item => {
                    let list_item = `<li>${item}</li>`;
                    $('#description-list').append(list_item);
                })
            }
            if (size && condition) {
                description_section.removeClass('d-none');
                if (network_id) {
                    specs[network_id].map(spec => {
                        if (spec.title == size) {
                            cash_offer.text(`$${spec[condition]}`);
                            return
                        }
                    });
                }
            } else {
                description_section.addClass('d-none');
            }
        }
        $('#addToCart').on('click', function() {
            var sessionCart = [];
            // this.attribute.disabled = true;
            // console.log("submitting");
            // console.log($('#cash-offer').html().replace('$',''));
            // console.log($('input[name=storage]:checked').val());
            // console.log(network_id);
            // console.log($('#device-content').attr('data-brand'));
            // console.log("{{ $model }}");
            // console.log($('#device-content').attr('data-brand'));
            // console.log($('.btn-carrier.active').attr('data-attr-id'));
            // return;
            if (localStorage.getItem("sessionCart") != null) {
                var storedItemObj = JSON.parse(decryptData(localStorage.getItem("sessionCart")));
                var validateExists = false;
                $.each(storedItemObj, function(key, value) {
                    if (value.amount == $('#cash-offer').html().replace('$', '') &&
                        value.storage == $('input[name=storage]:checked').val() &&
                        value.network == network_id &&
                        value.carrier_id == $('.btn-carrier.active').attr('data-attr-id') &&
                        value.brand == $('#device-content').attr('data-brand') &&
                        value.device_type == $('.radio-device:checked').val() &&
                        value.model == '{{ $model }}') {
                        validateExists = true;
                        value.quantity = parseFloat(value.quantity) + parseFloat(1);
                    }
                });
                if (validateExists != true) {
                    storedItemObj.push({
                        'cart_id': JSON.parse(decryptData(localStorage.getItem("sessionCart"))).length + 1,
                        // 'amount' : $('#device-amount').html().replace("<b>$", "").replace("</b>", "").replace(",", ""), 
                        'amount': $('#cash-offer').html().replace('$', '')
                        , 'storage': $('input[name=storage]:checked').val()
                        , 'network': network_id
                        , 'brand': $('#device-content').attr('data-brand')
                        , 'device_type': $('.radio-device:checked').val()
                        , 'model': '{{ $model }}'
                        , 'quantity': 1
                        , 'carrier_id': $('.btn-carrier.active').attr('data-attr-id')
                    });
                }
                localStorage.setItem("sessionCart", encryptData(JSON.stringify(storedItemObj)));
            } else {
                sessionCart.push({
                    'cart_id': 1
                    , 'amount': $('#cash-offer').html().replace('$', '')
                    , 'storage': $('input[name=storage]:checked').val()
                    , 'network': network_id
                    , 'brand': '<?php echo ($status == 200) ? $brand : '
                    ' ?>'
                    , 'device_type': $('.radio-device:checked').val()
                    , 'model': '{{ $model }}'
                    , 'quantity': 1
                    , 'carrier_id': $('.btn-carrier.active').attr('data-attr-id')
                });
                localStorage.setItem("sessionCart", encryptData(JSON.stringify(sessionCart)));
            }

            window.location.href = "{{ url('cart') }}";
        })

        $('#checkout').click(function() {
            var amount = $('#input-amount').val();
            var storage = $('#input-storage').val();
            $('#condition-div').hide();
            $('#checkout-div').fadeIn();
            $('#chk-offer').html('<h4>Cash Offer: $' + amount + ' &mdash; Size: ' + storage + '</h4><hr>');
        });

        $('#payment_method').change(function() {
            var payment = $(this).val();
            $('#payment-row').html(
                '<div class="spinner-border" role="status">' +
                '<span class="sr-only">Loading...</span>' +
                '</div>'
            );
            $.ajax({
                type: "POST"
                , url: "{{ url('products/sell/payment-method') }}"
                , data: {
                    payment: payment
                }
                , dataType: "json"
                , success: function(response) {
                    $('#payment-row').html(response.content);
                }
            });
        });
    });

    function selectDeviceCarrier(networkId) {
        $('.btn-carrier').removeClass('active');
        $(this).addClass('active');
    }


    function network(name) {
        var brand = $('#device-content').attr('data-brand');
        $('#device-content').attr('data-network', name);
        $('#header').html(brand + ' / ' + name);
        $.ajax({
            type: "POST"
            , url: "{{ url('products/network') }}"
            , data: {
                brand: brand
                , network: name
            }
            , dataType: "json"
            , success: function(response) {
                $('#row-devices').html(response.content);
            }
        });
    }

    function getoffer(id) {
        $('#row-devices').fadeOut();
        var brand = $('#device-content').attr('data-brand');
        var network = $('#device-content').attr('data-network');
        $('#device-content').attr('data-id', id);
        $.ajax({
            type: "POST"
            , url: "{{ url('products/model') }}"
            , data: {
                id: id
                , brand_id: brand
                , network: network
                , device_type: $('input[name=device_type]:checked').val()
                , storage: $('input[name=storage]:checked').val()
            }
            , dataType: "json"
            , success: function(response) {
                $('#header').html(brand + ' / ' + network + ' / ' + response.product.model);
                $('#row-devices').slideUp();
                $('#row-checkout').fadeIn();
                $('#device-storage').html(response.storagelist);
                $('#device-image').attr('src', response.photo);
                $('#condition').html(response.condition);
                $('#device-amount').html('<b>$' + response.amount + '</b>');
                $('#input-amount').val(response.amount);
                $('#input-storage').val($('input[name=storage]:checked').val());
                $('#input-network').val(network);
                $('#input-brand').val(brand);
                $('#input-device_type').val($('input[name=device_type]:checked').val());
                $('#input-model').val(response.product.model);
            }
        });
    }

    function storage(id) {
        var brand = '<?php echo ($status == 200) ? $brand : '
        ' ?>';
        var network = '<?php echo ($status == 200) ? $product->hashedid : '
        ' ?>';
        var id = '<?php echo ($status == 200) ? $product->hashedid : '
        ' ?>';
        $.ajax({
            type: "POST"
            , url: "{{ url('products/model/filter') }}"
            , data: {
                id: id
                , brand_id: brand
                , network: network
                , device_type: $('.radio-device:checked').val(), // $('.radio-device:checked').val(),
                storage: $('input[name=storage]:checked').val()
            }
            , dataType: "json"
            , success: function(response) {
                $('#condition').html(response.condition);
                // $('#device-amount').html('<b>$'+response.amount+'</b>');
            }
        });
    }

    $("#remove-sizes").on("click", function() {
        $("#device-storage").empty();
    });

</script>
@endsection
