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
    <link rel="icon" href="#"/>
    <link rel="favicon" href="#">


    <meta name="keywords" content="TNGUYENOFFICIAL">
    <meta name="keywords" content="TNGUYEN">
    <meta name="keywords" content="tnguyen">
    <meta property="fb:pages" content="100002258842951" data-vmid="fb:pages">
    <meta property="og:sitename" content="tnguyenofficial">
    <meta name="author" content="tnguyenofficial">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="vi_VN">

    <meta name="copyright" content="TNGUYENOFFICIAL">
    <meta name="author" content="TNGUYENOFFICIAL">
    <meta name="GENERATOR" content="TNGUYENOFFICIAL">

    <link rel="shortlink" href="https://tnguyenofficial.com/">
    {{--SEO--}}
    @yield('meta')

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

    {{--WowJs--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

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
            height: 30vw;
            object-fit: fill;
        }

        .btn-loading {
            position: relative;
            color: transparent !important;
            text-shadow: none !important;
            pointer-events: none;
        }

        .btn-loading:after {
            content: '';
            display: inline-block;
            vertical-align: text-bottom;
            border: 1px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            color: #ffffff;
            position: absolute;
            width: 1rem;
            height: 1rem;
            left: calc(50% - .5rem);
            top: calc(50% - .5rem);
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
        }


        .more-loading {
            position: relative;
            color: transparent !important;
            text-shadow: none !important;
            pointer-events: none;
        }

        .more-loading:after {
            content: '';
            display: inline-block;
            vertical-align: text-bottom;
            border: 1px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            color: #000000;
            position: absolute;
            width: 1rem;
            height: 1rem;
            left: calc(50% - .5rem);
            top: calc(50% - .5rem);
            -webkit-animation: spinner-border .75s linear infinite;
            animation: spinner-border .75s linear infinite;
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
