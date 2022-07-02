@extends('layouts.front')
@section('content')
<div class="pt-70">asd
  <section>
    <div class="container pt-70 pb-50">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-body">
              <div class="media">
                <img src="{{ url($product->photo->photo) }}" class="mr-3" style="width: 200px;">
                <div class="media-body">
                  <h3 class="mt-0">You choose to sell {{ $product->model }}</h3>
                  <br>
                  <p>
                    <b>Price Offer: </b>${{ $product->amount }}<br>
                    @if($product->dimension)
                    <b>Device Dimension (inches): </b>{{ $product->dimension }}<br>
                    @endif
                    @if($product->weight)
                    <b>Device Weight: </b>{{ $product->weight }} oz<br>
                    @endif
                    <b>Carrier: </b>USPS<br>
                    <div id="checkout-div">
                      <a href="javascript:void(0)" id="proceed-checkout" class="btn btn-warning btn-md">Proceed to Checkout</a>
                    </div>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-30">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-body">
              <h4>Provide your shipping address</h4>
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
                  <input type="text" name="address1" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-4">
                  <label class="col-form-label col-form-label-sm">State</label>
                  {!! Form::select('state_id', $stateList, '', ['class'=>'custom-select select-sm']) !!}
                </div>
                <div class="form-group col-md-4">
                  <label class="col-form-label col-form-label-sm">Zip Code</label>
                  <input type="text" name="address2" class="form-control form-control-sm">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-5">
                  <label class="col-form-label col-form-label-sm">Phone</label>
                  <input type="text" name="phone" class="form-control form-control-sm">
                </div>
                <div class="form-group col-md-7">
                  <label class="col-form-label col-form-label-sm">How would you like to be paid?</label>
                  {!! Form::select('payment_method', $paymentList, '', ['class'=>'custom-select select-sm','id'=>'payment_method']) !!}
                </div>
              </div>
              <div class="form-row" id="payment-row"></div>
              <div class="form-group">
                <div class="float-right">
                  <a href="javascript:void(0)" class="btn btn-warning btn-md">Continue</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('page-css')
<style>
.img-70 {
  width: 70%;
}
.select-sm {
  height: 31px;
  padding: 0px 8px;
  font-size: 14px;
}
</style>
@endsection

@section('page-js')
<script>
$(document).ready(function () {
  $('#payment_method').change(function(){
    var payment = $(this).val();
    $('#payment-row').html(
      '<div class="spinner-border" role="status">'+
        '<span class="sr-only">Loading...</span>'+
      '</div>'
    );
    $.ajax({
      type: "POST",
      url: "{{ url('products/sell/payment-method') }}",
      data: {
        payment: payment
      },
      dataType: "json",
      success: function (response) {
        $('#payment-row').html(response.content);
      }
    });
  });
});
</script>
@endsection