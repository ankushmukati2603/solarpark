<label class="headLebels">Drainage System</label>
<br>

<div class="col-md-8 col-sm-12">
    <label>Details of proposed drainage system (including length in km)<span class="error">*</span><span
            class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="drainage_system_details" id="" cols="10"
        rows="2">{{($generalData['drainage_system']['drainage_system_details'] ?? '')}}</textarea>
    <span class="text-danger">{{ $errors->first('drainage_system_details') }}</span>

</div>
<div class="col-md-8 col-sm-12">
    <label>Status of tender & schedule for completion of the drainage system & progress made so far
        (including length in km)<span class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="tender_status" id="" cols="10"
        rows="2">{{($generalData['drainage_system']['tender_status'] ?? '')}}</textarea>
    <span class="text-danger">{{ $errors->first('tender_status') }}</span>

</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="otherRemarks" id="" cols="10"
        rows="2">{{($generalData['drainage_system']['otherRemarks'] ?? '')}}</textarea>
    <span class="text-danger">{{ $errors->first('otherRemarks') }}</span>
</div>