<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Projects</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}">
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


            <div class="content-wrapper" style="min-height: 1731.56px;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Email Template</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item">Email Template</li>
                                    <li class="breadcrumb-item active">Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Email Template</h3>
                                    <div class="card-tools">
                                        <a href="{{ url('/demo/emailtemplate') }}" class="btn btn-primary btn-sm">Back</a>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Template Name:" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Subject:" value="">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="4" cols="" class="form-control" placeholder="Template Description:"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        Schedule after <input type="number" style="width: 75px;" value="0"> day(s) to follow up
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <select class="form-control">
                                                            <option>Receiver</option>
                                                            <option>Customer</option>
                                                            <option>TronicsPay</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <select class="form-control">
                                                            <option>Template Status</option>
                                                            <option>Active</option>
                                                            <option>In-Active</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <select class="form-control">
                                                            <option>Select Module</option>
                                                            <option>Registration</option>
                                                            <option>Orders</option>
                                                            <option>Products</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px"></textarea>                            
                                    </div>
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>
                                        <p class="help-block">Max. 32MB</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                                    </div>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Close</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
            </div>

        <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ url('assets/dist/js/demo.js') }}"></script>
        <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function () {
                //Add text editor
                $('#compose-textarea').summernote()
            })
        </script>
    </body>
</html>
