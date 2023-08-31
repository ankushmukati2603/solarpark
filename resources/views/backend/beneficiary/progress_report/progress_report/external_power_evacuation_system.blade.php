<label class="headLebels">External Power Evacuation System</label>
<br>
<div class="col-md-8 col-sm-12">
    <label>Details of completion of external transmission activities<span class="text-danger">*</span><span
            class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="external_transmission" id="" cols="10"
        rows="2">{{($generalData['external_power_evacuation_system']['external_transmission'] ?? '')}}</textarea>
    <label for="" class="text-primary">Please include completion deadline of activities in the scope of
        CTU/STU</label><br>
    <span class="text-danger">{{ $errors->first('external_transmission') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Delay (if any) along with reason<span class="text-danger">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="delay_external_transmission" id="" cols="10"
        rows="2">{{($generalData['external_power_evacuation_system']['delay_external_transmission'] ?? '')}}</textarea>
    <span class="text-danger">{{ $errors->first('delay_external_transmission') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="external_transmission_remarks" id="" cols="10"
        rows="2">{{($generalData['external_power_evacuation_system']['external_transmission_remarks'] ?? '')}}</textarea>
    <span class="text-danger">{{ $errors->first('external_transmission_remarks') }}</span>
</div>