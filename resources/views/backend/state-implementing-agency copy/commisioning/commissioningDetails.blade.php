<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Commissioning Details </label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('project_location','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div><br>

    <div class="col-md-4 col-sm-12">
        <label>Commissioned AC Capacity (MW) <span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="commissioned_ac_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['commissioning']['commissioned_ac_capacity'] ?? ''}}">
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Commissioned DC Capacity (MWp)<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="commissioned_dc_capacity" id="txtgeneralLatitude"
            class="form-control" value="{{$generalData['commissioning']['commissioned_dc_capacity'] ?? ''}}">
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Date of Commissioning<span class="text-danger">*</span></label>
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="commissioning_date"
                value="{{$generalData['commissioning']['commissioning_date'] ?? ''}}">
        </div>
    </div>

</div>