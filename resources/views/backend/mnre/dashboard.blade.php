@extends('layouts.masters.backend')
@section('content')
@section('title', 'Dashboard')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard dashboard3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt1">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card1 ">
                                            <div class="number_stng ">
                                                <span>{{ $data['total_capacity_tendered']/1000 }} GW</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Total <br> capacity tendered</h6>
                                            <a href="{{URL::to(Auth::getDefaultDriver().'/capacity-tendered-list')}}"><span
                                                    class="more_info small pt-2 ps-1">more
                                                    info <i class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt2">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card2">
                                            <div class="number_stng ">
                                                <span>{{ $data['total_capacity_under_implementation'] }}</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Total capacity <br> under implementation</h6>
                                            <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt3">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card3">
                                            <div class="number_stng ">
                                                <span>{{ $data['total_capacity_commissioned'] }}</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Total <br> capacity commissioned</h6>
                                            <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt4">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card4">
                                            <div class="number_stng "><span>{{ $data['total_tenders'] }}</span></div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Total <br> Tenders</h6>
                                            <a href="{{URL::to(Auth::getDefaultDriver().'/capacity-tendered-list')}}"><span
                                                    class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt5">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card5">
                                            <div class="number_stng "><span>{{ $data['cancelled_tenders'] }}</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Cancelled <br> Tenders</h6>
                                            <a href="{{URL::to(Auth::getDefaultDriver().'/cancelled-tender-list')}}"><span
                                                    class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt6">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon   card6">
                                            <div class="number_stng ">
                                                <span>{{ $data['tenders_under_implementation'] }}</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Tenders <br> under Implementation</h6>
                                            <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                            <div class="card info-card sales-card">
                                <div class="card-body grdnt7">
                                    <div class="postn_reltv">
                                        <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                        <div class="card-icon card7">
                                            <div class="number_stng "><span>{{ $data['tenders_commissioned'] }}</span>
                                            </div>
                                        </div>
                                        <div class=" pb-3">
                                            <h6>Tenders <br> commissioned</h6>
                                            <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                        class="fa-solid fa-angle-right"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt1">
                                <div class="text-center">
                                    <div class="card-icon  d-flex align-items-center justify-content-center card1 ">
                                        <div class="number_stng "><span>0</span></div>

                                    </div>
                                    <div class="">
                                        <h6>Total Target</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt2">
                                <div class="text-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center card2">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class="">
                                        <h6>Total achived</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">

                            <div class="card-body grdnt3">
                                <div class="text-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center card3">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class="">
                                        <h6>Application <br> Received</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt7">
                                <div class="text-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center card7">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class="">
                                        <h6>Verified</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt8">
                                <div class="text-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center card8">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class="">
                                        <h6>Partial Verified</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt4">
                                <div class="text-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center card8">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class="">
                                        <h6>Rejected</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </main>
</section>
@endsection