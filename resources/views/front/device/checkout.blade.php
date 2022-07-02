@extends('layouts.front')
@section('content')
<div class="pt-70" id="device-content" data-brand="{{ $brand }}">
    @if($chkproduct)
    <section>
        <div class="container pb-50">
            <div style="padding-top: 15px; display: block;">
                <h2 id="header">{{ $brand }}</h2>
                <div class="row no-gutters mx-1 mt-2 mb-4" id="row-filters">
                
                </div>
                <div class="row" id="row-devices">
                    @if(count($products) > 0)
                    @foreach($products as $key => $val)
                    <div class="col-md-4 col-6 col-lg-3 mb-4 prod-item" data-model="{{ $val->model }}">
                        <!-- <a href="{{ url('products/'.$brand.'/'.$val->model.'') }}"> -->
                        <div class="card tronics" style="min-height: 15rem; max-height: 15rem;">
                            <div class="card-body tronics-wrap d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    @if($val->photo != null)
                                    <img src="{{ url($val->photo->photo) }}" class="img-fluid product-photo">
                                    @endif
                                    <h3 class="product-name">{{ $val->model }}</h3>
                                    <div class="tronics-links">
                                        <a href="{{ url('products/'.$brand.'/'.$val->model.'') }}" class="btn btn-warning btn-sm">Get an Offer</a>
                                        <!-- <a href="javascript:void(0)" data-attr-id="{{ $val->hashedid }}" data-attr-model="{{ $val->model }}" class="btn btn-warning btn-sm btn-get-offer">Get an Offer</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- </a> -->
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>

            <div class="row" id="row-checkout" style="padding-top: 15px; display: none">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="medias" id="condition-div">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="" class="mr-3 img-fluid" id="device-image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3>What condition is your device in?</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-warning radio-btn active">
                                                        <input type="radio" class="radio-device" name="device_type" value="1" autocomplete="off" checked> Excellent
                                                    </label>
                                                    <label class="btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" name="device_type" value="2" autocomplete="off"> Good
                                                    </label>
                                                    <label class="btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" name="device_type" value="3" autocomplete="off"> Fair
                                                    </label>
                                                    <label class="btn btn-outline-warning radio-btn">
                                                        <input type="radio" class="radio-device" name="device_type" value="0" autocomplete="off"> Broken
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br>
                                                <h3>Size</h3>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="btn-group-toggle" data-toggle="buttons" id="device-storage"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <div class="card" id="condition"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <h5>Your Cash Offer</h5>
                                                <div style="font-size: 40px; padding-bottom: 15px; font-weight: bold;" id="device-amount"></div>
                                                <a href="javascript:void(0)" id="addToCart" class="btn btn-warning btn-md btn-block">Add to Cart</a>
                                                <!-- <a href="javascript:void(0)" id="checkout" class="btn btn-warning btn-md btn-block">Get Paid</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h3>Available Network</h3>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <div id="section-networks" class="btn-group-toggle" data-toggle="buttons"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<link rel="stylesheet" href="{{ asset('assets/css/products-category.css') }}">
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

    #row-filters>div {
        position: unset;
    }
    #row-filters button {
        position: unset;
        border-radius: 0;
        background: #d2d2d2;
    }

    #row-filters button.active {
        background: #a7a7a7;
        font-weight: bold;
    }
</style>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\SellRequest') !!}
<script>

    if ("{{$brand}}" === "Smart Watch") {

        const filtersEl = document.querySelector("#row-filters")

        const allEl = getItemElement("All")
        allEl.firstElementChild.classList.add("active")
        filtersEl.appendChild(allEl)

        const brands = {}
        const namesEls = Array.from(document.querySelectorAll("h3.product-name"))
        for (let i = 0; i < namesEls.length; i++) {
            const name = namesEls[i].innerHTML
            if (name.indexOf(" ") > 0) {
                const brand = name.split(" ")[0]
                brands[brand] = true
            }
        }

        const brandsArr = Object.keys(brands)
        for (let i = 0; i < brandsArr.length; i++) {
            const name = brandsArr[i]
            filtersEl.appendChild(getItemElement(name))
        }

        function getItemElement(title) {
            const divEl = document.createElement("div")
            divEl.classList.add("col-12", "col-sm-3")

            const el = document.createElement("button")
            el.id = title
            el.innerHTML = title
            el.addEventListener("click", function() {
                selectBrand(title)
            })

            el.classList.add("btn", "w-100")
            divEl.appendChild(el)
            return divEl
        }    

        function selectBrand(title) {
            const buttonEls = Array.from(document.querySelectorAll("#row-filters button"))
            for (let i = 0; i < buttonEls.length; i++) {
                const el = buttonEls[i]
                if (el.id === title) {
                    el.classList.add("active")
                } else {
                    el.classList.remove("active")
                }
            }
            filterByBrand(title)
        }

        function filterByBrand(title) {
            const prodEls = Array.from(document.querySelectorAll(".prod-item"))
            for (let i = 0; i < prodEls.length; i++) {
                const el = prodEls[i]

                if ( title === "All" ) {
                    el.classList.remove("hideme")
                    continue
                }

                if (el.dataset.model && el.dataset.model.startsWith(title)) {
                    el.classList.remove("hideme")
                } else {
                    el.classList.add("hideme")
                }
                
            }
        }
    }
