<div>
    <label>Project Location <span class="error">*</span></label>
</div><br>

<!-- <div class="col-md-4 col-sm-12">
    <label>State<span class="error">*</span></label>
    <select class="form-control" id="txtState" name="state" onchange="getDistrictByState(this.value,'')">
        <option disabled selected>Select</option>
        @foreach($states as $state)
        <option value="{{$state->code }}">
            {{$state->name }}
        </option>
        @endforeach
    </select>
    <span class="text-danger">{{ $errors->first('state') }}</span>
</div> -->
<div class="col-md-4 col-sm-12 mb-4">
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
</div>
<div class="col-md-4 col-sm-12">
    <label>District<span class="error">*</span></label>
    <select class="form-control" id="district_id" name="district_id" onchange="getSubDistrictByDistrict(this.value,'')">
        <option value="" selected>Select District</option>
    </select>
    <span class="text-danger">{{ $errors->first('district_id') }}</span>
</div>

<!-- <div class="col-md-4 col-sm-12">
        <label>Sub District<span class="error">*</span></label>
        <select class="form-control" id="sub_district_id" name="sub_district_id"
            onchange="getVillageBySubDistrict(this.value,'')">
            <option value="" selected disabled>Select Sub-District</option>
        </select>
        <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Village<span class="error">*</span></label>
        <select class="form-control " id="village" name="village">
            <option value="" selected disabled>Select Village</option>
        </select>
        <span class="text-danger">{{ $errors->first('village') }}</span>
    </div> -->

<div class="col-md-4 col-sm-12">
    <label>Sub District<span class="error">*</span></label>
    <select class="form-control" id="sub_district_id" name="sub_district_id"
        onchange="getVillageBySubDistrict(this.value,'')">
        <option value="" selected disabled>Select Sub-District</option>
    </select>
    <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>

</div>
<div class="clearfix"></div>
<div class="col-md-4 col-sm-12">
    <label>Village<span class="error">*</span></label>
    <select class="form-control " id="village_id" name="village">
        <option value="" selected disabled>Select Village</option>
    </select>
    <span class="text-danger">{{ $errors->first('village') }}</span>

</div>

<div class="col-md-4 col-sm-12">
    <label>Latitude<span class="error">*</span></label>
    <input type="number" placeholder="00.00000" step="any" min="0" name="latitude" id="txtgeneralLatitude"
        class="form-control  number" value="{{$generalData['projectLocation']['latitude'] ?? ''}}">
</div>

<div class="col-md-4 col-sm-12">
    <label>Longitude<span class="error">*</span></label>
    <input type="number" step="any" min="0" name="longitude" id="txtgeneralLongitude" placeholder="00.00000"
        class="form-control  number" value="{{$generalData['projectLocation']['longitude'] ?? ''}}">
</div>