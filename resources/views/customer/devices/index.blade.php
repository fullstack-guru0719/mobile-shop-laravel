@extends('layouts.customer')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2><i class="nav-icon fas fa-mobile-alt"></i> My Devices</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('customer/dashboard') }}" class="fontGray1"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li class="breadcrumb-item"><i class="nav-icon fas fa-mobile-alt"></i> My Devices</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Devices</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped text-nowrap table-sm" id="my-device-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Device</th>
                                <th><center>Carrier</center></th>
                                <th><center>Storage</center></th>
                                <th><center>Quantity</center></th>
                                <th><center>Amount</center></th>
                                <th align="center"><center>Status</center></th>
                                <th><center>Action</center></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                Footer
            </div>
        </div>
    </section>
</div>
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