<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Company Name<span class="error">*</span></label>
        <input type="text" placeholder="Name" name="company_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['selectedBidders']['company_name'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('company_name') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="select_bidders_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['selectedBidders']['select_bidders_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('select_bidders_capacity') }}</span>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of LoI/LoA<span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="loi_loa_date"
                value="{{$generalData['selectedBidders']['loi_loa_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
    </div>
</div>