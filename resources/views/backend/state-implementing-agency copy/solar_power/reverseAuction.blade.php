<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Reverse Auction</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('reverse_auction','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Date of RA/e-RA <span class="text-danger">*</span></label>
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
        <label>Awarded Capacity (MW)<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="reverseauction_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['reverseAuction']['reverseauction_capacity'] ?? ''}}">
        <span class="text-danger">{{ $errors->first('reverseauction_capacity') }}</span>
    </div>

</div>