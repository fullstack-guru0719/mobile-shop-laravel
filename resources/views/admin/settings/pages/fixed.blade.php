@extends('layouts.app')
@section('content')
<?php
  $result = @json_decode($page->content);
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $pval->title }} Page</h1>
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
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            @if($page_id == 1)
              @include('admin.settings.pages.staticpages.home')
            @endif
            @if($page_id == 2)
              @include('admin.settings.pages.staticpages.aboutus')
            @endif
            @if($page_id == 4)
              @include('admin.settings.pages.staticpages.contactus')
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('page-css')
<style>
.textarea {
  width: 100%;
  resize: none;
  height: 200px !important;
  margin-top: 10px;
}
</style>
@endsection

@section('page-js')
<script>
function removeImage(image, id){
  if(confirm('Are you sure you want to delete this?')){
    $.ajax({
      type: "POST",
      url: "{{ url('admin/settings/pages/storestatic') }}",
      data: {
        type: 'image', image: image
      },
      dataType: "json",
      success: function (response) {
        $('#div-image-'+id).html('<input type="file" name="bgimage\"'+id+'\"" class="form-control-file">');
      }
    });
  }
}
</script>
@endsection