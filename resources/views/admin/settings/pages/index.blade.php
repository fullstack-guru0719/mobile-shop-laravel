@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Pages</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">Manage Pages</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <a href="javascript:void(0);" id="create-page" class="btn btn-primary btn-sm">Create Page</a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover text-nowrap table-sm">
          <thead>
            <tr>
              <th style="width: 3%;">#</th>
              <th style="width: 80%;">Title</th>
              <th style="width: 15%;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pages as $key => $page)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $page->title }}</td>
              <td>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                  </button>
                  <div class="dropdown-menu" aria-labelledby="action-btn">
                    <a class="dropdown-item" href="{{ url('admin/settings/pages', $page->id) }}">Manage Page</a>
                    @if(!in_array($page->id, [1,2,3,4]))
                    <a class="dropdown-item" href="javascript:void(0);" onclick="editpage(<?php echo $page->id; ?>)">Edit Page</a>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="deletepage(<?php echo $page->id; ?>)">Delete Page</a>
                    @endif
                  </div>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">No Available Data</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection

@section('page-js')
@include('admin.modals.pages.page')
<script src="{{ url('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\PageRequest') !!}
<script>
$(document).ready(function () {
  $('#create-page').click(function (){
    $('#page-title').val('');
    $('#page_id').val('');
    $('#modal-page').modal();
  });

  $('.colorpicker').colorpicker()
  $('.colorpicker').on('colorpickerChange', function(event) {
    $('.colorpicker .fa-square').css('color', event.color.toString());
  });
});

function editpage(id){
  $.ajax({
    type: "GET",
    url: "{{ url('admin/settings/pages') }}/"+id+"/edit",
    dataType: "json",
    success: function (response) {
      $('#page-title').val(response.page.title);
      $('#page_id').val(response.page.id);
      $('#modal-page').modal();
    }
  });
}
</script>
@endsection