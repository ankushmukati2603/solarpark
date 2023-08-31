@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Add Tender</h1>
                        <hr style="color: #959595;">

                    </div>
                    <form action="{{URL::to(Auth::getDefaultDriver().'/Tenders/Add')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>NIT No./ RfS No. <span class="text-danger">*</span></label></div>
                                <div class=""><input type="text" name="nit_no" id="nit_no" class="form-control"
                                        placeholder="Enter NIT No." value="{{$tenderdetails->nit_no ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Scheme Type <span class="text-danger">*</span></label></div>
                                <div class=""><select name="scheme_type" id="scheme_type" class="form-control">
                                        <option value="">~~~Select~~~</option>
                                        <option value="State" @if(($tenderdetails->scheme_type ?? '')=='State') selected
                                            @endif>State</option>
                                        <option value="Central" @if(($tenderdetails->scheme_type ?? '')=='Central')
                                            selected
                                            @endif>Central</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Tender Title <span class="text-danger">*</span></label></div>
                                <div class=""><input type="text" name="tender_title" id="tender_title"
                                        class="form-control" placeholder="Enter Tender Title"
                                        value="{{$tenderdetails->tender_title ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Capacity(MW) <span class="text-danger">*</span></label></div>
                                <div class=""><input type="number" step="any" name="capacity" id="capacity"
                                        class="form-control" placeholder="Enter Capacity in MW"
                                        value="{{$tenderdetails->capacity ?? ''}}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>NIT Date <span class="text-danger">*</span></label></div>
                                <div class=""><input type="date" name="nit_date" id="nit_date" class="form-control"
                                        value="{{$tenderdetails->nit_date ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>RFS Date <span class="text-danger">*</span></label></div>
                                <div class=""><input type="date" name="rfs_date" id="rfs_date" class="form-control"
                                        value="{{$tenderdetails->rfs_date ?? ''}}">
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Pre Bid Meeting Date <span class="text-danger">*</span></label>
                                </div>
                                <div class=""><input type="date" name="pre_bid_meeting_date" id="pre_bid_meeting_date"
                                        class="form-control" value="{{$tenderdetails->pre_bid_meeting_date ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Last Date of Bid Submission <span
                                            class="text-danger">*</span></label></div>
                                <div class=""><input type="date" name="bid_submission_date" id="bid_submission_date"
                                        class="form-control" value="{{$tenderdetails->bid_submission_date ?? ''}}">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Additional Information(Optional) <span
                                            class="text-danger">*</span></label></div>
                                <div class=""><textarea name="additional_information" id="additional_information"
                                        class="form-control" cols="30"
                                        rows="5">{{$tenderdetails->additional_information ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label>Bidding Agency <span class="text-danger">*</span></label></div>
                                <div class=""><select name="agency_id" id="agency_id" class="form-control"
                                        onchange="getSPDListByAgency()">
                                        <option value="">Choose Agency</option>
                                        @foreach($agencyList as $agency)
                                        <option value="{{$agency->id}}" @if( ($tenderdetails->agency_id ??
                                            '')==$agency->id)
                                            selected @endif>{{$agency->agency_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 pb-3">
                                <div class=""><label id="spd_header">Select SPD </label></div>
                                <div id="spd_data"> <select name="agency_sub_id" id="agency_sub_id"
                                        class="form-control">
                                        <option value="">Select Agency First</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class=" pt-4 text-center">
                                    <input type="hidden" name="editId" value="{{$tenderdetails->id ?? ''}}">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save" />
                                    <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Tenders')}}"
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
@if(($tenderdetails->id ?? '') != null)

<script>
$(document).ready(function() {

    getSPDListByAgency('{{ $tenderdetails->agency_sub_id }}')

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
                    $('#spd_header').html('Select Agency <span class="text-danger">*</span>');
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