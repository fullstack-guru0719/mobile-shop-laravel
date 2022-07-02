@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2><i class="nav-icon fas fa-people-carry"></i> Manage Orders</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="{{ url('/home') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-people-carry"></i> Manage Orders</li>
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
                            <h4 id="table-header">Orders List</h4>
                        </div>
                        <div class="card-tools card-actions">
                            <div>
                                <div class="dropdown mr-2">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class="dropdown-item" type="button" onclick="UpdateBulkOrderStatus()">Change Status</button>
                                        <!-- <button class="dropdown-item" type="button" data-toggle="modal" data-target="#bulk-complete-modal" onclick="UpdateBulkStatus()">Make all complete</button> -->
                                        <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a href="#" class="dropdown-item" id="multi-delete-rows">Delete</a>
                                        </div> -->
                                        <button class="dropdown-item" type="button" id="bulk-delete-rows">Delete</button>
                                        {{-- <button class="dropdown-item" type="button" data-toggle="modal"
                                            data-target="#bulk-transit-modal">Make all In Transit</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal"
                                            data-target="#bulk-onhold-modal">Make all On Hold</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal"
                                            data-target="#bulk-comment-modal">Must have comments</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal"
                                            data-target="#bulk-for-approval-modal">Make All For Approval</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table-hover table-striped text-nowrap table-sm" id="order-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <input type="checkbox" name="select_all" id="select_all" value="" />
                                    </th>
                                    <th class="text-center">Tracking Code</th>
                                    <th class="text-center">Transaction ID</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Transaction Date</th>
                                    <th class="text-center">Notes</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.modals.order.bulk.complete')

<x-order-bulk-modal modal-id="bulk-transit-modal" modal-title="Mark all as In Transmit" message="This will mark all the selected items as" status="In Transmit" form-action="{{ route('orders.bulk_update',['type' => 'in-transit']) }}" form-id="bulk-in-transmit-form" />
<x-order-bulk-modal modal-id="bulk-onhold-modal" modal-title="Mark all as On Hold" message="This will mark all the selected items as" status="On Hold" form-action="{{ route('orders.bulk_update',['type' => 'on-hold']) }}" form-id="bulk-on-hold-form" />
<x-order-bulk-modal modal-id="bulk-comment-modal" modal-title="Mark all as must have COMMENTS" message="This will mark all the selected items must have" status="COMMENTS" form-action="{{ route('orders.bulk_update',['type' => 'have-comments']) }}" form-id="bulk-must-have-comment-form" />

<x-order-bulk-modal modal-id="bulk-for-approval-modal" modal-title="Mark all as For Approval" message="This will mark all the selected items to be" status="FOR APPROVAL" form-action="{{ route('orders.bulk_update',['type' => 'for-approval']) }}" form-id="bulk-for-approval-form" />

@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
<style>
    .text-right {
        text-align: right;
    }

    .align-top {
        vertical-align: top;
    }
</style>
@endsection

@section('page-js')
@include('admin.modals.order.modal-approve')
@include('admin.modals.order.modal-status')
@include('admin.modals.order.modal-notes-add')
@include('admin.modals.order.modal-notes-list')
<script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>
<script src="{{ url('library/js/admin/order/components.js') }}"></script>
<script>
    var orderTable;
    $(document).ready(function() {
        orderTable = $('#order-table').DataTable({
            processing: true,
            serverSide: true,
            "pagingType": "input",
            ajax: {
                url: "{{ url('api/orders/getorders') }}",
                type: 'POST'
            },
            searchCols: [
                null,
                null,
                null,
                null,
                null,
                {
                    search: "^(?!.*(ON HOLD|COMPLETE|ORDER COMPLETE)).*$",
                    regex: true
                },
                null,
                null,
                null,
            ],
            columns: [{
                    width: '2%',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className: "text-center align-top"
                },
                {
                    width: '2%',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return `<input type="checkbox" name="ids[]" value="${row.id}" />`
                    },
                },
                {
                    data: 'tracking_code',
                    name: 'tracking_code',
                    searchable: true,
                    orderable: true,
                    width: '22%',
                    className: "text-center"
                },
                {
                    data: 'order_no',
                    name: 'order_no',
                    searchable: true,
                    orderable: true,
                    width: '20%',
                    className: "text-center"
                },
                {
                    data: 'seller_name',
                    name: 'seller_name',
                    searchable: true,
                    orderable: true,
                    width: '18%',
                    className: "text-center"
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: true,
                    orderable: true,
                    width: '14%',
                    className: "text-center align-top",
                    search: "123"
                },
                {
                    data: 'transaction_date',
                    name: 'transaction_date',
                    searchable: true,
                    orderable: false,
                    width: '8%',
                    className: "text-right align-top"
                },
                {
                    data: 'order_notes',
                    name: 'order_notes',
                    searchable: false,
                    orderable: false,
                    width: '6%',
                    className: "text-center"
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
            initComplete: function() {
                const columnStatus = this.api().column(5)
                console.log(columnStatus.footer())
                const select = $('<select style="margin-left:5px"></select>')
                    .appendTo($("#order-table_filter"))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        columnStatus
                            .search(val === "" ? "^(?!.*(ON HOLD|COMPLETE|ORDER COMPLETE)).*$" : val, true, false)
                            .draw();
                    });
                select.append('<option value="">ALL</option>')
                select.append('<option value="ON HOLD">ON HOLD</option>')
                select.append('<option value="COMPLETE">COMPLETE</option>')
            }
        });
    });

    $("#select_all").on("change", function() {
        if (this.checked) {
            $("input[name='ids[]']").each(function() {
                $(this).prop('checked', true);
            });
        } else {
            $("input[name='ids[]']").each(function() {
                $(this).prop('checked', false);
            });
        }
    });


    $("#modal-bulk-status-order").on("show.bs.modal", function() {
        const form = $(this).find("#bulk-complete-form");
        fillSeletcedIds(form);
    });

    $("#bulk-transit-modal").on("show.bs.modal", function() {
        const form = $(this).find("#bulk-in-transmit-form");
        fillSeletcedIds(form);
    });

    $("#bulk-onhold-modal").on("show.bs.modal", function() {
        const form = $(this).find("#bulk-on-hold-form");
        fillSeletcedIds(form);
    });

    $("#bulk-comment-modal").on("show.bs.modal", function() {
        const form = $(this).find("#bulk-must-have-comment-form");
        fillSeletcedIds(form);
    });

    $("#bulk-for-approval-modal").on("show.bs.modal", function() {
        const form = $(this).find("#bulk-for-approval-form");
        fillSeletcedIds(form);
    });


    function fillSeletcedIds(form) {
        clearAllIds();
        appendAllIds(form);
    }

    function clearAllIds() {
        $("input[name='form_ids[]']").each(function() {
            $(this).remove();
        });
    }

    function appendAllIds(form) {
        $("input[name='ids[]']:checked").each(function() {
            let new_input = `<input name="form_ids[]" type="hidden" value="${$(this).val()}" />`;
            form.append(new_input);
        });
    }
</script>
@endsection