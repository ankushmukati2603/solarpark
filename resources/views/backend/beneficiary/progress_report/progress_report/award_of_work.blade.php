<label class="headLebels">Award of Work</label>
<br>
<div class="col-md-8 col-sm-12">
    <label>Details of tender, award of work for pooling stations, transmission lines and associated systems<span
            class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="award_work_details" id="" cols="10"
        rows="2">{{$generalData['award_of_work']['award_work_details'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('award_work_details') }}</span>
</div>
<div class="col-sm-12">
    <label for="name" class="pb-2"> Whether work for poling stations, transmission lines, awarded
        <span class="error">*</span></label>
    <br>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="whether_awarded" value="A"
                @if(($generalData['award_of_work']['whether_awarded'] ?? '' )=='A' ) checked @endif checked> Yes
        </label>
    </div>
    <div class="form-check-inline">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="whether_awarded" value="B"
                @if(($generalData['award_of_work']['whether_awarded'] ?? '' )=='B' ) checked @endif> No
        </label>
    </div>
</div>
<div class="col-md-8 col-sm-12">
    <label>Details of material received at site for pooling stations and other work of Solar Park<span
            class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="pooling_stations" id="" cols="10"
        rows="2">{{$generalData['award_of_work']['pooling_stations'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('pooling_stations') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Status, progress made so far<span class="error">*</span><span class="text-primary"><small>(upto
                255 Characters)</small></span></label>
    <textarea name="aow_status" id="" cols="10"
        rows="2">{{$generalData['award_of_work']['aow_status'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('aow_status') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="work_award_remarks" id="" cols="10"
        rows="2">{{$generalData['award_of_work']['work_award_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('work_award_remarks') }}</span>
</div>