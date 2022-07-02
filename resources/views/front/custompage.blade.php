@extends('layouts.front')
@section('content')
<div class="pt-70" style="<?php echo $customstyle; ?>">
  @foreach($sections as $key => $section)
  <section class="{{ $section->class_name }}">
    <div class="container pb-50">
      <div class="text-center hero-header pt-50">
        <h1 class="<?php echo $section->header_class; ?>">{{ $section->header }}</h1>
        <p class="ct-tronics <?php echo $section->sub_header_class; ?>">{{ $section->sub_header }}</p>
      </div>
      @if(!empty($section->row))
        @foreach($section->row as $row)
          @if($row->columns == 1)
            @if(!empty($row->column))
              @foreach($row->column as $column)
                @if(!empty($column->content))
                  @foreach($column->content as $content)
                  <?php
                    $result = json_decode($content->content_value);
                  ?>
                  @if($content->content_type == 'paragraph')
                    <div class="row">
                      <div class="col-lg-12" style="color: <?php echo $result->color; ?>">
                        {!! $result->content !!}
                      </div>
                    </div>
                  @endif
                  @if($content->content_type == 'header')
                    <div class="row">
                      <div class="col-lg-12 pb-50">
                        <div class="text-center hero-header pt-50">
                          <h1 class="text-black">{{ $result->header }}</h1>
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($content->content_type == 'image')
                    <div class="row">
                      <div class="col-lg-12 pb-50">
                        <div class="{{ $result->class }}">
                          <img src="{{ url($result->image) }}" class="img-fluid" />
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($content->content_type == 'video')
                    <div class="row">
                      <div class="col-lg-12 pb-50">
                        <div class="embed-responsive {{ $result->ratio }}">
                          <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                        </div>
                      </div>
                    </div>
                  @endif
                  @if($content->content_type == 'link')
                    <div class="row">
                      <div class="col-lg-12 pb-50">
                        <div>
                          <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                        </div>
                      </div>
                    </div>
                  @endif
                  @endforeach
                @endif
              @endforeach
            @endif
          @endif
          @if($row->columns == 2)
          <div class="row pt-50">
            <div class="col-lg-6">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 1)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-6 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 2)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
          </div>
          @endif
          @if($row->columns == 3)
          <div class="row pt-50">
            <div class="col-lg-4">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 1)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-4 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 2)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-4 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 3)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
          </div>
          @endif
          @if($row->columns == 4)
          <div class="row pt-50">
            <div class="col-lg-3">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 1)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-3 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 2)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-3 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 3)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
            <div class="col-lg-3 d-flex">
              @if(!empty($row->column))
                @foreach($row->column as $column)
                  @if(!empty($column->content))
                    @foreach($column->content as $content)
                      @if($content->column == 4)
                        <?php
                          $result = json_decode($content->content_value);
                        ?>
                        @if($content->content_type == 'paragraph')
                          <div class="align-self-center">
                            {!! $result->content !!}
                          </div>
                        @endif
                        @if($content->content_type == 'header')
                          <h2>{{ $result->header }}</h2>
                        @endif
                        @if($content->content_type == 'image')
                          <div class="{{ $result->class }}">
                            <img src="{{ url($result->image) }}" class="img-fluid" />
                          </div>
                        @endif
                        @if($content->content_type == 'video')
                          <div class="embed-responsive {{ $result->ratio }}">
                            <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                          </div>
                        @endif
                        @if($content->content_type == 'link')
                          <div>
                            <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                          </div>
                        @endif
                      @endif
                    @endforeach
                  @endif
                @endforeach
              @endif
            </div>
          </div>
          @endif
        @endforeach
      @endif
    </div>
  </section>
  @endforeach
</div>
@endsection

@section('page-css')
<link href="{{ url('css/pages', $page->slug_title) }}.css" rel="stylesheet">
<style>
.custom-subheader {
  color: #000;
  width: 100%;
  display: block;
  position: relative;
}
</style>
@endsection