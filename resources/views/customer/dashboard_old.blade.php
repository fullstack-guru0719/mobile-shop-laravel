@extends('layouts.customer')
@section('content')

    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Welcome {{ Auth::guard('customer')->user()->fullname }}!</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <!-- <div class="row">
                <div class="col-md-12">
                    <h4>My Orders</h4>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-striped text-nowrap table-sm" id="order-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Photo</th>
                                        <th>Order Number</th>
                                        <th>Product Name</th>
                                        <th>SKU</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row" style="padding-top: 50px;">
                <div class="col-md-12">
                    <h4>My Devices</h4>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-striped text-nowrap table-sm" id="my-device-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Device</th>
                                        <th>Carrier</th>
                                        <th>Storage</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
@endsection

@section('page-js')
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>
    <script>
        var deviceTable;
        var orderTable;
        $(document).ready(function () {

            // orderTable = $('#order-table').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     "pagingType": "input",
            //     ajax: {
            //         url: "{{ url('customer/getorders') }}",
            //         type:'POST'
            //     },
            //     columns: [
            //         {
            //             width:'2%', searchable: false, orderable: false,
            //             render: function (data, type, row, meta) {
            //                 return meta.row + meta.settings._iDisplayStart + 1;
            //             }, className: "text-center"
            //         },
            //         { data: 'photo', name: 'photo', searchable: false, orderable: false, width:'10%', className: "text-center" },
            //         { data: 'order_number', name: 'order_number', searchable: true, orderable: true, width:'15%' },
            //         { data: 'model', name: 'model', searchable: true, orderable: true, width:'25%' },
            //         { data: 'sku', name: 'sku', searchable: false, orderable: false, width:'15%', className: "text-center" },
            //         { data: 'amount', name: 'amount', searchable: false, orderable: false, width:'15%' },
            //         { data: 'status', name: 'status', searchable: false, orderable: false, width:'15%' },
            //     ]
            // });
        });
    </script>
@endsection