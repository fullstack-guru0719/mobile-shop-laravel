@extends('layouts.front')
@section('content')
    <div class="pt-70">
        <section class="products-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-50">
                        <div class="text-center"><h1 class="products-header">Smart & Style</h1></div>
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
                                            <!-- @if(in_array($product->device_type, ['Sell','Both'])) -->
                                            <div style="padding-bottom: 5px;">
                                                <a href="javascript:void(0)" onclick="addtocart(<?php echo $product->id; ?>)" class="btn btn-warning btn-sm"><i class="fas fa-shopping-cart fa-fw"></i> Add to Cart</a>
                                            </div>
                                            <!-- @endif -->
                                        <a href="{{ url('products', Str::slug($product->model)).'-'.$product->id }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-search fa-fw"></i> View Details</a>
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

@section('page-js')
<script>
    function addtocart(id){
        $.ajax({
            type: "POST",
            url: "{{ url('products/cart') }}",
            data: {
                qty: 1,
                product_id: id
            },
            dataType: "json",
                success: function (response) {
                $('.cart-counter').html('<i class="fas fa-shopping-cart fa-fw"></i> <span>'+response.cartcount+'</span>');
            }
        });
    }
</script>
@endsection