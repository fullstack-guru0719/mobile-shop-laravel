@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-list"></i> Manage Menus</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-cogs"></i> Settings</li>
                            <li class="breadcrumb-item active">Menu List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table-hover table-striped text-nowrap table-sm" id="menu-table">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Menu Name</th>
                                        <th>Menu URL</th>
                                        <th>Target</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $key => $menu)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $menu->name }}</td>
                                            <td>{{ $menu->menu_url }}</td>
                                            <td>{{ isset($menu->target_type) ? $menu->target_type : '_self' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection