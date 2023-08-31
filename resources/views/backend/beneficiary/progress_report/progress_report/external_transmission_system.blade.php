<label class="headLebels">External Transmission System

</label>
<br>
<div class="col-sm-12">
    <label for="name" class="pb-2"> Responsibility for external transmission system
        <span class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="ext_responsibility" value="A"
                @if(($generalData['external_transmission_system']['ext_responsibility'] ?? '' )=='A' ) checked @endif
                checked> CTU
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="ext_responsibility" value="B"
                @if(($generalData['external_transmission_system']['ext_responsibility'] ?? '' )=='B' ) checked @endif>
            STU
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('ext_responsibility') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-md-8 col-sm-12">
    <label>Details of external transmission system<span class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="external_details" id="" cols="10"
        rows="2">{{$generalData['external_transmission_system']['external_details'] ?? ''}}</textarea>
    <label for="" class="text-primary"> Please mention,requirement of transformers,length of lines,pooling substation
        details, LILO, distance from STU/CTU, or any other arrangement of proposed system and progress made so
        far</label>
    <span class="text-danger">{{ $errors->first('external_details') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Status of tender & schedule for completion of external transmission system work &progress made so far<span
            class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="external_status" id="" cols="10"
        rows="2">{{$generalData['external_transmission_system']['external_status'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('external_status') }}</span>
</div>

<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="ext_remarks" id="" cols="10"
        rows="2">{{$generalData['external_transmission_system']['ext_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('ext_remarks') }}</span>
</div>