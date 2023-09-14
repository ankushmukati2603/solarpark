@extends('layouts.masters.backend')
@section('title', 'Dashboard')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Dashboard</a>
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
                                        <div class="number_stng "><span>{{$data['total_tenders']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Total Tenders</h6>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders')}}"
                                            target="_blank"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
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
                                        <div class="number_stng "><span>{{$data['tender_cancelled']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Tender Cancelled</h6>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/TenderCancelled')}}"><span
                                                class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt3">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card3">
                                        <div class="number_stng "><span>{{$data['reverse_auction']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Reverse Auction</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt4">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card4">
                                        <div class="number_stng "><span>{{$data['bidders']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Bidders</h6>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Bidder')}}"
                                            target="_blank"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt5">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card5">
                                        <div class="number_stng "><span>{{$data['ppapsa']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>PPA/PSA Signed</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt6">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card6">
                                        <div class="number_stng "><span>{{$data['loaloi']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>LOA/LOI</h6>
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
                                        <div class="number_stng "><span>{{$data['tender_commissioned']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Tender Commissioned</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">

                            <div class="card-body grdnt8">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card8">
                                        <div class="number_stng "><span>{{$data['total_agency']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Agencies </h6>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency')}}"
                                            target="_blank"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt8">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card8">
                                        <div class="number_stng "><span>{{$data['total_underimplementation']}}</span>
                                        </div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Under Implementation </h6>
                                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency')}}"
                                            target="_blank"><span class="more_info small pt-2 ps-1">more info <i
                                                    class="fa-solid fa-angle-right"></i></span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6 col-12 dashbord_blocks hide">
                        <div class="card info-card sales-card">
                            <div class="card-body grdnt7">
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon card7">
                                        <div class="number_stng "><span>{{$data['total_implemented']}}</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Tender Implemented</h6>
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

















    @endsection