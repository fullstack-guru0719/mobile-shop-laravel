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
              <div class="tronics">
                <div class="tronics-wrap">
                  {!! $result->content !!}
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 1, 'paragraph')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'header')
              <div class="tronics">
                <div class="tronics-wrap">
                  <h2>{{ $result->header }}</h2>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 1, 'header')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'image')
              <div class="tronics">
                <div class="tronics-wrap">
                  <div class="{{ $result->class }}">
                    <img src="{{ url($result->image) }}" class="img-fluid" />
                  </div>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 1, 'image')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'video')
              <div class="tronics">
                <div class="tronics-wrap">
                  <div class="embed-responsive {{ $result->ratio }}">
                    <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                  </div>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 1, 'video')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'link')
              <div class="tronics">
                <div class="tronics-wrap">
                  <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 1, 'link')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
          @endif
        @endforeach
      @endif
    @endforeach
  @endif
  <div class="text-center card-footer clearfix">
    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="addcontent(<?php echo $row->column[0]['id']; ?>, 1)">Add Content</a>
  </div>
</div>
<div class="col-lg-6">
  @if(!empty($row->column))
    @foreach($row->column as $column)
      @if(!empty($column->content))
        @foreach($column->content as $content)
          @if($content->column == 2)
            <?php
              $result = json_decode($content->content_value);
            ?>
            @if($content->content_type == 'paragraph')
              <div class="tronics">
                <div class="tronics-wrap">
                  {!! $result->content !!}
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 2, 'paragraph')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'header')
              <div class="tronics">
                <div class="tronics-wrap">
                  <h2>{{ $result->header }}</h2>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 2, 'header')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'image')
              <div class="tronics">
                <div class="tronics-wrap">
                  <div class="{{ $result->class }}">
                    <img src="{{ url($result->image) }}" class="img-fluid" />
                  </div>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 2, 'image')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'video')
              <div class="tronics">
                <div class="tronics-wrap">
                  <div class="embed-responsive {{ $result->ratio }}">
                    <iframe class="embed-responsive-item" src="{{ $result->youtube_url }}" allowfullscreen></iframe>
                  </div>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 2, 'video')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
            @if($content->content_type == 'link')
              <div class="tronics">
                <div class="tronics-wrap">
                  <a href="{{ $result->link_url }}" class="btn btn-warning btn-md" target="{{ $result->link_target }}">{{ $result->link_value }}</a>
                  <div class="tronics-links">
                    <a href="javascript:void(0)" onclick="editContent(<?php echo $column->id; ?>,<?php echo $content->id; ?>, 2, 'link')" class="btn btn-success btn-sm"><i class="far fa-edit fa-fw"></i> Edit</a>
                  </div>
                </div>
              </div>
            @endif
          @endif
        @endforeach
      @endif
    @endforeach
  @endif
  <div class="text-center card-footer clearfix">
    <a href="javascript:void(0);" class="btn btn-sm btn-primary" onclick="addcontent(<?php echo $row->column[1]['id']; ?>, 2)">Add Content</a>
  </div>
</div>