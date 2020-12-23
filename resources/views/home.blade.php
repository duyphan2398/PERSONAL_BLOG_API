@extends('layouts.layout')

@section('title')
    ABC
@endsection

@section('script')
    <script src="{{ asset('js/controller/home.js') }}"></script>
@endsection

@section('meta')
    <meta property="og:image:secure_url" content="{{\Illuminate\Support\Arr::get($category, 'file')}}" />
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