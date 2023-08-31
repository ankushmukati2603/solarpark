@extends('layouts.masters.home')
@section('content')
@section('title', 'Consumer Interest Form')

<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-3"></div>
            <div class="col-xxl-6 pt-5 ">
                <div class="row   register_form">

                    <div class="col-xl-5 left_blk">
                        <div><img src="{{ URL::asset('public/images/sandes_app_img.png')}}" class="img-fluid"></div>
                    </div>
                    <div class="col-xl-7 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">Login</div>
                        </div>
                        <form id="formLogin" action="{{ route('login') }}" method="POST" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="d-grid">
                                    <a href="{{URL::to('/log-in')}}" class="btn btn-success btn-lg">Developer
                                        Login</a>
                                </div>
                                <div class="d-grid mt-5">
                                    <a href="{{url('login')}}" class="btn btn-success btn-lg">Admin Login</a>
                                </div>
                                <div class="d-grid mt-5">
                                    <a href="{{url('login')}}" class="btn btn-success btn-lg">SNA Login</a>
                                </div>

                            </div>



                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection