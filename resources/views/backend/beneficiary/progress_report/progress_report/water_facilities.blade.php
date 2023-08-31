<label class="headLebels">Water Facilities</label>
<br>
<div class="col-md-6 col-sm-12">
    <label>Source of water for park<span class="error">*</span></label>
    <input type="text" name="source_water" id="txtName" class="form-control "
        value="{{($generalData['water_facilities']['source_water'] ?? '')}}">
    <span class="text-danger"><br>{{ $errors->first('source_water') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Details of water requirements<span class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="required_water" id="" cols="10"
        rows="2">{{($generalData['water_facilities']['required_water'] ?? '')}}</textarea>
    <span class="text-danger"><br>{{ $errors->first('required_water') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Proposed system and progress made so far<span class="error">*</span> <span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="proposed_system" id="" cols="10"
        rows="2">{{($generalData['water_facilities']['proposed_system'] ?? '')}}</textarea>
    <span class="text-danger"><br>{{ $errors->first('proposed_system') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>
        Status of tender and schedule for completion of Water Facilities<span class="error">*</span><span
            class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="status" id="" cols="10" rows="2">{{($generalData['water_facilities']['status'] ?? '')}}</textarea>
    <span class="text-danger"><br>{{ $errors->first('status') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="water_facility_remarks" id="" cols="10"
        rows="2">{{($generalData['water_facilities']['water_facility_remarks'] ?? '')}}</textarea>
    <span class="text-danger"><br>{{ $errors->first('water_facility_remarks') }}</span>
</div>