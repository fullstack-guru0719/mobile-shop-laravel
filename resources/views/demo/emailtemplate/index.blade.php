<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Projects</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>   
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="../../index3.html" class="brand-link">
                    <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>

                    <div class="form-inline">
                        <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ url('/demo/emailtemplate') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Email Template Manager
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Email Template Manager</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Email Template Manager</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Templates</h3>

                            <div class="card-tools">
                                <a href="{{ url('/demo/emailtemplate/create') }}" class="btn btn-primary btn-sm">Add Template</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 4%"># </th>
                                        <th style="width: 16%">Template Name</th>
                                        <th style="width: 16%">Description</th>
                                        <th style="width: 16%">Notify Schedule</th>
                                        <th style="width: 16%">Module</th>
                                        <th style="width: 16%" class="text-center">Status</th>
                                        <th style="width: 16%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            7th day reminder
                                        </td>
                                        <td>
                                            Remind customer to process there items.
                                        </td>
                                        <td>
                                            7 Days
                                        </td>
                                        <td class="project_progress">
                                            Order
                                        </td>
                                        <td class="project-state">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                            <td class="project-actions text-right">
                                                <a class="btn btn-primary btn-sm" href="{{ url('demo/emailtemplate/edit') }}">
                                                    <i class="fas fa-folder"></i>
                                                    View
                                                </a>
                                                <a class="btn btn-info btn-sm" href="{{ url('demo/emailtemplate/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <!-- <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </a> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </section>
                </div>

                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0
                    </div>
                    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
                </footer>
            </div>

        <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ url('assets/dist/js/demo.js') }}"></script>
    </body>
</html>
