<label class="headLebels">Solar Project Completion</label>
<br>
<div class="clearfix"></div>
<div class="col-md-8 col-sm-12">
    <label>Details of completion of solar projects activities<span class="text-danger">*</span><span
            class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="solar_project_completion_details" id="" cols="10"
        rows="2">{{$generalData['solar_project_completion']['solar_project_completion_details'] ?? ''}}</textarea>
    <label for="" class="text-primary">Please include completion deadline of activities in the scope of SPD</label><br>
    <span class="text-danger">{{ $errors->first('solar_project_completion_details') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Delay (if any) along with reason<span class="text-danger">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="delay_solar_project" id="" cols="10"
        rows="2">{{$generalData['solar_project_completion']['delay_solar_project'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('delay_solar_project') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="solar_project_complation_remarks" id="" cols="10"
        rows="2">{{$generalData['solar_project_completion']['solar_project_complation_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('solar_project_complation_remarks') }}</span>
</div>