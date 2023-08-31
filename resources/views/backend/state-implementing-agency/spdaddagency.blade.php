@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Add SPD's Agency</h1>
                        <hr style="color: #959595;">

                    </div>
                    <form action="{{URL::to(Auth::getDefaultDriver().'/Sub-Agency/Add')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Agency Name <span class="text-danger">*</span></label></div>
                                <div class=""><select name="agency_id" id="agency_id" class="form-control">
                                        <option value="">Select Agency</option>
                                        @foreach($agencyList as $agency)
                                        <option value="{{ $agency->id }}" @if($agency->id==($agencydetails->agency_id ??
                                            ''))
                                            selected @endif>{{ $agency->agency_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>SPD Name <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="text" name="agency_name" id="agency_name"
                                        class="form-control" placeholder="Enter SPD Name"
                                        value="{{$agencydetails->agency_name ?? ''}}"></div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Agency Address <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><textarea name="agency_address" id="agency_address" cols="30" rows="5"
                                        class="form-control">{{$agencydetails->agency_address ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>State <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><select class="form-control" id="txtState" name="state"
                                        onchange="getDistrictByState(this.value,'')">
                                        <option disabled selected>Select</option>
                                        @foreach($states as $state)
                                        <option value="{{$state->code }}" @if(isset($agencydetails->state) &&
                                            $state->code==$agencydetails->state) selected @endif>
                                            {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>District <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><select class="form-control" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'')">
                                        <option value="" selected>Select District</option>
                                    </select></div>
                            </div>

                            <div class="col-xl-12 col-lg-6 col-md-12 pb-3 pagetitle"><br>
                                <h1>Contact Person Details</h1>

                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Full Name <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="text" name="contact_person_name" id="contact_person_name"
                                        class="form-control" placeholder="Enter Contact Person Name"
                                        value="{{$agencydetails->contact_person_name ?? ''}}"></div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Email <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="email" name="contact_person_email" id="contact_person_email"
                                        class="form-control" placeholder="Enter Contact Email"
                                        value="{{$agencydetails->contact_person_email ?? ''}}"></div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Phone Number <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="text" minlength="10" maxlength="10"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        name="contact_person_number" id="contact_person_number" class="form-control"
                                        value="{{$agencydetails->contact_person_number ?? ''}}"></div>
                            </div>
                            <div class="col-xl-12">
                                <div class=" pt-4 text-center">
                                    <input type="hidden" name="editId" value="{{$agencydetails->id ?? ''}}">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save" />
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Sub-Agency')}}"
                                        class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </section>
    </main>
</section>
<!-- </section> -->
@endsection

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@if(($agencydetails->id ?? '') != null)

<script>
$(document).ready(function() {
    getDistrictByState('{{ $agencydetails->state }}', '{{ $agencydetails->district }}');
});
</script>
@endif
@endpush