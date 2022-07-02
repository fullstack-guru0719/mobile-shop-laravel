@extends('layouts.front')
@section('content')
<div class="pt-70">
  <section class="products-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mt-50">
          <div class="text-center"><h1 class="products-header">Sell Your Devices</h1></div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container pt-70">
      <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
          <div class="card tronics">
            <div class="card-body tronics-wrap">
              <div class="text-center">
                @if(!empty($product->photo))
                <img src="{{ url($product->photo->photo) }}" class="img-fluid product-photo">
                @endif
                <h3 class="product-name">{{ $product->model }}</h3>
                <div class="tronics-links">
                  <a href="{{ url('products/sell', $product->id) }}" class="btn btn-warning btn-sm">Select this Device</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
</div>
@endsection

@section('page-css')
<link href="{{ url('assets/css/products.css') }}" rel="stylesheet">
<style>
.product-photo {
  height: 200px;
  width: 150px;
  object-fit: contain;
}
</style>
@endsection