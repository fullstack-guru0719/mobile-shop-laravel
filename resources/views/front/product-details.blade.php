@extends('layouts.front')
@section('content')
<div class="pt-70">
  <section>
    <div class="container pt-70 pb-50">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center">
            <img src="{{ url($photos[0]->photo) }}" class="img-fluid">
          </div>
          <div class="col-12 product-image-thumbs">
            @foreach($photos as $photo)
            <div class="product-image-thumb"><img src="{{ url($photo->photo) }}" alt="TronicsPay"></div>
            @endforeach
          </div>
        </div>
        <div class="col-md-6" style="border-left: 1px solid #eee;">
          <h3>{{ $product->model }}</h3>
          <p>{{ $product->brand->name }} | SKU: {{ $product->sku }}</p>
          {!! $product->description !!}
          <h4>Product Details</h4>
          <p style="font-size:14px">
            {!! ($product->height) ? 'Height: '.$product->height.' &bull; ' : '' !!}
            {!! ($product->width) ? 'Width: '.$product->width.' &bull; ' : '' !!}
            {!! ($product->length) ? 'Length: '.$product->length.' &bull; ' : '' !!}
            {!! ($product->weight) ? 'Weighs: '.$product->weight.' &bull; ' : '' !!}
          </p>
          <form id="cartForm">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-2">
                <label class="col-form-label col-form-label-sm">Qty</label>
                <input type="number" name="qty" id="product-qty" class="form-control form-control-sm" value="1">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label class="col-form-label col-form-label-sm">Price</label>
                <div id="product-amount">${{ $product->cost }}</div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <input type="hidden" name="price" id="product-cost" value="{{ $product->amount }}">
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-warning"><i class="fas fa-shopping-cart fa-fw"></i> Add to Cart</button>
                <a href="#" class="btn btn-outline-warning"><i class="fas fa-heart fa-fw"></i> Add to Wishlist</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('page-css')
<link href="{{ url('assets/css/products.css') }}" rel="stylesheet">
@endsection

@section('page-js')
<script>
$(document).ready(function () {
  var cost = $('#product-cost').val();
  $('#product-qty').change(function() {
    var qty = $(this).val();
    var total = (cost * qty)
    $('#product-amount').html('$'+number(parseFloat(total).toFixed(2)));
  });

  $('#cartForm').submit(function(e) {
    e.preventDefault();
    var data = $('#cartForm').serializeArray();
    $.ajax({
      type: "POST",
      url: "{{ url('products/cart') }}",
      data: data,
      dataType: "json",
      success: function (response) {
        $('.cart-counter').html('<i class="fas fa-shopping-cart fa-fw"></i> <span>'+response.cartcount+'</span>');
      }
    });
  });
});

function number(nStr){
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
</script>
@endsection