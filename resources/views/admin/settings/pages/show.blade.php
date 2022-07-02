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
  <section class="content todo-list">
    <div class="row">
      <div class="col-md-12">
        <div class="float-right">
          <a class="btn btn-app" id="create-section">
            <i class="fab fa-buffer"></i> Add Section
          </a>
        </div>
      </div>
    </div>
    @foreach($sections as $key => $section)
    <div class="row" data-id="{{ $section->id }}">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <span class="handle ui-sortable-handle float-left">
              <i class="fas fa-ellipsis-v"></i>
              <i class="fas fa-ellipsis-v"></i>
            </span>
            <h3 class="card-title">Section {{ $key+1 }} ({{ $section->header }})</h3>
            <div class="card-tools">
              <a href="javascript:void(0)" class="btn btn-tool" onclick="createRow(<?php echo $section->id; ?>)" data-toggle="tooltip" title="Add Row">
                <i class="fas fa-plus"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-tool" onclick="editSection(<?php echo $section->id; ?>)" data-toggle="tooltip" title="Edit Section">
                <i class="fas fa-edit"></i>
              </a>
              <a href="javascript:void(0)" class="btn btn-tool" onclick="deleteSection(<?php echo $section->id; ?>)" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
          <div class="card-body">
            @if(!empty($section->row))
              @foreach($section->row as $rowcount => $row)
              <?php
                $rowc = $rowcount+1;
              ?>
              <div id="accordion">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4 class="card-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{ $section->id.$rowc }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-chevron-down fa-fw"></i> Row Item #{{ $rowcount+1 }}
                      </a>
                    </h4>
                  </div>
                  <div id="collapse_{{ $section->id.$rowc }}" class="panel-collapse in collapse">
                    <div class="card-body">
                      <div class="row">
                        @if($row->columns == 1)
                          @include('admin.settings.pages.columns.columnOne')
                        @endif
                        @if($row->columns == 2)
                          @include('admin.settings.pages.columns.columnTwo')
                        @endif
                        @if($row->columns == 3)
                          @include('admin.settings.pages.columns.columnThree')
                        @endif
                        @if($row->columns == 4)
                          @include('admin.settings.pages.columns.columnFour')
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </section>
</div>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/summernote/summernote-bs4.css') }}">
<style>
.tronics .tronics-wrap {
  transition: 0.3s;
  position: relative;
  overflow: hidden;
  z-index: 1;
}
.tronics .tronics-wrap::before {
  content: "";
  background: rgb(45 45 45 / 60%);
  position: absolute;
  left: 100%;
  right: 0;
  top: 0;
  bottom: 0;
  transition: all ease-in-out 0.3s;
  z-index: 2;
}
.tronics .tronics-wrap .tronics-links {
  opacity: 0;
  left: 0;
  right: 0;
  top: calc(50% - 36px);
  text-align: center;
  z-index: 3;
  position: absolute;
  transition: all ease-in-out 0.3s;
}
.tronics .tronics-wrap:hover::before {
  left: 0;
}
.tronics .tronics-wrap:hover .tronics-links {
  opacity: 1;
  top: calc(50% - 18px);
}
</style>
@endsection

@section('page-js')
@include('admin.modals.pages.managepage')
<script src="{{ url('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
$(document).ready(function () {
  $('.textarea').summernote({
    tabsize: 2,
    height: 220,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['fontname', ['fontname']],
      ['para', ['ul', 'ol', 'paragraph']],
    ]
  });
  $('#create-section').click(function() {
    $('#section-div-file').show();
    $('#section-bg-file').attr('type', 'file');
    $('#section-div-bgimage').hide();
    $('#section_id').val('');
    $('#back-btn').remove();
    $('#modal-section').modal();
  });
  $('#columns').change(function() {
    if($(this).val() == 2){
      $('#column-ratio').show();
    } else {
      $('#column-ratio').hide();
    }
  });

  $('#section-form').submit(function (e) { 
    e.preventDefault();
    var valid = true;
    if($('#section-header').val() == ''){
      $('#section-header').addClass('is-invalid');
      valid = false;
    }
    if(valid) this.submit();
  });
  $('#section-header').keyup(function() {
    if($(this).val()!='') $('#section-header').removeClass('is-invalid');
  });

  $('#row-form').submit(function (e) { 
    e.preventDefault();
    var valid = true;
    if($('#section_id').val() == ''){
      $('#section_id').addClass('is-invalid');
      valid = false;
    }
    if(valid) this.submit();
  });
  $('#section_id').change(function() {
    if($(this).val()!='') $('#section_id').removeClass('is-invalid');
  });

  $('#header-form').submit(function (e) { 
    e.preventDefault();
    var valid = true;
    if($('#header').val() == ''){
      $('#header').addClass('is-invalid');
      valid = false;
    }
    if(valid) this.submit();
  });
  $('#header').keyup(function() {
    if($(this).val()!='') $('#header').removeClass('is-invalid');
  });

  $('#youtube-form').submit(function (e) { 
    e.preventDefault();
    var valid = true;
    if($('#youtube_url').val() == ''){
      $('#youtube_url').addClass('is-invalid');
      valid = false;
    }
    if(valid) this.submit();
  });
  $('#youtube_url').keyup(function() {
    if($(this).val()!='') $('#youtube_url').removeClass('is-invalid');
  });

  $('#link-form').submit(function (e) { 
    e.preventDefault();
    var valid = true;
    if($('#link_value').val() == ''){
      $('#link_value').addClass('is-invalid');
      valid = false;
    }
    if($('#link_url').val() == ''){
      $('#link_url').addClass('is-invalid');
      valid = false;
    }
    if(valid) this.submit();
  });
  $('#link_value').keyup(function() {
    if($(this).val()!='') $('#link_value').removeClass('is-invalid');
  });
  $('#link_url').keyup(function() {
    if($(this).val()!='') $('#link_url').removeClass('is-invalid');
  });

  $('#remove-image').click(function() {
    var id = $('.content-id').val();
    if(confirm('Are you sure you want to delete this image?')){
      $.ajax({
        type: "GET",
        url: "{{ url('admin/settings/pages/image') }}/"+id,
        dataType: "json",
        success: function (response) {
          $('#image-file').hide();
          $('#input-file').show();
          $('#input-image').attr('type', 'file');
          $('#input-image').removeAttr('value');
        }
      });
    }
  });

  $('#section-remove-image').click(function() {
    if(confirm('Are you sure you want to delete this image?')){
      var section_id = $('#section_id').val();
      $.ajax({
        type: "GET",
        url: "{{ url('admin/settings/pages/sectionimage') }}/"+section_id,
        dataType: "json",
        success: function (response) {
          $('#section-div-file').show();
          $('#section-bg-file').attr('type', 'file');
          $('#section-div-bgimage').hide();
        }
      });
    }
  });
  
  $('.colorpicker').colorpicker()
  $('.colorpicker').on('colorpickerChange', function(event) {
    $('.colorpicker .fa-square').css('color', event.color.toString());
  });
  <?php if($chksection == 0){ ?>
    $('#section-close').hide();
    $('#modal-section').modal();
  <?php } ?>
  
  function updateToDB(idString){  
    $.ajax({
      url: "{{ url('admin/settings/pages/manage') }}",
      method: 'POST',
      data: {
        ids: idString,
        type: 'section_order'
      },
      success: function(){
        
      }
    });
  }

  var target = $('.todo-list');
  target.sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    axis: 'y',
    update: function (e, ui){
      var sortData = target.sortable('toArray',{ attribute: 'data-id'});
      console.log(sortData);
      updateToDB(sortData.join(','))
    }
  });
});

