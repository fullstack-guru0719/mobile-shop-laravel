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
                                <a href="#" class="social form-a"><i class="fab fa-facebook"></i></a>
                            </div>
                            <span>or use your email for registration</span>
                            <div class="form-row">

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
                            <button type="submit">
                                Sign Up
                            </button>
                            <a href="/customer/auth/register">Register with username/password</i></a>

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

@endsection

@section('page-css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
<link href="{{ url('assets/css/registration/style.css') }}" rel="stylesheet" media="screen" />
<style>
    .bg-input-gray {
        background-color: #eee !important;
    }
</style>
@endsection