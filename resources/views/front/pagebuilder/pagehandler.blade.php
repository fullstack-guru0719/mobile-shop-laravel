@extends('layouts.front')
@section('content')
    <section class="pt-70">
        <div class="container mt-50" style="padding: 0 20px">
            <div class="row">
                <div class="col-md-12">
                    {!! isset($page) ? $page->html : '' !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-css')
    <link href="{{ url('assets/css/aboutus.css') }}" rel="stylesheet">
    <style>
        {!! isset($page) ? $page->css : '' !!}
    </style>
@endsection