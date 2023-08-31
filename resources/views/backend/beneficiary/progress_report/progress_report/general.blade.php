<div><br>
    <!-- <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div> -->
    <label class="headLebels">General Details</label>
    <br>
    <div class="col-md-4 col-sm-12">
        <label>Park Name<span class="error">*</span></label>
        <input type="text" name="park_name" placeholder="Name" id="txtName" class="form-control "
            value="{{Auth::user()->name_of_solar_park}}" readonly>
        <!-- {{$generalData['general']['park_name'] ?? ''}} -->
        <span class="text-danger">{{ $errors->first('park_name') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>State<span class="error">*</span></label>
        <select class="form-control  select2" id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
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
        <label>District<span class="error">*</span></label>
        <select class="form-control  select2" id="district_id" name="district_id"
            onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
            <option value="" selected>Select District</option>
        </select>
        <span class="text-danger">{{ $errors->first('district_id') }}</span>

    </div>
    <div class="col-md-4 col-sm-12">
        <label>Sub District<span class="error">*</span></label>
        <select class="form-control  select2" id="sub_district_id" name="sub_district_id"
            onchange="getVillageBySubDistrict(this.value,'')">
            <option value="" selected disabled>Select Sub-District</option>
        </select>
        <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>

    </div>
    <div class="col-md-4 col-sm-12">
        <label>Village<span class="error">*</span></label>
        <select class="form-control  select2" id="village_id" name="village">
            <option value="" selected disabled>Select Village</option>
        </select>
        <span class="text-danger">{{ $errors->first('village') }}</span>

    </div>
    <div class="col-md-4 col-sm-12">

        <label>Latitude<span class="error">*</span></label>
        <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['general']['latitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('latitude') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Longitude<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
            class="form-control  number" value="{{$generalData['general']['longitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-4 col-sm-12">
        Not aware of Coordinates? <a href="">Click here</a>
    </div>
    <br>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Approved Capacity (in MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="capacity" id="txtgeneralLatitude" class="form-control"
            value="{{$generalData['general']['capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('capacity') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of In-Principle Approval <span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="date" value="{{$generalData['general']['date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">

        <label>Solar Power Park Developer Name (SPPD)<span class="error">*</span></label>
        <input type="text" name="park_developer_name" id="txtgeneralLatitude" class="form-control"
            value="{{$generalData['general']['park_developer_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('park_developer_name') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Office Address<span class="error">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea rows="3" class="form-control " id="txtAddress" name="address"
            value="{{$generalData['general']['address'] ?? ''}}">{{$generalData['general']['address'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('address') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Mobile Number (Office)<span class="error">*</span></label>
        <input type="number" name="office_contact_number" minlength="10" maxlength="10" id="txtContact"
            class="form-control  number" value="{{$generalData['general']['office_contact_number'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('office_contact_number') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Concerned Person Name<span class="error">*</span></label>
        <input type="text" name="concerned_person_name" id="txtName" class="form-control "
            value="{{$generalData['general']['concerned_person_name'] ?? ''}}"><span
            class="text-danger">{{ $errors->first('concerned_person_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Email ID<span class="error">*</span></label>
        <input type="email" name="email" id="txtEmail" class="form-control  email" value="{{Auth::user()->email}}"
            readonly><span class="text-danger">{{ $errors->first('email') }}</span>
    </div>
    <!-- value="{{$generalData['general']['email'] ?? ''}}" -->
    <div class="col-md-4 col-sm-12">
        <label>Office/ Landline Number <span class="error">*</span></label>
        <input type="number" name="telephone_number" min="0" id="txttelephone" class="form-control  number"
            value="{{$generalData['general']['telephone_number'] ?? ''}}"><span
            class="text-danger">{{ $errors->first('telephone_number') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Mobile Number <span class="error">*</span></label>
        <input type="number" name="mobile_number" minlength="10" maxlength="10" id="txtContact"
            class="form-control  number" value="{{Auth::user()->contact_no}}" readonly><span
            class="text-danger">{{ $errors->first('mobile_number') }}
        </span>
        <!-- "{{$generalData['general']['mobile_number'] ?? ''}}" -->
    </div>
    <br><br><br>
    <div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- @if(($generalData['general'] ?? '') != null)

<script>
$(document).ready(function() {
    alert('hi');
    getDistrictByState(1, 2);
    // getSubDistrictByDistrict('{{ $generalData["general"]["district"] }}',
    //     '{{ $generalData["general"]["sub_district"] }}');

    // // // block table k  column ka name
    // getVillageBySubDistrict('{{ $generalData["general"]["sub_district"] }}',
    //     '{{ $generalData["general"]["village"] }}');

});
</script>
@endif -->
<script>

</script>