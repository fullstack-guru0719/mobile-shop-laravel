@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-th"></i>Manage Network Carriers</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-cogs"></i> Settings</li>
                            <li class="breadcrumb-item active">Phone Carrier List</li>
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
                                <button id="create-category" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-modal">Add Phone Carrier</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table-hover table-striped text-nowrap table-sm" id="phone-carrier-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Image</th>
                                        <th>Phone Carriers Title</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($carriers as $key=>$carrier)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ $carrier->image ? asset('uploads/phone-carriers/'.$carrier->image) : asset('uploads/phone-carriers/default_image.png')}}" alt="" style="width: 10rem;height: 5rem;">
                                            </td>
                                            <td class="text-capitalize">{{ $carrier->title }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-xs {{ $carrier->count > 0 ? 'd-none' : '' }}" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="action-btn">
                                                        <a class="dropdown-item font14px" data-link="{{ route("admin.settings.phone_carriers.update",["id" => $carrier->id]) }}"
                                                        data-toggle="modal" data-target="#edit-modal" data-name="{{ $carrier->title }}">
                                                            <i class="fa fa-pencil-alt fa-fw"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item font14px" href="javascript:void(0)"
                                                        onclick="deleteCarrier('{{ route('admin.settings.phone_carriers.delete',['id' => $carrier->id]) }}')">
                                                            <i class="fa fa-trash-alt fa-fw"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Data To Show</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- <div class="d-flex p-2 mt-2 align-items-center justify-content-between">
                                <div class="text-center">
                                    <p>Showing <span class="font-weight-bold">{{ $carriers->firstItem() }}</span> - <span class="font-weight-bold">{{ $carriers->lastItem() }}</span> of <span class="font-weight-bold">{{ $carriers->total() }}</span> items</p>
                                </div>
                                <div class="text-center">
                                    {{ $carriers->links() }}
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('admin.modals.settings.phone-carriers.create')
    @include('admin.modals.settings.phone-carriers.edit')
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-keytable/css/keyTable.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.min.css') }}">
    
@endsection

@section('page-js')
    @include('admin.modals.settings.categories.modal')
    <script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    {{-- <script src="{{ url('library/js/admin/settings/components.js') }}"></script> --}}
    <script src="{{ url('library/js/admin/phone-carrier/components.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#phone-carrier-table').DataTable({
                columnDefs: [
                    { orderable: false, targets: [1,3]}
                ],
                columns: [
                    null, null, { searchable: false }
                ]
            });
            // $('#phone-carrier-table').removeClass('d-none');
        });
    </script>
@endsection