</script>
<script>

    $(document).ready(function() {
        $('.btn-get-offer').on('click', function() {

            var id = $(this).attr('data-attr-id');
            $('#row-devices').fadeOut();
            var brand = $('#device-content').attr('data-brand');
            var model = $(this).attr('data-attr-model');
            $('head').append('<meta property="og:title" content="' + brand + ' ' + model + ' - TronicsPay" />');


            $('#device-content').attr('data-id', id);
            $.ajax({
                type: "POST",
                url: "{{ url('products/model') }}",
                data: {
                    id: id,
                    brand_id: brand,
                    device_type: $('input[name=device_type]:checked').val(),
                    storage: $('input[name=storage]:checked').val()
                },
                dataType: "json",
                success: function(response) {
                    $('#header').html(brand + ' / ' + response.selectedProduct.model);
                    $('#row-devices').slideUp();
                    $('#row-checkout').fadeIn();
                    $('#device-storage').html(response.storagelist);
                    $('#device-image').attr('src', '../../' + response.selectedProduct.photo.photo);
                    $('#condition').html(response.condition);
                    $('#device-amount').html('<b>$' + response.amount + '</b>');

                    $.each(response.selectedProduct.networks, function(index, value) {
                        var isActive = (index === 0) ? 'active' : '';
                        $('#section-networks').append('<label class="btn btn-outline-warning radio-btn btn-carrier ' + isActive + '" data-attr-id="' + value.network_id + '" id="label-carrier-' + value.network_id + '" onClick="selectDeviceCarrier(' + value.network_id + ')"><img src="' + $('body').attr('data-url') + '/assets/images/network/' + value.network_id + '.png" class="img-fluid"></label>');
                    });
                }
            });
        });
        $('.radio-device').change(function() {
            var brand = $('#device-content').attr('data-brand');
            var network = $('#device-content').attr('data-network');
            var id = $('#device-content').attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ url('products/model/filter') }}",
                data: {
                    id: id,
                    brand_id: brand,
                    network: network,
                    device_type: $(this).val(),
                    storage: $('input[name=storage]:checked').val()
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#condition').html(response.condition);
                    $('#device-amount').html('<b>$' + response.amount + '</b>');

                }
            });
        });

        $('#addToCart').on('click', function() {
            var sessionCart = [];

            if (localStorage.getItem("sessionCart") != null) {
                var storedItemObj = JSON.parse(decryptData(localStorage.getItem("sessionCart")));
                var validateExists = false;
                $.each(storedItemObj, function(key, value) {
                    if (value.amount == $('#device-amount').html().replace("<b>$", "").replace("</b>", "").replace(",", "") &&
                        value.storage == $('input[name=storage]:checked').val() &&
                        value.carrier_id == $('.btn-carrier.active').attr('data-attr-id') &&
                        value.brand == $('#device-content').attr('data-brand') &&
                        value.device_type == $('.radio-device:checked').val() &&
                        value.model == $('.btn-get-offer').attr('data-attr-model')) {
                        validateExists = true;
                        value.quantity = parseFloat(value.quantity) + parseFloat(1);
                    }
                });
                if (validateExists != true) {
                    storedItemObj.push({
                        'cart_id': JSON.parse(decryptData(localStorage.getItem("sessionCart"))).length + 1,
                        'amount': $('#device-amount').html().replace("<b>$", "").replace("</b>", "").replace(",", ""),
                        'storage': $('input[name=storage]:checked').val(),
                        'network': $('#input-network').val(),
                        'brand': $('#device-content').attr('data-brand'),
                        'device_type': $('.radio-device:checked').val(),
                        'model': $('.btn-get-offer').attr('data-attr-model'),
                        'quantity': 1,
                        'carrier_id': $('.btn-carrier.active').attr('data-attr-id')
                    });
                }
                localStorage.setItem("sessionCart", encryptData(JSON.stringify(storedItemObj)));
            } else {
                sessionCart.push({
                    'cart_id': 1,
                    'amount': $('#device-amount').html().replace("<b>$", "").replace("</b>", "").replace(",", ""),
                    'storage': $('input[name=storage]:checked').val(),
                    'network': $('#input-network').val(),
                    'brand': $('#device-content').attr('data-brand'),
                    'device_type': $('.radio-device:checked').val(),
                    'model': $('.btn-get-offer').attr('data-attr-model'),
                    'quantity': 1,
                    'carrier_id': $('.btn-carrier.active').attr('data-attr-id')
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
                type: "POST",
                url: "{{ url('products/sell/payment-method') }}",
                data: {
                    payment: payment
                },
                dataType: "json",
                success: function(response) {
                    $('#payment-row').html(response.content);
                }
            });
        });
    });

    function selectDeviceCarrier(networkId) {
        $('.btn-carrier').removeClass('active')
        $(this).addClass('active');
    }


    function network(name) {
        var brand = $('#device-content').attr('data-brand');
        $('#device-content').attr('data-network', name);
        $('#header').html(brand + ' / ' + name);
        $.ajax({
            type: "POST",
            url: "{{ url('products/network') }}",
            data: {
                brand: brand,
                network: name
            },
            dataType: "json",
            success: function(response) {
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
            type: "POST",
            url: "{{ url('products/model') }}",
            data: {
                id: id,
                brand_id: brand,
                network: network,
                device_type: $('input[name=device_type]:checked').val(),
                storage: $('input[name=storage]:checked').val()
            },
            dataType: "json",
            success: function(response) {
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
        var brand = $('#device-content').attr('data-brand');
        var network = $('#device-content').attr('data-network');
        var id = $('#device-content').attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{ url('products/model/filter') }}",
            data: {
                id: id,
                brand_id: brand,
                network: network,
                device_type: $('.radio-device:checked').val(),
                storage: $('input[name=storage]:checked').val()
            },
            dataType: "json",
            success: function(response) {
                $('#condition').html(response.condition);
                $('#device-amount').html('<b>$' + response.amount + '</b>');
            }
        });
    }
</script>
@endsection