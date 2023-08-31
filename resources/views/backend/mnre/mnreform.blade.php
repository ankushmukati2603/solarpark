@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>MNRE</h1>
            <nav>
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li> -->
                    <!-- <li class="breadcrumb-item active">Progress Report Data</li> -->
                </ol>
            </nav>
        </div>
        <!-- <section class="section dashboard"> -->
        <div class="container-fluid ">
            <div class="col-lg-12">
                <form action="{{URL::to(Auth::getDefaultDriver().'/mnre-form')}}" method="post" id=" ">
                    @csrf
                    <div class="row">
                        <div class="clearfix"></div><br>
                        <div class="col-md-4 col-sm-12">
                            <label>Name<span class="error">*</span></label>
                            <input type="text" placeholder="Name" name="name" id="name" class="form-control  number"
                                value="{{$generalData['general']['name'] ?? ''}}">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label>Email<span class="error">*</span></label>
                            <input type="email" name="email_id" id="" placeholder="Email" class="form-control  number"
                                value="{{$generalData['general']['email_id'] ?? ''}}">
                            <span class="text-danger">{{ $errors->first('email_id') }}</span>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-4">
                            <label for="name"><strong>Mobile Number</strong></label>
                            <div class="input-group mb-6">
                                <input placeholder="Mobile Number" minlength="10" maxlength="10" min="0"
                                    name="mobile_number" id="number" type="text" class="form-control"
                                    value="{{$developerdetails->mobile_number ?? ''}}">
                                <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12 mb-4">
                            <label>User Type<span class="error">*</span></label>
                            <select class="form-control" name="user_type" id="user_type">
                                <option value="">Select User Type</option>
                                <option value="1" @if(($generalData['general']['user_type'] ?? '' )=='1' ) selected
                                    @endif>Solar Park
                                </option>
                                <option value="2" @if(($generalData['general']['user_type'] ?? '' )=='2' ) selected
                                    @endif>Solar Power
                                </option>
                            </select>
                        </div>

                        <!-- <div class="clearfix"></div><br> -->
                        <div class="col-md-4 col-sm-12 mb-4">
                            <label>Designation Name<span class="error">*</span></label>
                            <input type="text" name="designation_name" placeholder="Designation Name"
                                id="designation_name" class="form-control "
                                value="{{$generalData['general']['designation_name'] ?? ''}}">
                            <span class="text-danger">{{ $errors->first('designation_name') }}</span>
                        </div>
                    </div>
                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                    <button type="submit" class="btn btn-success" id='submit' style="float:left">Submit
                        Now</button>
            </div>
        </div>
        </form>
        <!-- <div class="clearfix"></div><br> -->
        <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/developer-list')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Show List </a> -->
    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush