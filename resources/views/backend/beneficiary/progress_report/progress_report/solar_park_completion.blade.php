<label class="headLebels">Solar park Completion</label>
<br>
<div class="clearfix"></div>
<div class="col-sm-12">
    <label for="name" class="pb-2">Whether the internal infrastructure of park development activities are completed<span
            class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="developement_activities" value="A"
                @if(($generalData['solar_park_completion']['developement_activities'] ?? '' )=='A' ) checked @endif
                checked> Yes
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="developement_activities" value="B"
                @if(($generalData['solar_park_completion']['developement_activities'] ?? '' )=='B' ) checked @endif> No
        </label>
    </div>
    <span class="text-danger">{{ $errors->first('developement_activities') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-md-4 col-sm-12">
    <label>Date of In-Principle Approval <span class="error">*</span></label>
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
            placeholder="MM-DD-YYYY" name="date_inprincuple_approval"
            value="{{$generalData['solar_park_completion']['date_inprincuple_approval'] ?? ''}}">
    </div>
    <span class="text-danger">{{ $errors->first('date_inprincuple_approval') }}</span>
</div>
<div class="clearfix"></div><br>
<div class="col-md-8 col-sm-12">
    <label>Details of material received at site for pooling stations and other work of Solar Park<span
            class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="solarPark_work_details" id="" cols="10"
        rows="2">{{$generalData['solar_park_completion']['solarPark_work_details'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('solarPark_work_details') }}</span>
</div><br>
<div class="col-md-8 col-sm-12">
    <label>Delay (if any) along with reason<span class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="SPC_delay" id="" cols="10"
        rows="2">{{$generalData['solar_park_completion']['SPC_delay'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('SPC_delay') }}</span>
</div><br>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="SPC_remarks" id="" cols="10"
        rows="2">{{$generalData['solar_park_completion']['SPC_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('SPC_remarks') }}</span>
</div>