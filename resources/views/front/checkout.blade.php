@extends('layouts.front')
@section('content')
<div class="pt-70">
  <div class="container pt-50">
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">
            <div id="badge-count">{{ $cartcount }}</div>
          </span>
        </h4>
        <form action="{{ url('products/checkout') }}" method="POST">
          @csrf
          <ul class="list-group mb-3">
            @foreach($carts as $cart)
            <li class="list-group-item d-flex justify-content-between lh-condensed" id="{{ $cart->rowId }}">
              <div>
                <h6 class="my-0">{{ $cart->name }}</h6>
                <small class="text-muted">
                  Qty: {{ $cart->qty }}<br>
                  Tax: {{ '$'.number_format($tax, 2) }}<br>
                  Weight: {{ $cart->options->weight }}
                </small>
              </div>
              <span class="text-muted">
                {{ '$'.number_format($cart->subtotal, 2) }}<br>
                <a href="javascript:void(0)" onclick="removeItem('<?php echo $cart->rowId; ?>')" class="cart-link"><i class="fas fa-trash-alt"></i> Remove</a>
              </span>
            </li>
            @endforeach
            @if(!empty($ship))
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div style="width: 100%;">
                <h6 class="my-0">Shipping Fee</h6>
                <div style="padding: 10px 0; width: 100%;">
                  <select class="custom-select select-sm" name="rate" id="ship-fee">
                    @foreach($ship->rates as $rate)
                    <option value="{{ $rate->retail_rate }}">{{ $rate->service }} @ ${{ $rate->retail_rate }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </li>
            @endif
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>
                <div id="cart-total-amount">${{ $totalamount }}</div>
              </strong>
            </li>
          </ul>
          <div class="form-group">
            <hr class="mb-4">
            <input type="hidden" name="total" id="purchase-total">
            <input type="hidden" id="cart-total" value="{{ $totalamount }}">
            <input type="hidden" name="customer_id" value="{{ isset($customer->id) ? $customer->id : '' }}">
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn-checkout" {{ ($cartcount == 0) ? 'disabled' : '' }}>Continue to checkout</button>
          </div>
        </form>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>First name</label>
            <input type="text" name="fname" class="form-control" value="{{ isset($customer->fname) ? $customer->fname : '' }}">
          </div>
          <div class="col-md-6 mb-3">
            <label>Last name</label>
            <input type="text" name="lname" class="form-control" value="{{ isset($customer->lname) ? $customer->lname : '' }}">
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" name="username" class="form-control" id="username" value="{{ isset($customer->username) ? $customer->username : '' }}">
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" value="{{ isset($customer->email) ? $customer->email : '' }}">
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" name="street" class="form-control" id="address" placeholder="1234 Main St" value="{{ !empty($customer->bill) ? $customer->bill->street : '' }}">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ !empty($customer->bill) ? $customer->bill->phone : '' }}">
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            {!! Form::select('state', $stateList, !empty($customer->bill) ? $customer->bill->state : '', ['class'=>'custom-select d-block w-100','id'=>'state']) !!}
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" id="zip" value="{{ !empty($customer->bill) ? $customer->bill->zip : '' }}">
          </div>
        </div>
        <hr class="mb-4">
        <h4 class="mb-3">Payment</h4>
        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" checked>
            <label class="custom-control-label" for="paypal">Paypal</label>
          </div>
        </div>
        <hr class="mb-4">
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-css')
<style>
  .cart-link,
  .cart-link:hover {
    text-decoration: none;
    font-size: 13px;
    color: #dc3545;
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
  $(document).ready(function() {
    var total = parseFloat($('#ship-fee').val()) + parseFloat($('#cart-total').val().replace(',', ''));
    $('#cart-total-amount').html('$' + total);
    $('#purchase-total').val(total);

    $('#ship-fee').change(function() {
      var total = parseFloat($(this).val()) + parseFloat($('#cart-total').val().replace(',', ''));
      $('#cart-total-amount').html('$' + total);
      $('#purchase-total').val(total);
    });
  });

  function removeItem(id) {
    $.ajax({
      type: "DELETE",
      url: "{{ url('products/cart') }}/" + id,
      dataType: "json",
      success: function(response) {
        if (response.totalamount == 0) {
          var total = '0.00';
        } else {
          var total = parseFloat($('#ship-fee').val()) + parseFloat(response.totalamount).replace(',', '');
        }
        $('#' + id).remove();
        $('.cart-counter').html('<i class="fas fa-shopping-cart fa-fw"></i> <span>' + response.cartcount + '</span>');
        $('#cart-total-amount').html('$' + total);
        $('#badge-count').html(response.cartcount);
        if (response.cartcount == 0) {
          $('#btn-checkout').attr('disabled', true);
        }
      }
    });
  }
</script>
@endsection