@extends('layouts.front')
@section('content')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="{{ url('library/js/front/address-suggest.js') }}"></script>

<div class="pt-70 pb50">
    <div class="container pt-50">
        <div class="row">
            <div class="col-lg-8">
                <div id="checkoutTopSection">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('common.component.preloader.index')
                                    <div id="empty-cart" class="hideme" align="center"></div>
                                    <div id="my-cart-details" class="hideme"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- New sect. below -->
                <div class="row hideme" id="checkout-step">
                    <div class="col-12">

                        <div class="row hideme" id="checkoutCompletedSection">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="checkoutCompleted"> </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="checkoutInProgress">
                            <div class="">
                                <div class="">
                                    <div class="media-body" id="checkout-div">
                                        <div>
                                            <div id="chk-offer"></div>
                                            <form action="{{ url('device') }}" id="form-checkout" method="POST">
                                                <div class="">

                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            @csrf
                                                            <h5>Provide your shipping address</h5>
                                                            <p>We use this information to create your shipping labels so you can send your item to us for free!</p>
                                                            <!-- <div class="form-row">
                                                                <label class="full-field">
                                                                    <span class="form-label">Deliver to*</span>
                                                                    <input id="autocomplete-input" name="autocomplete-input" required autocomplete="off" />
                                                                </label>
                                                            </div> -->
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">First Name</label>
                                                                    <input type="text" name="fname" class="form-control form-control-sm" value="{{ $user ? $fname : ''  }}"> <!-- Juan -->
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">Last Name</label>
                                                                    <input type="text" name="lname" class="form-control form-control-sm" value="{{ $user ? $lname : ''  }}"> <!-- Dela Cruz -->
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">Address Line 1</label>
                                                                    <input id="address1-input" type="text" name="address1" class="form-control form-control-sm" value="{{ $user ? $address1 : ''  }}" required autocomplete="off"> <!-- 179 N Harbor Dr -->
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">Address Line 2 (Optional)</label>
                                                                    <input type="text" name="address2" class="form-control form-control-sm" value="{{ $user ? $address2 : ''  }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                    <label class="col-form-label col-form-label-sm">City</label>
                                                                    <input id="city-locality" type="text" name="city" class="form-control form-control-sm" value="{{ $user ? $city : ''  }}"> <!-- Redondo Beach -->
                                                                </div>
                                                                <div class="form-group col-md-4" id="state-container">
                                                                    <label class="col-form-label col-form-label-sm">State</label>
                                                                    {!! Form::select('state_id', $stateList, $user ? $state: '', ['class'=>'custom-select select-sm']) !!}
                                                                    <!-- CA -->
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label class="col-form-label col-form-label-sm">Zip Code</label>
                                                                    <input type="text" name="zip_code" id="zip-code" class="form-control form-control-sm" value="{{ $user ? $zip : ''  }}"> <!-- 90277 -->
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">Email Address</label>
                                                                    <input type="email" name="email" class="form-control form-control-sm" value="{{ $user ? $email : ''  }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="col-form-label col-form-label-sm">
                                                                                Phone
                                                                            </label>
                                                                            <span id="valid-msg" class="hideme text-green">Valid</span>
                                                                            <span id="error-msg" class="hideme text-red">Invalid number</span>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <input id="phone" type="tel" name="phone" style="width: 100% !important;" class="form-control form-control-sm" {{ $user ? "value=".$phone : ''  }}>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <input type="text" name="phone" class="form-control form-control-sm"> -->
                                                                </div>

                                                                <div class="form-group col-md-6">



                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label class="col-form-label col-form-label-sm">How would you like to be paid?</label>
                                                                    {!! Form::select('payment_method', $paymentList, '', ['class'=>'custom-select select-sm','id'=>'payment_method']) !!}
                                                                </div>
                                                            </div>
                                                            <div id="divCartDetails"></div>

                                                            <div class="form-row" id="payment-row"></div>
                                                            <div class="form-group d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <input type="checkbox" value="terms-and-condition" id="terms-and-condition" />
                                                                    <label for="checkbox">Agree to <a href="#" data-toggle="modal" data-target="#terms-and-conditions-modal">terms and conditions.</a></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <ul>
                                                                        <li>Cash offers can be reduced if your device is Financed, has Bad IEMI, Google / iCloud Locks.</li>
                                                                        <li>We do not provide boxes. Use any box of your choice.</li>
                                                                        <li>Shipping Instructrions will be sent to your email. Print your shipping label from your email or member portal.</li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="form-group">

                                                                        <div class="row pt10 border-bottom">
                                                                            <div class="col-md-4">
                                                                                <b>Total</b>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="cart-subtotal">$100</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt10 border-bottom">
                                                                            <div class="col-md-4">
                                                                                <b>Shipping</b>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="">Free shipping</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt10 border-bottom">
                                                                            <div class="col-md-4">
                                                                                <b>Insurance</b>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="insurance-optin" name="insurance-optin-check" data-insurance="{{$insurance_fee}}">
                                                                                    <label class="form-check-label" for="insurance-optin">
                                                                                        Puchase Order Insurance for $<span id="insurance-price"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt10">
                                                                            <div class="col-md-4">
                                                                                <b>Final</b>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="cart-final cart-total">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mt-3 w-100 col-6 form-group d-flex justify-content-end align-items-center">
                                                                    <div class="w-100">
                                                                        <input type="hidden" id="insurance-optin-hidden" name="insurance_optin">
                                                                        <button type="submit" class="w-100 btn btn-warning btn-md" id="btn-checkout">Checkout</button>
                                                                        <button type="button" class="w-100 btn btn-warning btn-md disabled hideme" id="btn-checkout-loader"><i class="fas fa-spinner fa-spin"></i> Please wait...</button>
                                                                    </div>
                                                                </div>
                                                            </div>
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

            </div>

            <div class="col-lg-4">
                @include('front.cart.sidebar')
            </div>
        </div>
    </div>
