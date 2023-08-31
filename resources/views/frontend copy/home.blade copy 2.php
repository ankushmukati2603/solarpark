@extends('layouts.masters.home')
@section('content')
<!-- <div id="home-container" class="container-fluid">
    <div id="home-msg" class="col-sm-8 col-sm-offset-2">
        <h2 class="fs38 title">Welcome to Biogas Application Portal</h2>
        <div class="mt-70"><a href="{{url('consumer-interest-form')}}" class="btn btn-default btn-interest">REGISTER
                YOUR INTEREST</a></div>
    </div>
</div> -->
<section class="login_bg_image almm_home_section1">
    <div class="container">
        <div class="row animatedParent">
            <div class="col-md-12 animated fadeInDownShort go">

                <h1>
                    Welcome <br> to <span style="font-weight:700;     color: #85ffb6;">Solar Park <br>Application
                        <br>Portal</span></h1>
                <!-- <a href="{{url('consumer-interest-form')}}" class="btn btn-success btn-lg">REGISTER YOUR INTREST</a> -->
                <!-- <button type="button" class="btn btn-success btn-lg">REGISTER YOUR INTREST</button> -->
            </div>
        </div>
    </div>

</section>
<!-- <section class="almm_home_section2 pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="padding: 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInLeftShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('public/assets/img/Efficiency_Power.png') }}" width="110px">
                            </div>
                            <div class="col-xxl-8">
                                <h2>NATURAL SOLUTIONS</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="padding: 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInDownShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('public/assets/img/trust_waranty.png') }}" width="110px"></div>
                            <div class="col-xxl-8">
                                <h2>ENVIRONMENT PROTECTION</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4" style="padding: 20px">
                <div class="row">
                    <div class="col-md-12 comn_blk animatedParent">
                        <div class="row animated fadeInRightShort go">
                            <div class="col-xxl-4 img-fluid text-center"><img
                                    src="{{ URL::asset('public/assets/img/high_quality.png') }}" width="110px"></div>
                            <div class="col-xxl-8">
                                <h2>SAVE YOUR MONEY</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</section> -->

<!-- <section class="homepage_section3 only_tstymnls">
    <div class="container common-container pt-sm-5 pb-sm-5 pt-0 pb-0">

        <div class="row pt-5 pb-5">

            <div class="col-md-12 testmonls pt-5 pb-5">
                <div class="col-md-12 text-center">
                    <div class="comn_heading ">
                        <i class="fa-solid fa-minus"></i> What users says
                    </div>
                    <h2 class="pt-3 ">What users Thoughts on Solar Park</h2>
                </div>

                Carousel
                <div id="demo_textmnl" class="carousel slide text-center" data-bs-ride="carousel">

                    Indicators/dots
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#demo_textmnl" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#demo_textmnl" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#demo_textmnl" data-bs-slide-to="2"></button>
                    </div>

                    The slideshow/carousel
                    <div class="carousel-inner">
                        <div class="carousel-item active pt-5 pb-5">

                            <div class="">
                                <p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's <br> standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled”</p>
                                <small>New Delhi <br><i>-Gaurav Sharma</i></small>
                            </div>
                        </div>
                        <div class="carousel-item pt-5 pb-5">

                            <div class="">
                                <p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's <br>standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled”</p>
                                <small>Noida <br><i>-Ekaaksh Sharma</i></small>
                            </div>
                        </div>
                        <div class="carousel-item pt-5 pb-5">

                            <div class="">
                                <p>“Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's <br>standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled”</p>
                                <small>Faridabad <br><i>-Pankaj Sharma</i></small>
                            </div>
                        </div>
                    </div>

                    Left and right controls/icons
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo_textmnl"
                        data-bs-slide="prev">
                        <i class="fa-solid fa-circle-chevron-left"></i>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo_textmnl"
                        data-bs-slide="next">
                        <i class="fa-solid fa-circle-chevron-right"></i>
                    </button>
                </div>


            </div>



        </div>

    </div>
</section> -->
<!-- <section class=" pt-5">
    <div class="container pt-3 pb-5">
        <div class="row animatedParent">
            <div class="col-md-12 text-center animated bounceIn go">
                <div class="comn_heading ">
                    <i class="fa-solid fa-minus"></i> How It All Started

                </div>
                <h2 class="pt-3 pb-5">IT`S ALL ABOUT BIO ENERGY</h2>
            </div>
        </div>
        <div class="row pt-3">

            <div class="col-md-12 img-fluid right_blk">
                <div class="row">
                    <section class="customer-logos slider">
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant1.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant2.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant3.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant4.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant5.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant6.jpg') }}"></div>
                        <div class="slide"><img src="{{ URL::asset('public/assets/img/plant7.jpg') }}"></div>

                    </section>


                </div>


            </div>

        </div>

    </div>

</section> -->
<!-- <section class="almm_home_section7">

    <marquee>This is basic example of marquee</marquee>

</section> -->
@endsection