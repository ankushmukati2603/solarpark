<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Project Location</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="projectLocation"
            onchange="getLastMonthSNAReportDetails('project_location','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div><br>
    <div class="col-md-4 col-sm-12">
        <label>State<span class="text-danger">*</span></label>
        <select class="form-control" id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
            <option disabled selected>Select</option>
            @foreach($states as $state)
            <option value="{{$state->code }}" @if(isset($generalData['projectLocation']['state'] ) && $state->
                code==$generalData['projectLocation']['state'])selected
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
            onchange="getSubDistrictByDistrict(this.value,'')">
            <option value="" selected>Select District</option>
        </select>
        <span class="text-danger">{{ $errors->first('district_id') }}</span>
    </div>

    <!-- <div class="col-md-4 col-sm-12">
        <label>Sub District<span class="text-danger">*</span></label>
        <select class="form-control" id="sub_district_id" name="sub_district_id"
            onchange="getVillageBySubDistrict(this.value,'')">
            <option value="" selected disabled>Select Sub-District</option>
        </select>
        <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Village<span class="text-danger">*</span></label>
        <select class="form-control " id="village" name="village">
            <option value="" selected disabled>Select Village</option>
        </select>
        <span class="text-danger">{{ $errors->first('village') }}</span>
    </div> -->

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

    <div class="clearfix"></div><br>

    <div class="col-md-4 col-sm-12">
        <label>Latitude<span class="text-danger">*</span></label>
        <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['projectLocation']['latitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('latitude') }}</span>
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Longitude<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
            class="form-control  number" value="{{$generalData['projectLocation']['longitude'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('longitude') }}</span>
    </div>
</div>
@if(($generalData['project_location'] ?? '') != null)

<script>
$(document).ready(function() {

    getDistrictByState('{{ $generalData["project_location"]["state"] }}',
        '{{ $generalData["project_location"]["district_id"] }}');
    getSubDistrictByDistrict('{{ $generalData["project_location"]["district_id"] }}',
        '{{ $generalData["project_location"]["sub_district_id"] }}');

    // // // block table k  column ka name
    getVillageBySubDistrict('{{ $generalData["project_location"]["sub_district_id"] }}',
        '{{ $generalData["project_location"]["village"] }}');

});
</script>
@endif