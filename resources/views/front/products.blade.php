@extends('layouts.front')
@section('content')
    <div class="pt-70">
		{!! isset($page) ? $page->html : '' !!}
        <section>
            <div class="container pt-70">
                <div class="row">
                    <div class="col-md-12">
                        <div id="div-product-list"></div>
                    </div>
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
    {!! isset($page) ? $page->css : '' !!}
</style>
@endsection

@section('page-js')
<script src="{{ url('./library/js/front/products/jsactions.js') }}"></script>
@endsection