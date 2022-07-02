@extends('layouts.front')
@section('content')
    <?php
    // $result = @json_decode($page->content);
    ?>
    <section class="pt-70">
        <div class="container mt-50" style="padding: 0 20px">
        
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $result = json_decode($page->html);
                        echo $page->html;
                        exit;
                    ?>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-8">
                    img src="{{ url($result->image1) }}" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <div class="content-wrapper">
                        <div class="about-head-wrapper">
                            <h3 class="feature-heading">{{ $result->header_2 }}</h3>
                        </div>
                        <p class="about-p">
                        {!! str_replace('TronicsPay', '<strong>TronicsPay</strong>', $result->text_2) !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row pt-70">
                <div class="col-md-4">
                    <img src="{{ url($result->image2) }}" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <img src="{{ url($result->image3) }}" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <div class="content-wrapper partners">
                        <h3 class="feature-heading">{{ $result->social->text }}</h3>
                    <div class="features-icons-wrapper">
                    <a href="{{ $result->social->facebook }}">
                        <img src="{{ url('assets/images/social/facebook.png') }}" width="60" alt="" class="features-icon" />
                    </a>
                    <a href="{{ $result->social->instagram }}">
                        <img src="{{ url('assets/images/social/instagram.png') }}" width="60" alt="" class="features-icon" />
                    </a>
                    <a href="{{ $result->social->twitter }}">
                        <img src="{{ url('assets/images/social/twitter.png') }}" width="60" alt="" class="features-icon" />
                    </a>
                    <a href="{{ $result->social->youtube }}">
                        <img src="{{ url('assets/images/social/youtube.png') }}" width="60" alt="" class="features-icon" />
                    </a>
                </div>
            </div>
        </div>  
        </div>
        </div> --> 
    </section>
@endsection

@section('page-css')
<link href="{{ url('assets/css/aboutus.css') }}" rel="stylesheet">
    <style>
        <?php
            $result1 = json_decode($page->css);
            echo $page->css;
        ?>
    </style>
@endsection