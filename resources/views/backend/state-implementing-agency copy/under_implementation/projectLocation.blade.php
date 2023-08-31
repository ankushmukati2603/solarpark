<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Project Location</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('project_location','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="row pb-3">

        <div class="col-md-4 col-sm-12 mb-4">
            <label>State<span class="text-danger">*</span></label>
            <select class="form-control" id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
                <option disabled selected>Select</option>
                @foreach($states as $state)
                <option value="{{$state->code }}" @if(isset($generalData['project_location']['state'] ) && $state->
                    code==$generalData['project_location']['state'])selected
                    @endif>
                    {{$state->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>District<span class="text-danger">*</span></label>
            <select class="form-control" id="district_id" name="district_id"
                onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                <option value="" selected>Select District</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Sub District/Taluka/Tehsil<span class="text-danger">*</span></label>
            <select class="form-control" id="sub_district_id" name="sub_district_id"
                onchange="getVillageBySubDistrict(this.value,'')">
                <option value="" selected disabled>Select Sub-District</option>
            </select>
        </div>

        <div class="col-md-4 col-sm-12 mb-4">
            <label>Village<span class="text-danger">*</span></label>
            <select class="form-control " id="village_id" name="village">
                <option value="" selected disabled>Select Village</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Latitude<span class="text-danger">*</span></label>
            <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
                class="form-control  number" value="{{$generalData['project_location']['latitude'] ?? ''}}">
        </div>
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Longitude<span class="text-danger">*</span></label>
            <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
                class="form-control  number" value="{{$generalData['project_location']['longitude'] ?? ''}}">
        </div>
        <div class="col-md-4">
            <label for="name" class="pb-2">Inside Solar Park<span class="text-danger">*</span></label>
            <br>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="inside_solar_park" value="A"
                        @if(($generalData['project_location']['inside_solar_park'] ?? '' )=='A' ) checked @endif
                        checked>
                    Yes
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="inside_solar_park" value="B"
                        @if(($generalData['project_location']['inside_solar_park'] ?? '' )=='B' ) checked @endif>
                    No
                </label>
            </div>
        </div>
    </div>
</div>
@if(($generalData['project_location'] ?? '') != null)

<script>
$(document).ready(function() {

    getDistrictByState('{{ $generalData["project_location"]["state"] }}',
        '{{ $generalData["project_location"]["district_id"] }}');
    getSubDistrictByDistrict('{{ $generalData["project_location"]["district_id"] }}',
        '{{ $generalData["project_location"]["sub_district_id"] }}');

    getVillageBySubDistrict('{{ $generalData["project_location"]["sub_district_id"] }}',
        '{{ $generalData["project_location"]["village"] }}');

});
</script>
@endif