</div>

@include('admin.modals.terms-and-conditions.index')

@endsection
@section('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?callback=initAutocomplete&libraries=places&v=weekly" async></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXs_7mvjrY_HLe_euNLFDMCxZG_A1IMrY&callback=initAutocomplete&libraries=places&v=weekly" async></script>

<!-- Cart page script -->
<script>
    $(function() {
        var baseUrl = $('body').attr('data-url');
        if (localStorage.getItem("sessionCart")) {
            GenerateCartDetails();
            $('#checkout-step').removeClass('hideme');
        } else {
            $('#empty-cart').removeClass('hideme');
            $('#checkout-step').addClass('hideme');
            $('#empty-cart').html('<div class="form-group"><img src="/assets/images/empty-cart.png" class="img-fluid"></div>');
            $('#preloader, .addOnPreloader').addClass('hideme');

        }
    });

</script>
<!-- END Cart page script -->
<!-- Checkout page scripts -->
<script>
    /*
     *
     *   Insurance optin listener
     *
     */
    document.querySelector("#insurance-optin").onchange = function(e) {
        document.querySelector("#insurance-optin-hidden").value = e.target.checked
        const prevTotal = document.querySelector(".cart-subtotal").innerHTML.replace("$", "")
        if (e.target.checked) {
            const fee = Number(document.querySelector("#insurance-price").innerHTML)
            document.querySelector(".cart-final").innerHTML = "$" + (Number(prevTotal) - fee).toFixed(2)
        } else {
            document.querySelector(".cart-final").innerHTML = "$" + Number(prevTotal).toFixed(2)

        }
    }

    /*
     *
     *   Terms and conditions listener
     *
     */
    $("#agree-terms-button").click(function() {
        const terms_and_condition = document.getElementById('terms-and-condition');
        terms_and_condition.checked = true;
    });

    /*
     *
     *   Telephone input
     *
     */
    var telInput = $("#phone")
        , errorMsg = $("#error-msg")
        , validMsg = $("#valid-msg");

    telInput.intlTelInput({
        allowExtensions: true
        , formatOnDisplay: true
        , autoFormat: true
        , autoHideDialCode: true
        , autoPlaceholder: true
        , defaultCountry: "us",
        // ipinfoToken: "yolo",
        nationalMode: false
        , numberType: "MOBILE"
        , onlyCountries: ['us', 'ca']
        , preferredCountries: []
        , preventInvalidNumbers: true
        , separateDialCode: true
        , initialCountry: "us",
        // geoIpLookup: function(callback) {
        //     $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
        //         var countryCode = (resp && resp.country) ? resp.country : "";
        //         callback(countryCode);
        //     });
        // },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    var reset = function() {
        telInput.removeClass("error");
        errorMsg.addClass("hideme");
        validMsg.addClass("hideme");
    };

    telInput.blur(function() {
        reset();
        if ($.trim(telInput.val())) {
            if (telInput.intlTelInput("isValidNumber")) {} else {
                swalWarning("Oops", "Mobile Number is invalid", "warning", "Close");
            }
        }
    });

    telInput.on("keyup change", reset);

    /*
     *
     *   Form submission
     *
     */
    $(function() {
        // set cached customer information
        var customerInformation = JSON.parse(localStorage.getItem('customer-information') || "{}");
        Object.keys(customerInformation).forEach(function(name) {
            $('#form-checkout [name=' + name + ']').val(customerInformation[name]);
        });
        $(document).on('change', '#form-checkout [name]', function(e) {
            customerInformation[e.target.name] = e.target.value;
            localStorage.setItem('customer-information', JSON.stringify(customerInformation));
        });

        $('#btn-checkout-loader, #checkoutCompletedSection').addClass('hideme');
        $(document).on('submit', '#form-checkout', function(e) {
            var countryCode = $('.selected-dial-code').html();
            const terms_and_condition = document.getElementById('terms-and-condition');
            if (!terms_and_condition.checked) {
                swal({
                    title: "Did not agree to terms and conditions"
                    , text: "Please agree to terms and conditions"
                    , icon: "info"
                    , buttons: "Close"
                , });
                e.preventDefault();
                return;
            }
            $('#btn-checkout-loader').removeClass('hideme');
            $('#btn-checkout').addClass('hideme');
            var obj = {
                '_token': ''
                , 'fname': ''
                , 'lname': ''
                , 'address1': ''
                , 'address2': ''
                , 'city': ''
                , 'state_id': ''
                , 'zip_code': ''
                , 'email': ''
                , 'phone': ''
                , 'payment_method': ''
                , 'account_username': ''
                , 'bank': ''
                , 'account_name': ''
                , 'account_number': ''
                , 'insurance_optin': ''
                , 'cart': null
            };
            jQuery.each($(this).serializeArray(), function(i, field) {
                if (has(obj, field.name)) {
                    var propVal = field.value;
                    if (field.name == 'phone') {
                        obj[field.name] = countryCode + '' + propVal;
                    } else {
                        obj[field.name] = propVal;
                    }
                }
            });

            obj['cart'] = JSON.parse(decryptData(localStorage.getItem("sessionCart")));
            $.ajax({
                type: "POST"
                , url: "{{ url('device') }}"
                , data: obj
                , dataType: "json"
                , success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        $('#checkoutCompleted').html(response.message);
                        $('#checkoutInProgress').html('');
                        $('#my-cart-details').html('');
                        $('#checkoutCompletedSection').removeClass('hideme');
                        $('#my-cart-details').parent().parent().addClass('hideme');

                        localStorage.clear();
                    } else if (response.status == 301) {
                        swal({
                            title: "Congratulations!"
                            , text: response.message
                            , icon: "success"
                            , buttons: "Close"
                        , })
                        window.location.href = '../' + response.redirectTo;
                        localStorage.clear();
                    } else {
                        swal({
                            title: "Oops!"
                            , text: response.message
                            , icon: "warning"
                            , buttons: "Close"
                        , })
                        $('#btn-checkout').removeClass('hideme');
                    }
                    $('#btn-checkout-loader').addClass('hideme');
                }
            });
            return false;
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

    function has(object, key) {
        return object ? hasOwnProperty.call(object, key) : false;
    }

</script>
@endsection


@section('page-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
<style>
    .intl-tel-input {
        width: 100%;
    }

    .list-title {
        color: orange;
        font-size: 18px;
        font-weight: bold;
    }

</style>
@endsection
