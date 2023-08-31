<div>
    <label class="headLebels">Fencing/Boundary</label>
    <br>
    <div class="col-md-8 col-sm-12">
        <label>Details of of fencing/boundary (including length)<span class="error">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="fencing_details" id="" cols="10" rows="2"
            value="{{$generalData['fencing_boundary']['fencing_details'] ?? ''}}">{{$generalData['fencing_boundary']['fencing_details'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('fencing_details') }}</span>
    </div>
    <div class="col-md-8 col-sm-12">
        <label>Status of tender and schedule for completion for fencing/boundary<span class="error">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="fencing_status" id="" cols="10" rows="2"
            value="{{$generalData['fencing_boundary']['fencing_status'] ?? ''}}">{{$generalData['fencing_boundary']['fencing_status'] ?? ''}}</textarea>
        <label for="" class="text-primary">Note: Please mention length, proposed system and progress made so
            far</label><br>
        <span class="text-danger">{{ $errors->first('fencing_status') }}</span>
    </div>
    <div class="col-md-8 col-sm-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="otherRemark" id="" cols="10" rows="2"
            value="{{$generalData['fencing_boundary']['otherRemark'] ?? ''}}">{{$generalData['fencing_boundary']['otherRemark'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('otherRemark') }}</span>
    </div>
</div>