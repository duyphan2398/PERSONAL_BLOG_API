@extends('layouts.layout')

@section('title')
    ABC
@endsection

@section('meta')
    https://www.api.tnguyenofficial.com/post/9gN-Qui+iste+magnam+aut+doloremque+dolorum.+Itaque+quia+nulla+blanditiis+autem+deleniti?fbclid=IwAR3A_EyJqZFAHi_xNiP67BlGFsvvQQkPbjXXba4V1jV8peZQQ-3_YZSejO4
    https://www.api.tnguyenofficial.com/post/9gN-Qui+iste+magnam+aut+doloremque+dolorum.+Itaque+quia+nulla+blanditiis+autem+deleniti.
    <pre>{{ \Illuminate\Support\Arr::get($post, 'file') }}</pre>
    <meta property="og:image:secure_url" content="{{ \Illuminate\Support\Arr::get($post, 'file') }}" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="{{ \Illuminate\Support\Arr::get($post, 'short_title') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ \Illuminate\Support\Arr::get($post, 'short_title') }}" />
    <meta property="og:article:published_time" content="{{ \Illuminate\Support\Arr::get($post, 'updated_at') }}" />
    <meta property="og:article:section" content="{{ \Illuminate\Support\Arr::get($post, 'short_content') }}" />
    <meta property="og:url" content="{{config('url.blog_url')}}/post/{{ \Illuminate\Support\Arr::get($post, 'slug') }}" />
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