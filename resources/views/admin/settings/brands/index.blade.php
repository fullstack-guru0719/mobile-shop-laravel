@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-tag"></i> Manage Brands</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-cogs"></i> Settings</li>
                            <li class="breadcrumb-item active">Brands List</li>
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
                            <div class="card-tools">
                                <a href="javascript:void(0)" id="create-brand" class="btn btn-primary btn-sm">Create Brand</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table-hover table-striped text-nowrap table-sm" id="brand-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Photo</th>
                                            <th>Brand Name</th>
                                            <th>Device Type</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('admin.modals.brands.modal')
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
    <script type="text/javascript">
        var brandTable;
        var baseUrl = $('body').attr('data-url');
        $(document).ready(function() {
            brandTable = $('#brand-table').DataTable({
                processing: true,
                serverSide: true,
                "pagingType": "input",
                ajax: {
                    url: baseUrl+'/api/settings/brands/getbrand',
                    type:'POST'
                },
                columns: [
                    {
                        width:'2%', searchable: false, orderable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, className: "text-center"
                    },
                    { data: 'photo', name: 'photo', searchable: false, orderable: false, width:'10%', className: "text-center" },
                    { data: 'name', name: 'name', searchable: true, orderable: true, width:'25%' },
                    { data: 'device_type', name: 'device_type', searchable: false, orderable: false, width:'15%' },
                    { data: 'updated_at', name: 'updated_at', searchable: false, orderable: false, width:'15%' },
                    { data: 'action', name: 'action', searchable: false, orderable: false, width:'20%', className: "text-center"},
                ]
            });

            $('#create-brand').click(function (){
                $('#brand-form')[0].reset();
                $('#div-image').hide();
                $('#image-file').show();
                $('#modal-brand').modal();
            });

            $('#brand-form').submit(function(e) {
                e.preventDefault();
                if($(this).valid())
                {
                    var fdata = new FormData();
                    var data = $(this).serializeArray();
                    fdata.append('photo', $("[name='photo']").prop('files')[0]);
                    $.each(data,function(key,input){
                        fdata.append(input.name, input.value);
                    });

                    // doAjaxProcess('POST', '', fdata, baseUrl+'/api/settings/brands');
                    $.ajax({
                        type: "POST",
                        url: baseUrl+'/api/settings/brands',
                        data: fdata,
                        dataType: "json",
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $('#modal-brand').modal('hide');
                            // brandTable.draw();
                            swalWarning ("Completed", "Record has been successfully added", "success", "OK");
                        }
                    });
                }
            });

            $(document).on('click', '#remove-image', function() {
                $('#div-image').hide();
                $('#image-file').show();
            });
        });

        function updatebrand(id){
            $.ajax({
                type: "GET",
                url: baseUrl+'/api/settings/brands/'+id+'/edit',
                dataType: "json",
                success: function (response) {
                    $('#brand-name').val(response.brand.name);
                    $('#brand_id').val(response.brand.id);
                    $('#device_type').val(response.brand.device_type);
                    $('#feature').val(response.brand.feature);
                    if(response.brand.photo){
                        $('#div-image').show();
                        $('#image-file').hide();
                        $('#image-val').val(response.brand.photo_display)
                    }
                    $('#modal-brand').modal();
                }
            });
        }

        function deletebrand(hashedId){
            var form_url = baseUrl+'/api/settings/brands/'+hashedId;
            doAjaxConfirmProcessing('DELETE', '', {}, form_url);
        }
    </script>
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SettingsBrandRequest') !!}
@endsection