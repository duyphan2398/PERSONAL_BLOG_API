@extends('layouts.layout')

@section('title')
    ABC
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