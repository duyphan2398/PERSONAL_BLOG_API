@extends('layouts.layout')

@section('title')
    ABC
@endsection

@section('script')
    <script src="{{ asset('js/controller/home.js') }}"></script>
@endsection

@section('meta')
    <meta name="keywords" content="tnguyenofficial, tnguyen official, tnguyen, thomas nguyen, thomas, DEUTSCH CAMPUS, tnguyen040397, deutschcampus.com, deutschcampus, tiếng Đức, A1, C2, German">

    <meta property="og:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}" />
    <meta property="og:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}" />
    <meta property="og:description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}" />
    <meta property="og:image:width" content="474">
    <meta property="og:image:height" content="220">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:sitename" content="{{ request()->url() }}" data-vmid="og:sitename" data-vue-meta="true">

    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
    <meta name="image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">

    <meta name="twitter:text:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}">
    <meta name="twitter:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="article:publisher" content="tnnguyenofficial">
    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
@endsection

@section('css')

@endsection

@section('body')
    <!-- Page Header -->
    <header id="header" class="masthead" style="background-image: url('{{ \Illuminate\Support\Arr::get($category, 'file') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col align-content-center">
                    <div class="site-heading" style="overflow-wrap: break-word">
                        <h1>{{ \Illuminate\Support\Arr::get($category, 'title') }}</h1>
                        <span class="subheading">{{ \Illuminate\Support\Arr::get($category, 'content') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <hr>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div id="post-list" class=" col-11 mx-auto">
                {{--LOAD POST --}}

                {{--LOAD POST --}}
            </div>
            <div class="w-100 col-11" style="text-align: center;">
                <div id="more" style="display: none">
                    <img src="{{ asset('images/loading.gif') }}" alt="loading..." alt="">
                </div>
            </div>

        </div>
    </div>
    <hr>
@endsection