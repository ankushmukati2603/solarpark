<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">General</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}','{{$generalData["report_type"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <!-- <label class="headLebels">General Details</label> -->
    <br>
    <div class="col-md-4 col-sm-12">
        <label>Agency <span class="text-danger">*</span></label>
        <input type="text" name="agency_name" placeholder="Agency" id="txtName" class="form-control "
            value="{{$generalData['general']['agency_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('park_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Scheme Type<span class="text-danger">*</span></label>
        <select class="form-control" name="scheme_type" id="">
            <option value="">Select Scheme Type</option>
            <option value="1" @if(($generalData['general']['scheme_type'] ?? '' )=='1' ) selected @endif>State
            </option>
            <option value="2" @if(($generalData['general']['scheme_type'] ?? '' )=='2' ) selected @endif>Central
            </option>
        </select>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12">
        <h3> Contact Person Details<span class="text-danger">*</span>
            <hr>
        </h3>

    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Name<span class="text-danger">*</span></label>
        <input type="text" placeholder="Name" name="contact_person_name" id="" class="form-control  number"
            value="{{$generalData['general']['contact_person_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('contact_person_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Email<span class="text-danger">*</span></label>
        <input type="email" name="email" id="" placeholder="Email" class="form-control  number"
            value="{{$generalData['general']['email'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Mobile Number<span class="text-danger">*</span></label>
        <input type="text" name="mobile_number" id="" minlength="10" maxlength="10"
            onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Mobile Number"
            class="form-control" value="{{$generalData['general']['mobile_number'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
    </div>
    <div class="col-md-12">
        <label>Bidding Agency<span class="text-danger">*</span></label>
        <input type="text" placeholder="Bidding Agency" name="bidding_agency" id="" class="form-control  number"
            value="{{$generalData['general']['bidding_agency'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('bidding_agency') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12">
        <h3>Project Location Details<span class="text-danger">*</span>
            <hr>
        </h3>

    </div>
    <div class="clearfix"></div><br>

    <div class="col-md-4 col-sm-12">
        <label>State<span class="text-danger">*</span></label>
        <select class="form-control" id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
            <option disabled selected>Select</option>
            @foreach($states as $state)
            <option value="{{$state->code }}" @if(isset($generalData['general']['state'] ) && $state->
                code==$generalData['general']['state'])selected
                @endif>
                {{$state->name }}
            </option>
            @endforeach
        </select>
        <span class="text-danger">{{ $errors->first('state') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">

        <label>District<span class="text-danger">*</span></label>
        <select class="form-control" id="district_id" name="district_id"
            onchange="getSubDistrictByDistrict(this.value,'') ">
            <option value="" selected>Select District</option>
        </select>
        <span class="text-danger">{{ $errors->first('district_id') }}</span>

    </div>
    <div class="col-md-4 col-sm-12">
        <label>Sub District/Taluka/Tehsil<span class="text-danger">*</span></label>
        <select class="form-control" id="sub_district_id" name="sub_district_id"
            onchange="getVillageBySubDistrict(this.value,'')">
            <option value="" selected disabled>Select Sub-District</option>
        </select>
        <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>

    </div>
    <div class="col-md-4 col-sm-12">
        <label>Village<span class="text-danger">*</span></label>
        <select class="form-control " id="village_id" name="village">
            <option value="" selected disabled>Select Village</option>
        </select>
        <span class="text-danger">{{ $errors->first('village') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Latitude<span class="text-danger">*</span></label>
        <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['latitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('latitude') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Longitude<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
            class="form-control  number" value="{{$generalData['general']['longitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        Not aware of Coordinates? <a href="https://www.latlong.net/convert-address-to-lat-long.html"
            target="_blank">Click here</a>
    </div>
    <br><br>
    <div>

        <div class="clearfix"></div>

    </div>
</div>
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