function createRow(id){
  $('#section_id').val(id);
  $('#modal-row').modal();
}

function addcontent(id, column){
  $('#div-paragraph').hide();
  $('#div-heading').hide();
  $('#div-image').hide();
  $('#div-video').hide();
  $('#div-link').hide();
  $('#image-file').hide();
  $('#input-file').show();
  $('.column-id').val(id);
  $('.content-id').val('');
  $('.column').val(column);
  $(".textarea").summernote("code", '');
  $('#modal-content').modal();
}

function content(type){
  $('#div-paragraph').hide();
  $('#div-heading').hide();
  $('#div-image').hide();
  $('#div-video').hide();
  $('#div-link').hide();
  if(type == 'paragraph'){
    $('#div-paragraph').show();
  }
  if(type == 'heading'){
    $('#div-heading').show();
  }
  if(type == 'image'){
    $('#div-image').show();
  }
  if(type == 'video'){
    $('#div-video').show();
  }
  if(type == 'link'){
    $('#div-link').show();
  }
}

function editContent(column_id, id, column, type){
  $('#div-paragraph').hide();
  $('#div-heading').hide();
  $('#div-image').hide();
  $('#div-video').hide();
  $('#div-link').hide();
  $('.column-id').val(column_id);
  $('.content-id').val(id);
  $('.column').val(column);
  $.ajax({
    type: "GET",
    url: "{{ url('admin/settings/pages/content') }}/"+id,
    dataType: "json",
    success: function (response) {
      $('#modal-content').modal();
      $(".textarea").summernote("code", response.content);
      $("#header").val(response.header);
      $('#alignment').val(response.align);
      $('#youtube_url').val(response.youtube_url);
      $('#vratio').val(response.ratio);
      $('#link_url').val(response.link_url);
      $('#link_value').val(response.link_value);
      if(response.link_target == '_blank'){
        $('#link_target').val('_blank');
      }
      if(response.image){
        $('#image-file').show();
        $('#input-file').hide();
        $('#image-val').val(response.baseimage);
        $('#input-image').attr('type', 'hidden');
        $('#input-image').attr('value', '1');
      }
      if(type == 'paragraph'){
        $('#div-paragraph').show();
      }
      if(type == 'header'){
        $('#div-heading').show();
      }
      if(type == 'image'){
        $('#div-image').show();
      }
      if(type == 'video'){
        $('#div-video').show();
      }
      if(type == 'link'){
        $('#div-link').show();
      }
    }
  });
}

function editSection(id){
  $.ajax({
    type: "GET",
    url: "{{ url('admin/settings/pages/section') }}/"+id,
    dataType: "json",
    success: function (response) {
      $('#section-header').val(response.section.header);
      $('#section-sub-header').val(response.section.sub_header);
      $('#section-header-color').val(response.section.header_color);
      $('#section-sub-header-color').val(response.section.sub_header_color);
      $('#section-bg-color').val(response.section.background_color);
      if(response.section.background_image){
        $('#section-div-file').hide();
        $('#section-bg-file').attr('type', 'hidden');
        $('#section-div-bgimage').show();
        $('#section-image-val').val(response.bg_image);
      }
      $('#sec_id').val(response.section.id);
      $('#back-btn').remove();
      $('#modal-section').modal();
    }
  });
}

function deleteSection(id){
  if(confirm('Are you sure you want to delete this section? It will delete all the rows and columns related to this section.')){
    $.ajax({
      type: "DELETE",
      url: "{{ url('admin/settings/pages/section') }}/"+id,
      dataType: "json",
      success: function (response) {
        location.reload();
      }
    });
  }
}
</script>
@endsection