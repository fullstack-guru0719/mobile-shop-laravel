@extends('layouts.app')
@section('content')
<style>
    @media (max-width: 850px) {
        .dataTable {
            white-space: nowrap !important;
        }
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2><i class="nav-icon fas fa-shopping-basket"></i> Manage Products</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-shopping-basket"></i> Manage Products</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h4 id="table-header">Product List</h4>
                        </div>
                        <div class="card-tools card-actions">
                            <div>
                                <div class="dropdown mr-2">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <button class="dropdown-item" type="button" data-toggle="modal"
                                            data-target="#bulk-copy-modal">Copy</button> --}}
                                        <button class="dropdown-item" type="button" id="bulk-edit-btn">Edit</button>
                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#bulk-delete-modal">Delete</button>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ url('admin/products/create') }}">Create Product</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-hover table-striped table-sm" id="product-table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>
                                            <input type="checkbox" name="select_all" id="select_all">
                                        </th>
                                        <th class="text-center">Photo</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Color</th>
                                        <th>Other Info</th>
                                        <th>Last Updated Date</th>
                                        <th>Created Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <input type="hidden" id="filtertype" value="Both">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.modals.products.bulk.delete')
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
<style>
    .card-actions {
        display: flex !important;
        flex-flow: row;
        justify-content: center;
    }
</style>
@endsection

@section('page-js')
@include('admin.modals.products.modal')
{!! JsValidator::formRequest('App\Http\Requests\Admin\ProductDupRequest') !!}
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>

