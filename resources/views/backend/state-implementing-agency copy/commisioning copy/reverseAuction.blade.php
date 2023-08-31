<div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Date of RA/e-RA <span class="error">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="ra_e_ra_date"
                value="{{$generalData['reverseAuction']['ra_e_ra_date'] ?? ''}}">
        </div>
        <span class="text-danger">{{ $errors->first('ra_e_ra_date') }}</span>
    </div>


    <div class="col-md-4 col-sm-12">
        <label>Tendered Capacity (MW)<span class="error">*</span></label>
        <input type="number" step="any" min="0" name="reverseauction_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['reverseAuction']['reverseauction_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('reverseauction_capacity') }}</span>
    </div>

</div>