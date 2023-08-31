<label class="headLebels">Internal Infrastructure</label>
<br>
<div class="col-sm-12">
    <label for="name" class="pb-2"> DPR Status
        <span class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dpr_status" value="A"
                @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='A' ) checked @endif checked> DPR
            Under Preparation
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">

            <input type="radio" class="form-check-input" name="dpr_status" value="B"
                @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='B' ) checked @endif> DPR Submitted
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dpr_status" value="C"
                @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='C' ) checked @endif> DPR Under
            Revision
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dpr_status" value="D"
                @if(($generalData['internal_infrastructure']['dpr_status'] ?? '' )=='D' ) checked @endif> DPR Approved
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('dpr_status') }}</span>
</div>

<div class="clearfix"></div>
<div class="col-sm-12">
    <label for="name" class="pb-2"> Land Status
        <span class="error">*</span></label> <br>
    <div class="form-check-inline">
        <input class="form-check-input" type="checkbox" name="land_status_identified" value="1"
            @if(($generalData['internal_infrastructure']['land_status_identified'] ?? '' )==1) checked @endif
            id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            Land Identified
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('land_identified') }}</span>
    <div class="form-check-inline">
        <input class="form-check-input" type="checkbox" name="land_status_aquired"
            @if(($generalData['internal_infrastructure']['land_status_aquired'] ?? '' )==2) checked @endif value="2"
            id="flexCheckChecked">
        <label class="form-check-label" for="flexCheckChecked">
            Land Acquired
        </label>
    </div>
    <span class="text-danger"> <br>{{ $errors->first('land_status') }}</span>
</div>
<div class="clearfix"></div>
<div class="col-md-4 col-sm-12">
    <label>Land Acquired (In Acres) <span class="error">*</span></label>
    <input type="number" min="0" name="land_acquired_acres" id="txtContact" class="form-control"
        value="{{$generalData['internal_infrastructure']['land_acquired_acres'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('land_acquired_acres') }}</span>
</div>

<div class="clearfix"></div><br>
<div class="col-sm-12">
    <label>Land Type <span class="error">*</span></label>
</div>
<br>

<div class="col-md-3">
    <label for="">Government Land</label> <br>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="govt_land" value="A"
                @if(($generalData['internal_infrastructure']['govt_land'] ?? '' )=='A' ) checked @endif checked> Land
            Identified
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="govt_land" value="B"
                @if(($generalData['internal_infrastructure']['govt_land'] ?? '' )=='B' ) checked @endif>Land Acquired
        </label>
    </div>
</div>
<div class="col-md-3">
    <label for="">Private Land</label> <br>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="private_land" value="A"
                @if(($generalData['internal_infrastructure']['private_land'] ?? '' )=='A' ) checked @endif checked> Land
            Identified
        </label>
    </div>
    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="private_land" value="B"
                @if(($generalData['internal_infrastructure']['private_land'] ?? '' )=='B' ) checked @endif>Land Acquired
        </label>
    </div>
</div>
<div class="clearfix"></div><br>
<div class="col-md-4 col-sm-12">
    <label>Any Others<span class="error">*</span></label>

    <input type="text" name="others" id="txtContact" class="form-control  number"
        value="{{$generalData['internal_infrastructure']['others'] ?? ''}}">
    <span class="text-danger">{{ $errors->first('others') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-md-4 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea type="text" name="internal_infrastructure_remarks" id="txtContact" cols="2" rows="3" class="form-control"
        value="{{$generalData['internal_infrastructure']['internal_infrastructure_remarks'] ?? ''}}">{{$generalData['internal_infrastructure']['internal_infrastructure_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('internal_infrastructure_remarks') }}</span>
</div>