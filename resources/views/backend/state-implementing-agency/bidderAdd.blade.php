@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard form_sctn">

    <main id="main" class="main">


        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <div class="row ">
                <div class="pagetitle col-xl-12">
                    <h1>Add Bidder's Details</h1>
                    <hr style="color: #959595;">

                </div>
                <form action="{{URL::to(Auth::getDefaultDriver().'/Bidder/Add')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>Select Agency <span class="text-danger">*</span></label></div>
                            <div class=""><select name="agency_id" id="agency_id" class="form-control"
                                    onchange="getSPDListByAgency()">
                                    <option value="">Select Agency</option>
                                    @foreach($agencyList as $agency)
                                    <option value="{{$agency->id }}" @if(isset($bidderdetails->agency_id )
                                        && $agency->
                                        id==$bidderdetails->agency_id)selected
                                        @endif>
                                        {{$agency->agency_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <a href="{{URL::to(Auth::getDefaultDriver().'/Agency/Add')}}"
                                    class="text-primary text-small" style="float:right;font-size:10px">Agency not
                                    Found?
                                    Click her to Add
                                    Agency?</a>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                            <div class=""><label id="spd_header">Select SPD <span class="text-danger">*</span></label>
                            </div>
                            <div id="spd_data"><select name="agency_sub_id" id="agency_sub_id" class="form-control">
                                    <option value="">Select Agency First</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-12 pb-3 pagetitle"><br>
                            <h1>Bidder Details</h1>

                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>Bidder Name <span class="text-danger">*</span></label></div>
                            <div><input type="text" name="bidder_name" id="bidder_name" class="form-control"
                                    placeholder="Enter Bidder Name" value="{{$bidderdetails->bidder_name ?? ''}}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>Bidder Email <span class="text-danger">*</span></label></div>
                            <div><input type="email" name="bidder_email" id="bidder_email" class="form-control"
                                    placeholder="Enter Bidder Email" value="{{$bidderdetails->bidder_email ?? ''}}">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>Bidder Contact Number <span class="text-danger">*</span></label>
                            </div>
                            <div><input type="text" minlength="10" maxlength="10"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    name="bidder_number" id="bidder_number" class="form-control"
                                    value="{{$bidderdetails->bidder_number ?? ''}}">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>Bidder Address <span class="text-danger">*</span></label>
                            </div>
                            <div><textarea name="address" id="address" cols="30" rows="5"
                                    class="form-control">{{$bidderdetails->address ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>State <span class="text-danger">*</span></label>
                            </div>
                            <div><select class="form-control" id="txtState" name="state"
                                    onchange="getDistrictByState(this.value,'')">
                                    <option disabled selected>Select</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->code }}" @if(isset($bidderdetails->state )
                                        && $state->
                                        code==$bidderdetails->state)selected
                                        @endif>
                                        {{$state->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                            <div class=""><label>District <span class="text-danger">*</span></label>
                            </div>
                            <div><select class="form-control" id="district_id" name="district_id"
                                    onchange="getSubDistrictByDistrict(this.value,'')">
                                    <option value="" selected>Select District</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class=" pt-4 text-center">
                                <input type="hidden" name="editId" value="{{$bidderdetails->id ?? ''}}">
                                <input type="submit" name="submit" class="btn btn-success" value="Save" />
                                <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Bidder')}}"
                                    class="btn btn-danger">Cancel</a>
                            </div>
                        </div>



                    </div>
                </form>
            </div>


    </main>
</section>
<!-- </section> -->
@endsection

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@if(($bidderdetails->id ?? '') != null)

<script>
$(document).ready(function() {

    getDistrictByState('{{ $bidderdetails->state }}',
        '{{ $bidderdetails->district }}');
    getSPDListByAgency('{{ $bidderdetails->agency_sub_id }}')

});
</script>

@endif
<script>
function getSPDListByAgency(spd = 0) {
    var agency_id = $('#agency_id').val();

    $('#loading-bg-ajax').removeClass('hide');
    if (agency_id) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/{{Auth::getDefaultDriver()}}/ajaxGetSPDByAgencyID/' + agency_id + '/' + spd,
            success: function(data) {
                $('#loading-bg-ajax').addClass('hide');
                if (data.status == 'success') {
                    $('#spd_data').html(data.result);
                    $('#spd_header').html('Select SPD <span class="text-danger">*</span>');
                } else {
                    $('#spd_header').html('');
                    $('#spd_data').html('');

                }
            }
        });
    } else {
        alert('Please select Agency');
    }
}
</script>
@endpush