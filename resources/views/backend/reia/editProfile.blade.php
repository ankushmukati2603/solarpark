@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard form_sctn">

    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Edit Profile </h1>
                        <hr style="color: #959595;">
                        <form action="{{URL::to(Auth::getDefaultDriver().'/edit-profile')}}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 col-sm-12 pb-3">

                                    <label for="email">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Your Name" value="{{$user->name ?? ''}}">
                                </div>
                                <div class="col-md-6 col-sm-12 pb-3">

                                    <label for="email">Email ID </label>
                                    <input type="text" class="form-control" readonly="" value="{{$user->email ?? ''}}">
                                </div>
                                <div class="col-md-6 col-sm-12 pb-3">

                                    <label for="email">Contact Person <span class="text-danger">*</span> </label>
                                    <input type="text" name="contact_person" id="contact_person" class="form-control"
                                        placeholder="Enter Contact Person" value="{{$user->contact_person ?? ''}}">
                                </div>
                                <div class="col-md-6 col-sm-12 pb-3">

                                    <label for="email">CState <span class="text-danger">*</span> </label>
                                    <select class="form-control" id="txtState" name="state"
                                        onchange="getDistrictByState(this.value, '')">
                                        <option disabled selected>Select</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code }}" @if(isset($user->state_id)
                                            && $state->code==$user->state_id)selected @endif> {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 pb-3">

                                    <label for="email">Contact Number <span class="text-danger">*</span> </label>
                                    <input type="text" name="phone" id="phone" minlength="10" maxlength="10"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        class="form-control" placeholder="Enter Contact Number"
                                        value="{{$user->phone ?? ''}}">
                                </div>
                                <div class="col-md-12 col-sm-12 pb-3">

                                    <label for="email">Address <span class="text-danger">*</span> </label>
                                    <textarea name="address" id="address" placeholder="Enter Address" cols="30"
                                        rows="10" class="form-control">{{$user->address ?? ''}}</textarea>

                                </div>
                                <div class="col-xl-12">
                                    <p>If you want to change your password <a
                                            href="{{URL::to('/'.Auth::getDefaultDriver().'/change-password')}}"
                                            class="text-primary">Click
                                            Here</a>
                                    </p>
                                    <div class=" pt-4 text-center">

                                        <input type="submit" name="submit" class="btn btn-success" value="Save" />
                                        <input type="reset" class="btn btn-danger" value="Cancel" />
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>

<!-- </section> -->
@endsection

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush