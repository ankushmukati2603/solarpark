@extends('layouts.masters.backend')
@section('content')
@section('title', 'Edit Profile')
<main id="main" class="main">
    <section class="section dashboard form_sctn">
        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Edit Profile</h1>
                    <hr style="color: #959595;">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/edit-profile')}}" method="POST">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 col-sm-12 pb-3">

                                <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                            </div>

                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="name">SNA Name <span class="error">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="email">Contact Person Name <span class="error">*</span></label>
                                <input type="text" class="form-control" name="contact_person"
                                    value="{{$user->contact_person}}">
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label for="contact_no">Contact Person Number <span class="error">*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{$user->phone}}">

                            </div>

                            <div class="col-md-126 col-sm-12 pb-3">
                                <label for="email">Address <span class="error">*</span></label>
                                <textarea name="address" id="address" cols="30" rows="5"
                                    class="form-control">{{$user->address}}</textarea>
                            </div>

                            <div class="col-md-6 col-sm-12 pb-3">
                                <label>State<span class="error"> * </span></label>
                                <select class="form-control  select21" id="txtState" name="state"
                                    onchange="getDistrictByState(this.value,'')">
                                    <option disabled selected>Select</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->code }}" @if($user->state_id==$state->code) selected
                                        @endif>
                                        {{$state->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 pb-3">
                                <label>District<span class="error"> * </span></label>
                                <select class="form-control " id="district_id" name="district_id"
                                    onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                    <option value="" selected>Select District</option>
                                </select>
                            </div>


                        </div>

                        <input type="submit" id="submit" class="mt-1 btn btn-primary" value="Submit">

                        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}"
                            class="text-primary">Click here change
                            password..!!</a>

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
.error {
    color: red
}
</style>
@endsection
@push('backend-js')

@if($user->state_id > 0)

<script>
$(document).ready(function() {
    //alert('hi');
    getDistrictByState('{{$user->state_id}}', '{{$user->district_id}}');
    getSubDistrictByDistrict('{{ $user->district_id }}',
        '{{$user->sub_district_id }}');

    // // block table k  column ka name
    getVillageBySubDistrict('{{$user->sub_district_id }}',
        '{{ $user->village }}');

});
</script>
@endif

<script>
// $(function() {
//     $('#editProfileForm').validate();
// });
// 
</script>
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush