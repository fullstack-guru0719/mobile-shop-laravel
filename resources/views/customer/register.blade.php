@extends('layouts.front')
@section('content')
<div class="pt-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12" align="center">
                <div class="container-form container-form-register right-panel-active" id="container">
                    <div class="form-container sign-up-container">
                        <form action="{{ url('customer/auth/register') }}" id="registration-form" method="POST" class="page-form">
                            @csrf
                            <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                            <h1>Sign Up</h1>
                            <div class="social-container">
                                <a href="#" class="social form-a"><i class="fab fa-instagram"></i></a>
                                <a href="/customer/auth/register-google" class="social form-a"><i class="fab fa-google"></i></a>
                                <a href="/customer/auth/register-facebook" class="social form-a"><i class="fab fa-facebook"></i></a>
                            </div>
                            <span>or use your email for registration</span>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" placeholder="First Name">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" placeholder="Last Name">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" type="password" name="confirm_password" placeholder="{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : 'Confirm Password' }}">
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input id="phone" type="tel" name="phone" style="width:100%" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('address1') ? 'is-invalid' : '' }}" type="text" name="address1" placeholder="Address Line 1">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('address2') ? 'is-invalid' : '' }}" type="text" name="address2" placeholder="Address Line 2 (Optional)">
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" placeholder="City">
                                </div>
                                <div class="col-md-12">
                                    {!! Form::select('state_id', $stateList, '', ['class' => 'custom-select', 'placeholder' => 'State']) !!}
                                </div>
                                <div class="col-md-12">
                                    <input class="bg-input-gray form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" type="text" name="zip_code" placeholder="Zip Code">
                                </div>
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ env("RECAPTCHA_SITE_KEY") }}"></div>
                            <button type="submit">
                                Sign Up
                            </button>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-left">
                                <h1>Welcome Back!</h1>
                                <p>Please login with your personal info</p>
                                <button class="ghost" id="signIn">Sign In</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
@endsection

@section('page-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
<script src="{{ url('library/js/front/registration/components.js') }}"></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
    // grecaptcha.ready(function() {
    //     grecaptcha.execute('{{ $recaptcha['site_key'] }}', {action: 'registration'})
    //     .then(function(token) {
    //         document.getElementById('recaptcha').value=token;
    //     });
    //     @if (session('error'))
    //         swalWarning ("Oops!", "{{ session('error') }}", "warning", "Close");
    //     @endif
    // });

    var onloadCallback = function() {
        // console.log("grecaptcha is ready!");
    };
    const form = document.getElementById("registration-form");
    form.addEventListener('submit', function(e) {
        var recaptcha = document.getElementById('g-recaptcha-response');
        if (recaptcha.value === "" || recaptcha.value == null) {
            // if (false) { // ttt
            e.preventDefault();
            swalWarning("Oops!", "Please Check Recaptcha", "warning", "Close");
        }
    });

    // function onSubmit(token) {
    //     document.getElementById("demo-form").submit();
    // }
</script>
@endsection

@section('page-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
<link href="{{ url('assets/css/registration/style.css') }}" rel="stylesheet" media="screen" />
<style>
    .bg-input-gray {
        background-color: #eee !important;
    }
</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection