@extends('layouts.layout')

@section('title')
    ABC
@endsection

@section('meta')
    <meta property="og:image" content="{{\Illuminate\Support\Arr::get($post, 'file')}}" />
    <meta property="og:title" content="{{ \Illuminate\Support\Arr::get($post, 'short_title') }}" />
    <meta property="og:description" content="{{ \Illuminate\Support\Arr::get($post, 'short_content') }}" />
    <meta property="og:image:width" content="474">
    <meta property="og:image:height" content="220">
    <meta property="og:image:alt" content="{{ \Illuminate\Support\Arr::get($post, 'short_title') }}" />
    <meta name="description" content="{{ \Illuminate\Support\Arr::get($post, 'short_content') }}">
    <meta name="image" content="{{\Illuminate\Support\Arr::get($post, 'file')}}">

    <meta property="og:url" content="{{config('url.blog_url')}}/post/{{ \Illuminate\Support\Arr::get($post, 'slug') }}" data-vmid="og:url" data-vue-meta="true">
    <meta property="og:sitename" content="tnguyenofficial.com" data-vmid="og:sitename" data-vue-meta="true">

    <meta name="twitter:text:title" content="{{ \Illuminate\Support\Arr::get($post, 'short_title') }}">
    <meta name="twitter:image" content="{{\Illuminate\Support\Arr::get($post, 'file')}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="article:publisher" content="tnnguyenofficial">
    <meta name="description" content="{{ \Illuminate\Support\Arr::get($post, 'short_content') }}">

@endsection

@section('script')
    <script src="{{ asset('js/controller/home.js') }}"></script>
@endsection

@section('css')

@endsection

@section('body')
    <!-- Page Header -->
    <header id="header" class="masthead" style="background-image: url('{{ \Illuminate\Support\Arr::get($post, 'file') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col align-content-center">
                    <div class="post-heading" style="overflow-wrap: break-word">
                        <h1>{{ \Illuminate\Support\Arr::get($post, 'short_title') }}</h1>
                        <h2 class="subheading">{{ \Illuminate\Support\Arr::get($post, 'short_content') }}</h2>
                        <span class="meta">Posted at {{ \Illuminate\Support\Arr::get($post, 'updated_at') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <hr>
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="post-content col-11 mx-auto" style="overflow-wrap: break-word">
                    {!! \Illuminate\Support\Arr::get($post, 'content') !!}
                </div>
            </div>
        </div>
    </article>
    <hr>
@endsection