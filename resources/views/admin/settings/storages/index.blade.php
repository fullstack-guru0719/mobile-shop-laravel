@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2><i class="nav-icon fas fa-th"></i>Manage Phone Storages</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="{{ (isset($is_dark_mode) && $is_dark_mode == true ) ? 'fontWhite' : 'fontGray1' }}"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li class="breadcrumb-item"><i class="nav-icon fas fa-cogs"></i> Settings</li>
                            <li class="breadcrumb-item active">Phone Storage List</li>
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
                                <button id="create-category" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-modal">Add Phone Storage</button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table-hover table-striped text-nowrap table-sm" id="phone-storage-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Capacity</th>
                                        <th>Label</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($phone_storages as $key=>$storage)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $storage->capacity }}</td>
                                            <td class="text-capitalize">{{ $storage->label }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle btn-xs {{ $storage->count > 0 ? 'd-none' : '' }}" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="action-btn">
                                                        <a class="dropdown-item font14px" data-link="{{ route("admin.settings.phone_storages.update",["id" => $storage->id]) }}"
                                                        data-toggle="modal" data-target="#edit-modal" data-label="{{ $storage->label }}" data-capacity="{{ $storage->capacity }}">
                                                            <i class="fa fa-pencil-alt fa-fw"></i>Edit
                                                        </a>
                                                        <a class="dropdown-item font14px" href="javascript:void(0)"
                                                        onclick="deletePhoneStorage('{{ route('admin.settings.phone_storages.delete',['id' => $storage->id]) }}')">
                                                            <i class="fa fa-trash-alt fa-fw"></i>Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
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

    @include('admin.modals.settings.phone-storage.create')
    @include('admin.modals.settings.phone-storage.edit')
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
    {{-- <script src="{{ url('library/js/admin/phone-carrier/components.js') }}"></script> --}}
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/DataTables-1.10.12/extensions/Pagination/input.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
            const storage_table = $('#phone-storage-table').DataTable({
                columnDefs: [
                    { orderable: false, targets: [0,3]}
                ],
                columns: [
                    null, null, null, { searchable: false }
                ]
            });
        });

        var baseUrl = $('body').attr('data-url');

        // Submit Create Form
        $("#create-form").on('submit',function(e){
            e.preventDefault();
            let valid = true;

            
            const input_capacity = $("#create-phone-storage-capacity");
            const input_label    = $("#create-phone-storage-label");

            // Remove the invalid input of class
            input_capacity.removeClass('is-invalid');
            input_label.removeClass('is-invalid');

            if(input_capacity.val().trim() === ""){
                valid = false;
                input_capacity.addClass('is-invalid');
                $("#create-phone-storage-name-error").removeClass('d-none');
                $("#create-phone-storage-name-error").text('capacity is required');
            }else if(isNaN(input_capacity.val())){
                valid = false;
                input_capacity.addClass('is-invalid');
                $("#create-phone-storage-name-error").removeClass('d-none');
                $("#create-phone-storage-name-error").text('capacity should be a number');
            }

            if(input_label.val().trim() === ""){
                valid = false;
                input_label.addClass('is-invalid');
                $("#create-phone-storage-label-error").removeClass('d-none');
            }

            if(valid){
                $.ajax(`${baseUrl}/admin/settings/api/phone-storages/create`,{
                    method: "POST",
                    data: {
                        capacity: input_capacity.val(),
                        label: input_label.val(),
                    },
                    success: function(res){
                        if(res.status){
                            swal({
                                title: "Successfully Created!",
                                text: "Phone Storage Added",
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: "Something went wrong!",
                                text: res.error ?? "Please try again later",
                                icon: "error",
                            });
                        }
                    },
                    error: function(err){
                        swal({
                            title: "Something went wrong!",
                            text: "Pleast try again",
                            icon: "error",
                        });
                    }
                });
            }
        });

        //Edit Modal On Show

        let edit_label = $("#edit-phone-storage-capacity");
        let edit_capacity = $("#edit-phone-storage-labe");

        $("#edit-modal").on("show.bs.modal",function(e){
            const button = e.relatedTarget;
            const capacity = button.dataset.capacity;
            const label = button.dataset.label;
            const update_link = button.dataset.link;

            const modal = $(this);

            modal.find("#edit-phone-storage-label").val(label)
            modal.find("#edit-phone-storage-capacity").val(capacity)
            modal.find("#edit-form").attr('action',update_link);
        });

        // Submit Edit Form
        $("#edit-form").on('submit',function(e){
            e.preventDefault();
            let valid = true;

            
            const input_capacity = $("#edit-phone-storage-capacity");
            const input_label    = $("#edit-phone-storage-label");

            // Remove the invalid input of class
            input_capacity.removeClass('is-invalid');
            input_label.removeClass('is-invalid');

            if(input_capacity.val().trim() === ""){
                valid = false;
                input_capacity.addClass('is-invalid');
                $("#edit-phone-storage-name-error").removeClass('d-none');
                $("#edit-phone-storage-name-error").text('capacity is required');
            }else if(isNaN(input_capacity.val())){
                valid = false;
                input_capacity.addClass('is-invalid');
                $("#edit-phone-storage-name-error").removeClass('d-none');
                $("#edit-phone-storage-name-error").text('capacity should be a number');
            }

            if(input_label.val().trim() === ""){
                valid = false;
                input_label.addClass('is-invalid');
                $("#edit-phone-storage-label-error").removeClass('d-none');
            }

            if(valid){
                let update_link = $("#edit-form").attr('action');
                $.ajax(update_link,{
                    method: "PATCH",
                    data: {
                        capacity: input_capacity.val(),
                        label: input_label.val(),
                    },
                    success: function(res){
                        if(res.status){
                            swal({
                                title: "Successfully Updated!",
                                text: "Phone Storage Added",
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                title: "Something went wrong!",
                                text: res.error ?? "Please try again later",
                                icon: "error",
                            });
                        }
                    },
                    error: function(err){
                        swal({
                            title: "Something went wrong!",
                            text: "Pleast try again",
                            icon: "error",
                        });
                    }
                });
            }
        });

        // Delete user
        function deletePhoneStorage(carrier_delete_url){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                // buttons: true,
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax(`${carrier_delete_url}`,{
                        method: "DELETE",
                        success: function(res){
                            if(res.status){
                                swal({
                                    title:'Successfully Deleted!',
                                    text:'Phone Carrier Deleted',
                                    icon:'success',
                                }).then(() => {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 0);
                                });
                            } else {
                                swal(
                                    'Something went wrong!',
                                    `${res.message}`,
                                    'error',
                                );
                            }
                        },
                        error: function(err){
                            swal(
                                'Something went wrong!',
                                `${err.message}`,
                                'error',
                            );
                        }
                    });
                }
            });
        }
        // End Delete User
    </script>
@endsection