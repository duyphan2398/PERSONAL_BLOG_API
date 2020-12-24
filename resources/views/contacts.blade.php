@extends('layouts.layout')

@section('title')
    TNguyenOfficial
@endsection

@section('meta')
    <meta name="keywords"
          content="tnguyenofficial, tnguyen official, tnguyen, thomas nguyen, thomas, DEUTSCH CAMPUS, tnguyen040397, deutschcampus.com, deutschcampus, tiếng Đức, A1, C2, German">

    <meta property="og:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}"/>
    <meta property="og:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}"/>
    <meta property="og:description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}"/>
    <meta property="og:image:width" content="474">
    <meta property="og:image:height" content="220">
    <meta property="og:url" content="{{ request()->url() }}">

    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
    <meta name="image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">

    <meta name="twitter:text:title" content="{{ \Illuminate\Support\Arr::get($category, 'title') }}">
    <meta name="twitter:image" content="{{\Illuminate\Support\Arr::get($category, 'file')}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="article:publisher" content="tnguyenofficial">
    <meta name="description" content="{{ \Illuminate\Support\Arr::get($category, 'content') }}">
@endsection

@section('script')
    {{--Toastr--}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{--Validate--}}
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
      toastr.options = {
        'closeButton': true,
        'debug': false,
        'newestOnTop': false,
        'progressBar': true,
        'positionClass': 'toast-top-right',
        'preventDuplicates': false,
        'onclick': null,
        'showDuration': '300',
        'hideDuration': '1000',
        'timeOut': '5000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut',
      }
      let token = document.head.querySelector('meta[name="csrf-token"]')
    </script>
    <script src="{{ asset('js/controller/contact.js') }}"></script>
@endsection

@section('css')
    <style>
        .error {
            color: red;
            position: static !important;
            opacity: 1 !important;
        }

        .toast-top-right {
            margin-top: 0px;

        }

        .toast-success {
            background-color: #1c7430 !important;
            color: white !important;
        }

        .toast-error {
            background-color: red !important;
            color: white !important;
        }

        .toast-warning {
            background-color: #fdd52c !important;
            color: black !important;
        }
    </style>
@endsection

@section('body')
    <!-- Page Header -->
    <header id="header" class="masthead"
            style="background-image: url('{{ \Illuminate\Support\Arr::get($category, 'file') }}')">
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
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon
                    as possible!</p>
                <form name="sentMessage" id="contactForm">
                    @csrf
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Name</label>
                            <input name="name" aria-required="true" type="text" class="form-control" placeholder="Name" id="name"
                                   required data-validation-required-message="Please enter your name.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Email Address</label>
                            <input name="email" aria-required="true" type="email" class="form-control" placeholder="Email Address"
                                   id="email" required
                                   data-validation-required-message="Please enter your email address.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label>Phone Number</label>
                            <input name="phone_number" aria-required="true" type="tel" class="form-control" placeholder="Phone Number"
                                   id="phone_number" required
                                   data-validation-required-message="Please enter your phone number.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label>Message</label>
                            <textarea name="message" aria-required="true" rows="5" class="form-control" placeholder="Message"
                                      id="message" required
                                      data-validation-required-message="Please enter a message."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
                </form>
            </div>
        </div>
    </div>

    <hr>
@endsection