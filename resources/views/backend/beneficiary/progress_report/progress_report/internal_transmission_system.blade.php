<label class="headLebels">Internal Transmission System</label>
<br>
<div class="col-md-8 col-sm-12">
    <label>Details of internal transmission system<span class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="int_transmission_detail" id="" cols="10"
        rows="2">{{$generalData['internal_transmission_system']['int_transmission_detail'] ?? ''}}</textarea>
    <label for="" class="text-primary"> Please mention,requirement of transformers,length of lines,pooling substation
        details, LILO, distance from STU/CTU, or any other arrangement of proposed system and progress made so
        far</label>
    <span class="text-danger">{{ $errors->first('int_transmission_detail') }}</span>
</div>
<div class="clearfix"></div><br>

<div class="col-sm-12">
    <label for="name" class="pb-2"> Proposed connection point
        <span class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="connection_point" value="A"
                @if(($generalData['internal_transmission_system']['connection_point'] ?? '' )=='A' ) checked @endif
                checked>
            CTU
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="connection_point" value="B"
                @if(($generalData['internal_transmission_system']['connection_point'] ?? '' )=='B' ) checked @endif> STU
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('connection_point') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label for="name" class="pb-2"> Whether applied for connectivity/LTA to STU/CTU
        <span class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="whether_applied" value="A"
                @if(($generalData['internal_transmission_system']['whether_applied'] ?? '' )=='A' ) checked @endif
                checked> Yes
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="whether_applied" value="B"
                @if(($generalData['internal_transmission_system']['whether_applied'] ?? '' )=='B' ) checked @endif> No
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('whether_applied') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-md-8 col-sm-12">
    <label>
        Capacity for which connectivity granted (in MW) <span class="error">*</span></label>

    <input type="number" step="any" min="0" name="connectivity_capacity" id="txtconnectivityCapacity"
        class="form-control" value="{{$generalData['internal_transmission_system']['connectivity_capacity'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('connectivity_capacity') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Capacity for which LTA granted (in MW))<span class="error">*</span></label>
    <input type="number" step="any" min="0" name="lta_capacity" id="txtltaCapacity" class="form-control"
        value="{{$generalData['internal_transmission_system']['lta_capacity'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('lta_capacity') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Status of tender & schedule for completion of internal transmission system work &progress made so far<span
            class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="internal_transmission_status" id="" cols="10"
        rows="2">{{$generalData['internal_transmission_system']['internal_transmission_status'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('internal_transmission_status') }}</span>
</div>

<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="internal_transmission_remarks" id="" cols="10"
        rows="2">{{$generalData['internal_transmission_system']['internal_transmission_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('internal_transmission_remarks') }}</span>
</div>