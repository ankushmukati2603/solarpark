<!DOCTYPE html>
<html>
@include('layouts.partials.backend._head')

<body class="hold-transition skin-black-light sidebar-mini" onload="startTime()">
    <div class="wrapper">
        <div id="loader" class="overlay">
            <div class="overlay__inner">
                <div class="overlay__content">
                    <span class="spinner"></span>
                    <div class="clearfix mb-15"></div>
                    <span class="colorWhite">Processing, Please wait</span>
                </div>
            </div>
        </div>
        @include('layouts.partials.backend._header')
        @include('layouts.partials.backend._sidebar')
        <main id="main" class="main">
            @include('layouts.partials.backend._flash')
            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"> @yield('title')</a></li>
                        <!-- <li class="breadcrumb-item active"> @yield('button')</li> -->
                    </ol>
                </nav>
            </div>
            <!-- <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    @yield('title')
                    @yield('button')
                </h1>
            </section> -->
            @yield('content')
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom footer_nav">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="copyright-content d-flex align-items-center justify-content-center">
                        <img class="footer_nic_logo" src="{{URL::asset('public/assets/img/iconic_logo_v2.png')}}">
                        <div> Portal Content Managed by <strong> <a
                                    title="GoI, External Link that opens in a new window"
                                    href="https://mnre.gov.in"><strong>Ministry of New and Renewable
                                        Energy</strong></a></strong>
                            <br><span>Designed, Developed and Hosted by <a
                                    title="NIC, External Link that opens in a new window"
                                    href="https://www.nic.in"><strong class="highlight_text_blue">National Informatics
                                        Centre (NIC)</strong></a></span>
                        </div>



                    </div>
                </div>
            </nav>
        </main>
        @include('layouts.partials.backend._scripts')
        <div id="loading-bg-ajax" class="loading-bg-ajax hide">
            <div class="ajax-loader">
                <img src="{{ url('/public/images/loader.gif') }}" class="img-responsive" style="width:35%" />
            </div>
        </div>
        <style>
        .loading-bg-ajax {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            z-index: 99999;
            background-color: #000000;
            opacity: .5;
        }

        .ajax-loader {
            position: absolute;
            z-index: 9999999999;
            top: 30%;
            left: 52%;
        }

        .hide {
            display: none;
        }
        </style>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="fa-solid fa-arrow-up"></i></a>



        <script src="{{asset('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



        <script src="{{asset('public/assets/js/main.js')}}"></script>

</body>

</html>