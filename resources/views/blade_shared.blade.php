@extends('layouts.layout')

@section('title')
    TNguyenOfficial
@endsection

@section('script')
    <script src="{{ asset('js/controller/script_shared.js') }}"></script>
@endsection

@section('meta')
    <meta property="og:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}" />
    <meta property="og:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}" />
    <meta property="og:description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}" />
    <meta property="og:image:width" content="474">
    <meta property="og:image:height" content="220">
    <meta property="og:url" content="{{ request()->url() }}" data-vmid="og:url" data-vue-meta="true">

    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
    <meta name="image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">

    <meta name="twitter:text:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}">
    <meta name="twitter:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="article:publisher" content="tnguyenofficial">
    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
@endsection

@section('css')

@endsection

@section('body')
    <!-- Page Header -->
    <header id="header" class="masthead" data-src="{{ \Illuminate\Support\Arr::get($category, 'file') }}"  style="background-image: url('{{ \Illuminate\Support\Arr::get($category, 'file') }}')">
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
        <div class="row mb-3">
            <div id="post-list" class=" wow col-11 mx-auto">
                {{--LOAD POST --}}

                {{--LOAD POST --}}
            </div>
        </div>
        <div class="row mb-3">
            <div class="w-100 col-12" style="text-align: center;">
                <div id="more" style="display: none">
                    <a class="more-loading" style="width: 10px; height: 10px"></a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <a href="javascript:void(0)" name="{{\Illuminate\Support\Arr::get($category, 'id')}}" id="categoryId"></a>
@endsection