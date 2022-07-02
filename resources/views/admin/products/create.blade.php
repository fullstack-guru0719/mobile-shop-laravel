@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-shopping-basket"></i> Add New Device</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-shopping-basket"></i> Manage Products</li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <form action="{{ url('admin/products') }}" method="POST" id="productForm" enctype="multipart/form-data">
                @csrf
                @include('admin.products.form')
                <input type="hidden" id="good" value="{{ $config->good }}">
                <input type="hidden" id="fair" value="{{ $config->fair }}">
                <input type="hidden" id="poor" value="{{ $config->poor }}">
                <input type="hidden" name="id" id="product_id" value="0" />
            </form>
        </section>
    </div>
    @include('admin.modals.products.sell.modal')
    @include('admin.modals.products.buy.modal')
    @include('admin.modals.products.buy.edit')
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.css') }}">
    <style>
        .fn label {
            font-weight: normal !important;
        }
        .fn p {
            font-size: .875rem;
        }
        .config-legend {
            margin-left: 9px;
        }
        .pb-50 {
            padding-bottom: 50px;
        }
    </style>
@endsection

@section('page-js')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequest') !!}
<script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ url('library/js/admin/products/components.js') }}"></script>
<script>
$(document).ready(function() {

    <?php if(session()->has('errormsg')){ ?>
            toastr.error('<?php echo session('errormsg'); ?>')
    <?php } ?>
    $('.textarea').summernote({
        tabsize: 2,
        height: 150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });

});

</script>
@endsection