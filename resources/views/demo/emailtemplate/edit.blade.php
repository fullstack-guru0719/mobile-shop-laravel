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
                                        <input class="form-control" placeholder="Template Name:" value="7th day reminder">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Subject:" value="Howdy User">
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="4" cols="" class="form-control" placeholder="Template Description:">Remind customer to process there items.</textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        Schedule after <input type="number" style="width: 75px;" value="7"> day(s) to follow up
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
                                        <textarea id="compose-textarea" class="form-control" style="height: 300px">
                                            <h1><u>Heading Of Message</u></h1>
                                            <h4>Subheading</h4>
                                            <p>
                                                But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                                was born and I will give you a complete account of the system, and expound the actual teachings
                                                of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                                                dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                                                how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                                                is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                                                but because occasionally circumstances occur in which toil and pain can procure him some great
                                                pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                                                except to obtain some advantage from it? But who has any right to find fault with a man who
                                                chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                                                produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                                                dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                                                blinded by desire, that they cannot foresee
                                                </p>
                                            <ul>
                                                <li>List item one</li>
                                                <li>List item two</li>
                                                <li>List item three</li>
                                                <li>List item four</li>
                                            </ul>
                                            <p>Thank you,</p>
                                            <p>John Doe</p>
                                        </textarea>                            
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
