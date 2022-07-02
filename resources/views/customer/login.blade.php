@extends('layouts.front')
@section('content')
<?php
$url = redirect()->getUrlGenerator()->previous();
$parts = parse_url($url);
$from_email = false;
$path = '';
if (isset($parts['query']) && $parts['query'] == 'email=true') {
    parse_str($parts['query'], $query);
    $from_email = $query['email'];
    $path = substr($parts['path'], 1);
}
?>
<div class="pt-70">
    <div class="container">


        <div class="row">
            <div class="col-md-12" align="center">
                <div class="container-form container-form-login" id="container">
                    <div class="form-container sign-in-container">
                        <form action="{{ url('customer/auth/login') }}" method="POST" class="page-form page-form-login">
                            <input type="hidden" name="redirect_to_custom_url" value="{{ $path }}">
                            <input type="hidden" name="from_email" value="{{ $from_email }}">
                            @csrf
                            @if(session()->has('msg'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-{{ session('type') }} alert-dismissible">
                                        {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> --}}
                                        {{ session('msg') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            <h1>Sign In</h1>
                            <div class="social-container">
                                <a href="#" class="social form-a"><i class="fab fa-instagram"></i></a>
                                <a href="/customer/auth/google/login/redirect" class="social form-a"><i class="fab fa-google"></i></a>
                                <a href="/customer/auth/facebook/login/redirect" class="social form-a"><i class="fab fa-facebook"></i></a>
                            </div>
                            <span>or use your account</span>
                            <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" />
                            @error("email")
                            <div class="w-100 text-left">
                                <small class="text-danger text-left">{{ $errors->first('email') }}</small>
                            </div>
                            @enderror
                            <!-- <input type="email" placeholder="Email" /> -->
                            <!-- <input type="password" placeholder="Password" /> -->
                            <input type="password" name="password" placeholder="Password">
                            @error("password")
                            <div class="w-100 text-left">
                                <small class="text-danger text-left">{{ $errors->first('password') }}</small>
                            </div>
                            @enderror
                            <input type="hidden" name="activecart" value="{{ (session()->has('activecart')) ? session('activecart') : '' }}">
                            <!-- <a href="#" class="form-a">Forgot your password?</a> -->
                            <!-- <button onclick="return false;">Sign In</button> -->
                            <button type="submit" class="page-form-login-button">Sign In</button>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-right">
                                <h1>Don't have an account?</h1>
                                <p>Sign up now! </p>
                                <button class="ghost" id="signUp">Sign Up</button>
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


@section('page-css')
<link href="{{ url('assets/css/registration/style.css') }}" rel="stylesheet" media="screen" />
@endsection

@section('page-js')
<script src="{{ url('library/js/front/login/components.js') }}"></script>
@endsection