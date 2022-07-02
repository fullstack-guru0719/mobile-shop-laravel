@extends('layouts.front')
@section('content')
<?php
  $result = @json_decode(session('result'));
?>
<div class="pt-70">
  <div class="container pt-70">
    <div class="row">
      <div class="col-md-12">
        <div class="text-center">
          <h3>Thank you {{ isset($result->fname) ? $result->fname : '' }} for selling {{ isset($result->model) ? $result->model : '' }}!</h3>
          <p>
            We are currently reviewing the device, we send a confirmation email.<br>
            Please check your email and login at <a href="{{ url('customer/auth/login') }}">Member Login</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection