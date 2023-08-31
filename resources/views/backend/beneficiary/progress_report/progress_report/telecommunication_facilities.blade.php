<label class="headLebels">Telecommunication Facilities</label>
<br>

<div class="col-md-8 col-sm-12">
    <label>Details of telecommunication facilities<span class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="tele_facility_details" id="" cols="10"
        rows="2">{{$generalData['telecommunication_facilities']['tele_facility_details'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('tele_facility_details') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Status of tender and schedule for completion and progress made so far<span class="error">*</span><span
            class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="tender_progress_status" id="" cols="10"
        rows="2">{{$generalData['telecommunication_facilities']['tender_progress_status'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('tender_progress_status') }}</span>
</div>

<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="telecomunication_remark" id="" cols="10"
        rows="2">{{$generalData['telecommunication_facilities']['telecomunication_remark'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('telecomunication_remark') }}</span>
</div>