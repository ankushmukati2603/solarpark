<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Tendered Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="tender_capacity" id="txttenderLatitude" class="form-control"
            value="{{$generalData['tender']['tender_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('tender_capacity') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of NIT<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_nit" placeholder="MM-DD-YYYY"
                name="nit_date" value="{{$generalData['tender']['nit_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('nit_date') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of RFS <span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="rfs_date" value="{{$generalData['tender']['rfs_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('rfs_date') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Date of Pre Bid Meeting<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="pre_bid_meeting_date"
                value="{{$generalData['tender']['pre_bid_meeting_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('pre_bid_meeting_date') }}</span>
    </div>


    <div class="col-md-4 col-sm-12">
        <label>Last date of Bid Submission<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="bid_submission_last_date"
                value="{{$generalData['tender']['bid_submission_last_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('bid_submission_last_date') }}</span>
    </div>
</div>