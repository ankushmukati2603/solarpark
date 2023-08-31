<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Scheduled Date of Commissioning as per PPA<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="scheduled_date"
                value="{{$generalData['commissioning']['scheduled_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('scheduled_date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Extended/Actual Date of Commissioning<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="extended_date"
                value="{{$generalData['commissioning']['extended_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('extended_date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Capacity Commissioned as per scheduled date of Commissioning (MW) <span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="capacity_commissioned_date"
                value="{{$generalData['commissioning']['capacity_commissioned_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('capacity_commissioned_date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Capacity Commissioned after scheduled date of Commissioning (MW)<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="date_inprincuple_approval"
                value="{{$generalData['commissioning']['date_inprincuple_approval'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('date_inprincuple_approval') }}</span>
    </div>

</div>