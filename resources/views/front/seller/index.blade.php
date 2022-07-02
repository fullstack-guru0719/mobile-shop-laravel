@extends('layouts.front')
@section('content')
<div class="pt-70">
  <div class="container pt-70">
    <h3>Sell Your Device</h3>
    @if(count($errors->all()))
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul class="login-error">
          @foreach ($errors->all() as $message)
          <li>{{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ url('device/sold') }}" method="POST" enctype="multipart/form-data">
    @csrf
      <div class="row mt-30">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5>Device Information</h5>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Brand</label>
                  {!! Form::select('brand_id', $brandList, '', ['class'=>'custom-select select-sm']) !!}
                </div>
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Model</label>
                  <input type="text" name="model" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Price</label>
                  <input type="number" name="amount" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Color</label>
                  <input type="text" name="color" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Height (inches)</label>
                  <input type="number" name="height" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Width (inches)</label>
                  <input type="number" name="width" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Weight (ounce)</label>
                  <input type="text" name="weight" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Length (inches)</label>
                  <input type="text" name="length" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label class="col-form-label col-form-label-sm">Upload device photo</label>
                  <div>
                    <input type="file" name="photo[]" id="customFile" multiple>
                    <small id="customFile" class="form-text text-muted">You can upload multiple photos.</small>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-warning btn-md">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5>Personal Information</h5>
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
                  <label class="col-form-label col-form-label-sm">Username</label>
                  <input type="text" name="username" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-6">
                  <label class="col-form-label col-form-label-sm">Email</label>
                  <input type="email" name="email" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label class="col-form-label col-form-label-sm">Choose how you wish to be paid</label>
                  {!! Form::select('payment_method', $paymentList, '', ['class'=>'custom-select select-sm', 'id'=>'payment_method']) !!}
                </div>
              </div>
              <div class="form-row" id="payment-credentials">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <hr>
  </div>
</div>
@endsection

@section('page-css')
<style>
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
$(document).ready(function () {
  $('#payment_method').change(function() {
    var payment = $(this).val();
    if(payment == 'Apple Pay'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-6">'+
          '<label class="col-form-label col-form-label-sm">Apple ID</label>'+
          '<input type="text" name="account_username" class="form-control form-control-sm">'+
        '</div>'
      );
    }
    if(payment == 'Google Pay'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-8">'+
          '<label class="col-form-label col-form-label-sm">Email / Phone Number</label>'+
          '<input type="text" name="account_username" class="form-control form-control-sm">'+
          '<small id="customFile" class="form-text text-muted">Enter registered Google Pay email or phone number</small>'+
        '</div>'
      );
    }
    if(payment == 'Venmo'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-8">'+
          '<label class="col-form-label col-form-label-sm">Email / Phone Number</label>'+
          '<input type="text" name="account_username" class="form-control form-control-sm">'+
          '<small id="customFile" class="form-text text-muted">Enter registered Venmo email or phone number</small>'+
        '</div>'
      );
    }
    if(payment == 'Cash App'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-8">'+
          '<label class="col-form-label col-form-label-sm">Email / Phone Number</label>'+
          '<input type="text" name="account_username" class="form-control form-control-sm">'+
          '<small id="customFile" class="form-text text-muted">Enter registered Cash App email or phone number</small>'+
        '</div>'
      );
    }
    if(payment == 'Paypal'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-8">'+
          '<label class="col-form-label col-form-label-sm">Paypal Email</label>'+
          '<input type="text" name="account_username" class="form-control form-control-sm">'+
        '</div>'
      );
    }
    if(payment == 'Bank Transfer'){
      $('#payment-credentials').html(
        '<div class="form-group col-md-6">'+
          '<label class="col-form-label col-form-label-sm">Account Name</label>'+
          '<input type="text" name="account_name" class="form-control form-control-sm">'+
        '</div>'+
        '<div class="form-group col-md-6">'+
          '<label class="col-form-label col-form-label-sm">Account Number</label>'+
          '<input type="text" name="account_number" class="form-control form-control-sm">'+
        '</div>'+
        '<div class="form-group col-md-12">'+
          '<label class="col-form-label col-form-label-sm">Bank Name</label>'+
          '<input type="text" name="bank" class="form-control form-control-sm">'+
        '</div>'
      );
    }
  });
});
</script>
@endsection