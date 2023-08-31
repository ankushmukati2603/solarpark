@extends('layouts.masters.home')
@section('content')
<section class="register_page bg_fade">

    <div class="container-fluid px-5">
        <div class="row pb-5 pt-5">
            <div class="col-xxl-3"></div>
            <div class="col-xxl-6 pt-5 ">
                <div class="row   register_form">

                    <div class="col-xl-5 left_blk">
                        <div><a href="{{url('sandes')}}"><img src="{{ URL::asset('public/images/sandes_app_img.png')}}"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-xl-7 right_blk">
                        <div class="col-xxl-12 section-tittle">
                            <div class="register_hdng_text">Reset Password</div>
                        </div>
                          @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
                        <form method="POST" action="{{URL::to('reset-user-password')}}">
            @csrf
            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <label for="name"><strong> User Type <span class="text-danger">*</span></strong></label>
                <select name="user_type" class="form-control required" id="user_type" required>
                    <option selected="" disabled="">Select Type</option>
                    <option value="STATEIMPLEMENTINGAGENCY" selected="">State Implementing Agency ( SIA )</option>
                   <option value="SECI">Solar Energy Corporation of India Limited ( SECI )</option>
                   
                </select>
            </div>
            <div class="form-group has-feedback col-sm-12 pr-0 pl-0">
                <label for="name"><strong> Email Id <span class="text-danger">*</span></strong></label>
                
                <input type="email" id="email" class="form-control " placeholder="Email Id" name="email" 
                       autocomplete="off" autofocus="" value="{{old('email')}}" required>
            </div>
              @if(count($errors))
             <div class="form-group">
                                  
                                    <div class="alert alert-danger alert-validations text-center">
                                        @foreach ($errors->all() as $error)
                                        <span class="fs12">{{ $error }}</span><br>
                                        @endforeach
                                    </div>
                                  
                                </div>
                @endif
            <div class="clearfix"></div>
            <div class="text-center"> <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg">
                submit
            </button></div>
        </form>
                    </div>
                </div>

            </div>
            <div class="col-xxl-2"></div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
@endsection
@section('styles')
<style>
label.error {
    bottom: initial;
    right: 0px;
    top: 35px;
}
</style>
@endsection