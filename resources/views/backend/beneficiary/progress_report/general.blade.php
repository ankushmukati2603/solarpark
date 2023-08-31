<div id="home" class=" tab-pane active"><br>

    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">General Details</h5>
    <br>


    <div class="row pb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Park Name<span class="text-danger">*</span></label>
            <input type="text" name="park_name" placeholder="Name" id="txtName" class="form-control"
                value="{{$generalData['general']['park_name'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Email of CEO/MD/CMD of SPPD<span class="text-danger">*</span></label>
            <input type="text" name="ceo_mail" placeholder="Email of CEO/MD/CMD of SPPD" id="txtName"
                class="form-control" value="{{$generalData['general']['ceo_mail'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Contact Number of CEO/MD/CMD of SPPD<span class="text-danger">*</span></label>
            <input type="text" name="ceo_contact_number" maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                placeholder="Contact Number of CEO/MD/CMD of SPPD" id="txtName" class="form-control"
                value="{{$generalData['general']['ceo_contact_number'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>State<span class="text-danger">*</span></label>
            <select class="form-control  " id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
                <option disabled selected>Select State</option>
                @foreach($states as $state)
                <option value="{{$state->code }}" @if(isset($generalData['general']['state'] ) && $state->
                    code==$generalData['general']['state'])selected
                    @endif>
                    {{$state->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>District<span class="text-danger">*</span></label>
            <select class="form-control  " id="district_id" name="district_id"
                onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                <option value="" selected>Select District</option>
            </select>

        </div>
        <div class="col-md-4 col-sm-12  mb-4">
            <label>Sub District/Taluka/Tehsil<span class="text-danger">*</span></label>
            <select class="form-control  " id="sub_district_id" name="sub_district_id"
                onchange="getVillageBySubDistrict(this.value,'')">
                <option value="" selected disabled>Select Sub-District</option>
            </select>

        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Village<span class="text-danger">*</span></label>
            <select class="form-control  " id="village_id" name="village">
                <option value="" selected disabled>Select Village</option>
            </select>

        </div>
        <div class="col-md-4 col-sm-12 mb-4">

            <label>Latitude<span class="text-danger">*</span></label>
            <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
                class="form-control  number" value="{{$generalData['general']['latitude'] ?? ''}}">

            <span class="text-primary">Not aware of Coordinates? <a href="https://www.gps-coordinates.net/"
                    target="_blank">Click here</a></span>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Longitude<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
                class="form-control  number" value="{{$generalData['general']['longitude'] ?? ''}}">

        </div>
        <div class="clearfix"></div>

        <br>
        <div class="clearfix"></div><br>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Approved Capacity (in MW)<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="capacity" placeholder="Approved Capacity (in MW)"
                id="txtgeneralLatitude" class="form-control" value="{{$generalData['general']['capacity'] ?? ''}}">
        </div>
        <!-- <div class="col-md-4 col-sm-12 mb-4">
            <label>Date of In-Principle Approval <span class="text-danger">*</span></label>
            <div class="input-group date">

                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="date" value="{{$generalData['general']['date'] ?? ''}}">
            </div>
        </div> -->
        <div class="col-md-4 col-sm-12 mb-4">

            <label>Solar Power Park Developer Name (SPPD)<span class="text-danger">*</span></label>
            <input type="text" name="park_developer_name" id="txtgeneralLatitude"
                placeholder="Solar Power Park Developer Name (SPPD)" class="form-control"
                value="{{$generalData['general']['park_developer_name'] ?? ''}}">
        </div>
        <div class="clearfix"></div><br>
        <div class="col-md-12 col-sm-12 mb-4">
            <label>Office Address<span class="text-danger">*</span><span class="text-primary"><small>(upto
                        255 Characters)</small></span></label>
            <textarea rows="3" class="form-control " id="txtAddress" placeholder="Office Address" name="address"
                value="{{$generalData['general']['address'] ?? ''}}">{{$generalData['general']['address'] ?? ''}}</textarea>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Mobile Number (Office)<span class="text-danger">*</span></label>
            <input type="text" name="office_contact_number" minlength="10" maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number (Office)"
                id="txtContact" class="form-control  number"
                value="{{$generalData['general']['office_contact_number'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('office_contact_number') }}</span>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Concerned Person Name<span class="text-danger">*</span></label>
            <input type="text" name="concerned_person_name" id="txtName" placeholder="Concerned Person Name"
                class="form-control " value="{{$generalData['general']['concerned_person_name'] ?? ''}}"><span
                class="text-danger">{{ $errors->first('concerned_person_name') }}</span>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Email ID<span class="text-danger">*</span></label>
            <input type="email" readonly name="email" id="txtEmail" placeholder="Email ID" class="form-control  email"
                value="{{ Auth::user()->email ?? ''}}"><span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
        <!-- value="{{$generalData['general']['email'] ?? ''}}" -->
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Office/ Landline Number <span class="text-danger">*</span></label>
            <input type="text" name="telephone_number" maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="txttelephone"
                placeholder="Office/ Landline Number" class="form-control  number"
                value="{{$generalData['general']['telephone_number'] ?? ''}}"><span
                class="text-danger">{{ $errors->first('telephone_number') }}</span>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Mobile Number <span class="text-danger">*</span></label>
            <input type="text" readonly name="mobile_number" minlength="10" maxlength="10"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number"
                id="txtContact" class="form-control  number" value="{{ Auth::user()->contact_no ?? ''}}  "><span
                class="text-danger">{{ $errors->first('mobile_number') }}
            </span>
            <!-- "{{$generalData['general']['mobile_number'] ?? ''}}" -->
        </div>
        <div class="col-sm-12">
            <h6> DPR Status <span class="text-danger">*</span></h6>
            <br>

            <div class="form-check-inline col-md-2">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="dpr_status" value="A"
                        @if(($generalData['general']['dpr_status'] ?? '' )=='A' ) checked @endif checked
                        @if(($generalData['dpr_status'] ?? '' )=='D' ) readonly @endif>
                    DPR
                    Under Preparation
                </label>
            </div>
            <div class="form-check-inline col-md-2">
                <label class="form-check-label">

                    <input type="radio" class="form-check-input" name="dpr_status" value="B"
                        @if(($generalData['general']['dpr_status'] ?? '' )=='B' ) checked @endif
                        @if(($generalData['dpr_status'] ?? '' )=='D' ) readonly @endif> DPR
                    Submitted
                </label>
            </div>
            <div class="form-check-inline col-md-2">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="dpr_status" value="C"
                        @if(($generalData['general']['dpr_status'] ?? '' )=='C' ) checked @endif
                        @if(($generalData['dpr_status'] ?? '' )=='D' ) readonly @endif> DPR
                    Under
                    Revision
                </label>
            </div>
            <div class="form-check-inline col-md-2">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="dpr_status" value="D"
                        @if(($generalData['general']['dpr_status'] ?? '' )=='D' ) checked @endif
                        @if(($generalData['dpr_status'] ?? '' )=='D' ) checked @endif @if(($generalData['dpr_status']
                        ?? '' )=='D' ) readonly @endif> DPR
                    Approved
                </label>
            </div>
            <!-- </div>
        <br><br><br>
        <div> -->

            <div class="clearfix"></div>

        </div>
    </div>
</div>

@push('backend-js')

@if(($generalData['general'] ?? '') != null)

<script>
$(document).ready(function() {

    getDistrictByState('{{ $generalData["general"]["state"] }}', '{{ $generalData["general"]["district"] }}');
    getSubDistrictByDistrict('{{ $generalData["general"]["district"] }}',
        '{{ $generalData["general"]["sub_district"] }}');

    // // // block table k  column ka name
    getVillageBySubDistrict('{{ $generalData["general"]["sub_district"] }}',
        '{{ $generalData["general"]["village"] }}');

});
</script>
@endif

@endpush