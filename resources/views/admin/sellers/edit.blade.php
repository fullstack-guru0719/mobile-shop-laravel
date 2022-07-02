@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Device From Customer</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Device From Customer</li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <form action="{{ url('admin/products', $hashedId) }}" id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.sellers.form')
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
        f   ont-size: .875rem;
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
    @include('admin.modals.transactions.customersell.modal')
    <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('library/js/admin/products/components.js') }}"></script>
    <script src="{{ url('library/js/admin/customertransaction/customersell/components.js') }}"></script>
    <script>
        $(document).ready(function() {
            <?php if(session()->has('msg')){ ?>
                toastr.success('<?php echo session('msg'); ?>')
            <?php } ?>
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

            $('#remove-photo').click(function(){
                if(confirm('Are you sure you want to delete this photo?')){
                var id = $('#product_id').val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/products/deletephoto') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (response) {

                    }
                });
                }
            });
        });

    </script>
@endsection