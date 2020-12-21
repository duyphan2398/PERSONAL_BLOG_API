@extends('layouts.layout')

@section('title')
    ABC
@endsection

@section('script')
    <script>
      $(document).ready(function () {
      })
    </script>
@endsection

@section('css')

@endsection

@section('body')
    <!-- Page Header -->
    <header id="header" class="masthead" style="background-image: url('/images/background_login.jpg') ">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col align-content-center">
                    <div class="site-heading" style="overflow-wrap: break-word">
                        <h1>TITLE HERE</h1>
                        <span class="subheading">CONTENT LOGAN WILL HERE</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="post-list col-11 mx-auto">
            {{--LOAD POST --}}
                <div class="post-preview" style="overflow-wrap: break-word">
                    <div class="row" style="max-height: 70vm">
                        <div class="col-lg-4 col-12 order-lg-2 mb-lg-0 mb-2">
                            <img class="post-thumbnail" style="border-radius:4px; width: 100%; height: 100vm;  object-fit: cover " src="{{ asset('images/background_login.jpg') }}" alt="">
                        </div>

                        <div class="col-lg-8 col-12 order-lg-1">
                            <a class="post-content" href="#">
                                <h2 class="post-title">
                                    Hoa hậu Việt Nam 2020 Đỗ Thị Hà cùng siêu mẫu Thanh Hằng trong thiết kế tái chế
                                </h2>
                            </a>
                            <p class="post-subtitle">
                                CONTENT Problems look mighty small from 150 miles upProblems look mighty small from
                            </p>
                            <p class="post-meta">Posted by
                                 September 24, 2019</p>
                        </div>
                    </div>
                </div>
                <hr>
            {{--LOAD POST --}}

            </div>

            <div  id="more" class="col-lg-8 col-md-10 mx-auto">
                <div class="clearfix">
                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <hr>
@endsection