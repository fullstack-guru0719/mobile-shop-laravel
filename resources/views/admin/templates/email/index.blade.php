@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-envelope"></i> Manage Email Template</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-cogs"></i> Templates</li>
                            <li class="breadcrumb-item active">Email Template List</li>
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
                                <a href="javascript:void(0)" id="create-emailtemplate" class="btn btn-primary btn-sm">Create Template</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table-hover table-striped text-nowrap table-sm" id="emailtemplate-table">
                                <thead>
                                    <tr>
                                        <th style="width: 4%"># </th>
                                        <th style="width: 16%">Template Name</th>
                                        <th style="width: 16%">Description</th>
                                        <th style="width: 16%" class="text-center">Module</th>
                                        <th style="width: 16%" class="text-center">Status</th>
                                        <th style="width: 16%" class="text-center">Notify Schedule</th>
                                        <th style="width: 16%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}">
    
@endsection

@section('page-js')
    @include('admin.modals.templates.email.modal')
    <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ url('library/js/admin/template/components.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#email-content').summernote({ height: 300 });
        });
    </script>
@endsection