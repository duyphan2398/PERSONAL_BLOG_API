<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <link rel="icon" href="{!! asset('images/logo.png') !!}"/>

    <!-- Bootstrap core CSS -->
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{!! asset('vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{!! asset('css/clean-blog.min.css') !!}" rel="stylesheet">

    {{--Axios--}}
    <script src='https://unpkg.com/axios/dist/axios.min.js'></script>

    <!-- Bootstrap core JavaScript -->
    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

    <!-- Custom scripts for this template -->
    <script src="{!! asset('js/clean-blog.min.js') !!}"></script>

    @yield('css')

    <style>
        .active a {
            font-weight: 100 !important;
        }
        .ql-video{
            width: 100%;
            height: 35vw;
        }
        .post-content img {
            width: 100%;
            height: 35vw;
            object-fit: fill;
        }
    </style>
</head>
<body>
    @include('layouts.partials.nav')
    @yield('body')
    @include('layouts.partials.footer')

    @yield('script')
</body>
</html>