<script src="{{ url('library/js/admin/products/components.js') }}"></script>
<script type="text/javascript">
    var productTable;
    $(document).ready(function() {
        var base_url = $('body').attr('data-url');
        <?php if (session()->has('msg')) { ?>
            toastr.success('<?php echo session('msg'); ?>')
        <?php } ?>

        productTable = $('#product-table').DataTable({
            searchDelay: 1000,
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: base_url + '/admin/products/getproduct',
                type: 'POST'
            },
            columns: [{
                    width: '2%',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className: "text-center"
                },
                {
                    width: "2%",
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" name="ids[]" value="${row.id}" />`;
                    },
                },
                {
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false,
                    width: '10%',
                    className: "text-center"
                },
                {
                    data: 'brand',
                    name: 'brand',
                    searchable: true,
                    orderable: true,
                    width: '14%'
                },
                {
                    data: 'model',
                    name: 'model',
                    searchable: true,
                    orderable: true,
                    width: '23%'
                },
                {
                    data: 'color',
                    name: 'color',
                    searchable: false,
                    orderable: false,
                    width: '9%'
                },
                {
                    data: 'otherInfo',
                    name: 'otherInfo',
                    searchable: false,
                    orderable: false,
                    width: '21%'
                },
                {
                    data: 'dateUpdated',
                    name: 'dateUpdated',
                    searchable: false,
                    orderable: true,
                    width: '4%'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    searchable: false,
                    orderable: true,
                    width: '4%'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    width: '10%',
                    className: "text-center"
                },
            ],

        });

        // $('#chk-buying').change(function(){
        //     if($(this).prop('checked') == true && $('#chk-selling').prop('checked') == false){
        //         filter('Buy');
        //     } 
        //     if($(this).prop('checked') == true && $('#chk-selling').prop('checked') == true){
        //         filter('Both');
        //     }
        //     if($(this).prop('checked') == false && $('#chk-selling').prop('checked') == true){
        //         filter('Sell');
        //     } 
        //     if($(this).prop('checked') == false && $('#chk-selling').prop('checked') == false){
        //         filter('None');
        //     } 
        // })

        // $('#chk-selling').change(function(){
        //     if($(this).prop('checked') == true && $('#chk-buying').prop('checked') == false){
        //         filter('Sell');
        //     } 
        //     if($(this).prop('checked') == true && $('#chk-buying').prop('checked') == true){
        //         filter('Both');
        //     } 
        //     if($(this).prop('checked') == false && $('#chk-buying').prop('checked') == true){
        //         filter('Buy');
        //     } 
        //     if($(this).prop('checked') == false && $('#chk-buying').prop('checked') == false){
        //         filter('None');
        //     }
        // });

        $("#select_all").on("click", function() {
            if (this.checked) {
                $("input[name='ids[]']").each(function() {
                    $(this).prop('checked', true);
                })
            } else {
                $("input[name='ids[]']").each(function() {
                    $(this).prop('checked', false);
                })
            }
        });

        $("#bulk-edit-btn").on("click", function() {
            $("input[name='ids[]']").each(function() {
                if (this.checked) {
                    const editUrl = $(this).parent().parent().find("a")[0].href
                    var win = window.open(editUrl, '_blank')
                    if (win) {
                        win.focus()
                    } else {
                        // When popups are blocked
                        alert('Please allow popups for this website')
                        this.message = 'Please allow popups for this website'
                    }
                }
            })
        });

        $('#excellent_offer').keyup(function() {
            if ($('#offer_type').prop('checked')) {
                var good = percent($('#excellent_offer').val(), 'good');
                var fair = percent($('#excellent_offer').val(), 'fair');
                var poor = percent($('#excellent_offer').val(), 'poor');
                $('#good_offer').val(good);
                $('#fair_offer').val(fair);
                $('#poor_offer').val(poor);
            }
        });

        $("#bulk-delete-modal").on("show.bs.modal", function() {
            const form = $(this).find("#bulk-delete-form");
            $("input[name='deleting_ids[]']").each(function() {
                $(this).remove();
            });

            $("input[name='ids[]']:checked").each(function() {
                let new_input = `<input name="deleting_ids[]" type="hidden" value="${$(this).val()}" />`;
                form.append(new_input);
            });
        });

        $("#bulk_delete_submit").on("click", function() {
            console.log('clicked');
            $("#bulk-delete-form").submit();
        });

        $('#offer_type').change(function() {
            if ($(this).prop('checked')) {
                var good = percent($('#excellent_offer').val(), 'good');
                var fair = percent($('#excellent_offer').val(), 'fair');
                var poor = percent($('#excellent_offer').val(), 'poor');
                $('#good_offer').val(good);
                $('#fair_offer').val(fair);
                $('#poor_offer').val(poor);
            }
        });

        $('#product-form').submit(function(e) {
            e.preventDefault();
            if ($(this).valid()) {
                var data = $(this).serializeArray();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/products/storeduplicate') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.response == 2) {
                            $('#exist-error').show();
                        }
                        if (response.response == 1) {
                            productTable.draw();
                            $('#modal-product').modal('hide');
                        }
                        setInterval(function() {
                            $('#exist-error').fadeOut()
                        }, 3000);
                    }
                });
            }
        });
    });


    // function filter(type){
    //     if(type == 'Sell'){
    //         $('#table-header').html('Selling Product');
    //     } else if(type == 'Buy') {
    //         $('#table-header').html('Buying Product');
    //     } else if(type == 'None') {
    //         $('#table-header').html('');
    //     } else {
    //         $('#table-header').html('Both Selling and Buying');
    //     }
    //     $('#product-table').DataTable().destroy();
    //     $('#product-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         "pagingType": "input",
    //         ajax: {
    //             url: "{{ url('admin/products/postproduct') }}",
    //             type:'POST',
    //             data: {
    //                 device_type: type
    //             }
    //         },
    //         columns: [
    //             {
    //                 width:'2%', searchable: false, orderable: false,
    //                 render: function (data, type, row, meta) {
    //                     return meta.row + meta.settings._iDisplayStart + 1;
    //                 }, 
    //                 className: "text-center"
    //             },
    //             { data: 'photo', name: 'photo', searchable: false, orderable: false, width:'10%', className: "text-center" },
    //             { data: 'brand', name: 'brand', searchable: true, orderable: true, width:'20%' },
    //             { data: 'model', name: 'model', searchable: true, orderable: true, width:'25%' },
    //             { data: 'type', name: 'type', searchable: false, orderable: false, width:'5%' },
    //             { data: 'otherInfo', name: 'otherInfo', searchable: false, orderable: false, width:'25%' },
    //             { data: 'action', name: 'action', searchable: false, orderable: false, width:'10%', className: "text-center" },
    //         ]
    //     });
    // }

    function duplicate(id) {
        $('#product_id').val(id);
        $.ajax({
            type: "GET",
            url: "{{ url('admin/products') }}/" + id,
            dataType: "json",
            success: function(response) {
                $('#excellent_offer').val('');
                $('#good_offer').val('');
                $('#fair_offer').val('');
                $('#poor_offer').val('');
                $('#modal-product').modal();
            }
        });
    }

    // function percent(amount, offer) {
    //     goodPrice = parseFloat($('#good').val());
    //     fairPrice = parseFloat($('#fair').val());
    //     poorPrice = parseFloat($('#poor').val());
    //     amount = parseFloat(amount);
    //     if(offer == 'good'){
    //         return amount - (goodPrice / 100 * amount);
    //     }
    //     if(offer == 'fair'){
    //         return amount - (fairPrice / 100 * amount);
    //     }
    //     if(offer == 'poor'){
    //         return amount - (poorPrice / 100 * amount);
    //     }
    // }
</script>
@endsection