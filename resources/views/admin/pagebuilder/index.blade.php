@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="nav-icon fas fa-file"></i> Page Builder</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-file"></i> Page Builder</li>
                            <li class="breadcrumb-item active">List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <!-- <div class="card-header">
                    <div class="card-tools">
                        <a href="javascript:void(0);" id="create-page" class="btn btn-primary btn-sm">Create Page</a>
                    </div>
                </div> -->
                <div class="card-body table-responsive" style="margin:5px;padding:5px;overflow:hidden">
                    {{-- <iframe src="{{ url('/admin/204') }}" style="overflow:hidden;height:50vh;width:100%;border: none;" height="100%" width="100%"></iframe> --}}
                    <iframe src="{{ url('/admin/pages') }}" style="overflow:hidden;height:80vh;width:100%;border: none;" height="100%" width="100%"></iframe>
                    <table class="table table-hover text-nowrap table-sm">
                        <thead>
                            <tr>
                                <th style="width: 3%;">#</th>
                                <th style="width: 42%;">Title</th>
                                <th style="width: 45%;">URL/LINK</th>
                                <th style="width: 10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pageBuilder))
                                @forelse($pageBuilder as $key => $page)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->url }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                <div class="dropdown-menu" aria-labelledby="action-btn">
                                                    <a class="dropdown-item font14px" href="{{ '../'.$page->url }}" target="_blank"><i class="fa fa-eye fa-fw"></i> View</a>
                                                    <a class="dropdown-item font14px" href="{{ url('admin/pagebuilder/'.$page->hashedid.'/tags') }}"><i class="fa fa-hashtag fa-fw"></i> Meta Tags</a>
                                                    <a class="dropdown-item font14px edit-page" data-attr-identification="{{ $page->id }}" data-attr-id="{{ $page->hashedid }}" href="javascript:void(0);"><i class="fa fa-edit fa-fw"></i> Edit</a>
                                                    <a class="dropdown-item font14px"href="{{ url('admin/pagebuilder/'.$page->hashedid.'/build') }}"><i class="fa fa-cog fa-fw"></i> Settings</a>
                                                    <a class="dropdown-item font14px" href="javascript:void(0)"><i class="fa fa-trash-alt fa-fw"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Available Data</td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- @section('page-css') --}}
{{-- <link rel="stylesheet" href="{{ url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"> --}}
{{-- @endsection --}}

@section('page-js')
@include('admin.modals.pagebuilder.index')
<script src="{{ url('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('./library/js/admin/pagebuilder/jsactions.js') }}"></script>
<!-- {!! JsValidator::formRequest('App\Http\Requests\PageRequest') !!} -->
@endsection