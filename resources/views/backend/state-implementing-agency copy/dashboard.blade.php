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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Consumer <br> Interests Received</h6>
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
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card2">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>System <br> Installations done</h6>
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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Inspections <br> Completed</h6>
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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Systems/Projects <br> Approved</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Inspections <br> Completed</h6>
                                        <a href="#"><span class="more_info small pt-2 ps-1">more info <i
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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Systems/Projects <br> Approved</h6>
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
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Inspections <br> Completed</h6>
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
                                <div class="postn_reltv">
                                    <img src="{{ URL::asset('public/images/circle.svg')}}" class="circle_img">
                                    <div class="card-icon   card8">
                                        <div class="number_stng "><span>0</span></div>
                                    </div>
                                    <div class=" pb-3">
                                        <h6>Systems/Projects <br> Approved</h6>
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
















    <!-- Small boxes (Stat box) -->
    <!-- <div class="row">
    <div class="col-lg-3 col-xs-6"> -->
    <!-- small box -->
    <!-- <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['consumer_interests']}}</h3>

                <p>Consumer Interests Received</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('state-implementing-agency/consumer-list')}}" class="small-box-footer small-box-primary">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div> -->
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-xs-6"> -->
    <!-- small box -->
    <!-- <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['systems_installed']}}</h3>

                <p>System Installations done</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('state-implementing-agency/systems')}}" class="small-box-footer small-box-success">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div> -->
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-xs-6"> -->
    <!-- small box -->
    <!-- <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['inspections_completed']}}</h3>

                <p>Inspections Completed</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('state-implementing-agency/systems')}}" class="small-box-footer small-box-warning">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div> -->
    <!-- ./col -->
    <!-- <div class="col-lg-3 col-xs-6"> -->
    <!-- small box -->
    <!-- <div class="small-box bg-white">
            <div class="inner">
                <h3>{{$data['systems_approved']}}</h3>

                <p>Systems/Projects Approved</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('state-implementing-agency/systems')}}" class="small-box-footer small-box-danger">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div> -->
    <!-- ./col -->
    <!-- </div> -->
    <!-- /.row -->
    @endsection