@inject('general', 'App\Http\Controllers\Backend\STU\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">
        <section class="form_sctn">
            <div class="row">

            </div>
            <div class="row">

                <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Progress Report</h1>
                            <hr style="color: #959595;">
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="row   register_form">
                                    <div class="col-xl-12">
                                        <div class="col-xxl-12 section-tittle">
                                            <div class="register_hdng_text"></div>
                                        </div>
                                        @include('layouts.partials.backend._flash')
                                        <form action="{{URL::to(Auth::getDefaultDriver().'/new-stu-progress_report')}}"
                                            method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>Tender/ Bidding Agency for RE Projects, if
                                                            any <span class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input
                                                            placeholder="Tender/ Bidding Agency for RE Projects, if any"
                                                            name="tender_bidding_agency" type="text"
                                                            class="form-control"
                                                            value="{{$editProgressData->tender_bidding_agency ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('tender_bidding_agency') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>Project Details(Name of Developer)<span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input placeholder="Project Details (Name of Developer)"
                                                            name="developer_name" type="text" class="form-control"
                                                            value="{{$editProgressData->developer_name ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('developer_name') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-3 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>Capacity for connectivity applied
                                                            (MW)<span class="text-danger">*</span></strong></label>
                                                    <div class="input-group mb-3">
                                                        <input placeholder="Capacity for connectivity applied (MW)"
                                                            name="capacity_connectivity" type="number" step="any"
                                                            class="form-control"
                                                            value="{{$editProgressData->capacity_connectivity ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('capacity_connectivity') }}</span>
                                                </div></br>

                                                <h4 class="pb-3">Project Location</h4>
                                                <hr>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>State <span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <select class="form-control" id="state_id" name="state_id"
                                                            onchange="getDistrictByState(this.value, '')">
                                                            <option value="">Select State</option>
                                                            @foreach($states as $state)
                                                            <option value="{{$state->code}}" @if($editProgressData->
                                                                state_id == $state->code) selected
                                                                @endif>{{$state->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>District <span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                                        <select class="form-control required select21" id="district_id"
                                                            name="district_id"
                                                            onchange="getSubDistrictByDistrict(this.value,'')">
                                                            <option value="">Select District</option>
                                                        </select>
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>Sub-District <span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <!-- <i class="fa-solid fa-chevron-down"></i> -->
                                                        <select class="form-control  required select21"
                                                            id="sub_district_id" name="sub_district_id"
                                                            onchange="getVillageBySubDistrict(this.value,'')">
                                                            <option value="" selected disabled>Select Sub-District
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('sub_district_id') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label for="name"><strong>Sub Station Location District <span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input placeholder="Sub Station Location District"
                                                            name="sub_station" type="text" class="form-control"
                                                            value="{{$editProgressData->developer_name ?? ''}}">
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('sub_station') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label class="pb-2" for="name"><strong>Connectivity Basis <span
                                                                class="text-danger">*</span></strong></label>
                                                    <select class="form-control" id="connectivity_basis"
                                                        name="connectivity_basis">
                                                        <option value="">Select Project</option>
                                                        <option value="LTA" @if($editProgressData->connectivity_basis ==
                                                            'LTA') selected @endif >LTA</option>
                                                        <option value="PPA" @if($editProgressData->connectivity_basis ==
                                                            'PPA') selected @endif >PPA</option>
                                                        <option value="BG" @if($editProgressData->connectivity_basis ==
                                                            'BG') selected @endif >BG</option>
                                                        <option value="LAND" @if($editProgressData->connectivity_basis
                                                            == 'LAND') selected @endif >LAND</option>
                                                    </select>
                                                    <span
                                                        class="text-danger">{{ $errors->first('connectivity_basis') }}</span>
                                                </div></br>


                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label class="pb-2" for="name"><strong> LTA operationalization date
                                                            <span class="text-danger">*</span>
                                                        </strong></label>
                                                    <div style="position: relative;">
                                                        <input name="lta_operationalization_date"
                                                            id="lta_operationalization_date" type="date"
                                                            class="form-control"
                                                            value="{{$editProgressData->lta_operationalization_date ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('lta_operationalization_date') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label class="pb-2" for="name"><strong> Capacity commissioned in the
                                                            current month (MW), if any<span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input
                                                            placeholder="Capacity commissioned in the current month(MW), if any"
                                                            name="capacity_commissioned" id="capacity_commissioned"
                                                            type="number" step="any" class="form-control"
                                                            value="{{$editProgressData->capacity_commissioned ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('capacity_commissioned') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label class="pb-2" for="name"><strong>Cumulative Capacity
                                                            Commissioned (MW), if any<span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input
                                                            placeholder="Capacity commissioned in the current month(MW), if any"
                                                            name="cumulative_capacity" id="cumulative_capacity"
                                                            type="number" step="any" class="form-control"
                                                            value="{{$editProgressData->cumulative_capacity ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('cumulative_capacity') }}</span>
                                                </div></br>

                                                <div class="form-group col-xl-4 col-lg-4 col-md-6  pb-3">
                                                    <label class="pb-2" for="name"><strong>Cumulative Capacity
                                                            Commissioned Date<span
                                                                class="text-danger">*</span></strong></label>
                                                    <div style="position: relative;">
                                                        <input placeholder="Cumulative Capacity Commissioned Date"
                                                            name="cumulative_capacity_date"
                                                            id="cumulative_capacity_date" type="date"
                                                            class="form-control"
                                                            value="{{$editProgressData->cumulative_capacity_date ?? ''}}">
                                                    </div>
                                                    <span
                                                        class="text-danger">{{ $errors->first('cumulative_capacity_date') }}</span>
                                                </div></br>

                                                <div class="form-group col-lg-12">
                                                    <label for="name"><strong>Remarks / Issues, if any <span
                                                                class="text-danger">*</span></strong></label>
                                                    <div class="input-group mb-3">
                                                        <textarea name="remark" id="remark"
                                                            class="form-control">{{$editProgressData->remark ?? ''}}</textarea>
                                                    </div>
                                                    <span class="text-danger">{{ $errors->first('remark') }}</span>
                                                </div></br>
                                                <div class="col-xxl-12 text-center pt-3 pb-3">
                                                    <!-- <input type="submit" id="submit"
                                        class="mt-1 btn btn-success @isset($editable) hidden @endisset" value="Save">
                                        <input type="hidden" name="editId" value="{{ $id ?? ''}}"> -->

                                                    <input type="submit" name="save" class="mt-1 btn btn-success"
                                                        value="Save as draft">
                                                    <input type="submit" name="submit" class="mt-1 btn btn-success"
                                                        value="Submit">

                                                    <input type="hidden" name="editId"
                                                        value="{{ $general->encodeid($id) ?? ''}}">
                                                    <input type="hidden" name="final" id="final" value="0">

                                                    <!-- <input type="submit" id="submitytr" name="save" > -->
                                                    <!-- @if(($newGecData->final_submission ?? '') == 0)
                                    <input type="button" class="mt-1 btn btn-success" name="final_submission"
                                        onclick="final_submission_save()" value="Final Submission">
                                    <input type="hidden" name="editId" value="{{$newGecData->id ?? ''}}">
                                    <input type="hidden" name="submit_type" id="submit_type" value="0">
                                    @endif  -->
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    </main>
</section>

@endsection
@section('scripts')

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>

<script>
$(document).ready(function() {
    //alert('hi');
    getDistrictByState('{{$editProgressData->state_id}}', '{{$editProgressData->district_id}}');
    getSubDistrictByDistrict('{{ $editProgressData->district_id }}',
        '{{$editProgressData->sub_district_id }}');

});


function submitMe(dt) {
    // alert($(dt).attr('name'));
    if ($(dt).attr('name') == 'submit') {
        $('#final').val(0);
    } else {
        $('#final').val(1);
    }
    $('#submit').trigger("click");
}
</script>

<!-- sanjeev -->
@endpush
@endsection