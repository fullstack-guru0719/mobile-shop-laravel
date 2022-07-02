@extends('layouts.app')
@section('content')
<?php
function selectItem($array, $key, $val)
{
    foreach ($array as $counter => $item) {
        // return $item[$key];
        if (isset($item[$key]) && $item[$key] == $val)
            return true;
    }
    return false;
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2><i class="nav-icon fas fa-shopping-basket"></i> Edit Device</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-shopping-basket"></i> Manage Products</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="{{ url('admin/products', $product->hashedid) }}" id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products.form')
            <input type="hidden" id="good" value="{{ $config->good }}">
            <input type="hidden" id="fair" value="{{ $config->fair }}">
            <input type="hidden" id="poor" value="{{ $config->poor }}">
            <input type="hidden" name="id" id="product_id" value="{{ $product->id }}" />
        </form>
    </section>
</div>
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
@include('admin.modals.products.sell.modal')
@include('admin.modals.products.buy.modal')
@include('admin.modals.products.buy.edit')
<script>
    var product_hashed_id = "{{ $product_id }}";
</script>
{!! JsValidator::formRequest('App\Http\Requests\Admin\ProductRequest') !!}
<script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ url('library/js/admin/products/components.js') }}"></script>
<script>
    $(document).ready(function() {
        <?php if (session()->has('msg')) { ?>
            swalWarning("Congratulations", "<?php echo session('msg'); ?>", "success", "Close");
        <?php } ?>
        <?php if (session()->has('errormsg')) { ?>
            swalWarning("Oops", "<?php echo session('errormsg'); ?>", "waarning", "Close");
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

        $('#remove-photo').click(function() {
            if (confirm('Are you sure you want to delete this photo?')) {
                var id = $('#product_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/products/deletephoto') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {

                    }
                });
            }
        });
    });
</script>
@endsection