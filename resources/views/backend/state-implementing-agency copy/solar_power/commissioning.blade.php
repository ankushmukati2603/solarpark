<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Commissioning</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('commissioning','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month

    </div>
    <br><br>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <label>Scheduled Date of Commissioning as per PPA<span class="text-danger">*</span></label>
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
        <div class="col-md-6 col-sm-12">
            <label>Capacity Commissioned after scheduled date of Commissioning (MW)<span
                    class="text-danger">*</span></label>
            <input type="number" step="any" class="form-control" id="txtdate_commissioning" placeholder=""
                name="date_inprincuple_approval"
                value="{{$generalData['commissioning']['date_inprincuple_approval'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('date_inprincuple_approval') }}</span>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6 col-sm-12">
            <label>Extended/Actual Date of Commissioning<span class="text-danger">*</span></label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                    placeholder="MM-DD-YYYY" name="extended_date"
                    value="{{$generalData['commissioning']['extended_date'] ?? ''}}">
            </div>
            <span class="text-danger">{{ $errors->first('extended_date') }}</span>
        </div><br>
        <div class="col-md-6 col-sm-12">
            <label>Capacity Commissioned as per scheduled date of Commissioning (MW) <span
                    class="text-danger">*</span></label>
            <input type="number" step="any" class="form-control" id="txtdate_commissioning" placeholder=""
                name="capacity_commissioned_date"
                value="{{$generalData['commissioning']['capacity_commissioned_date'] ?? ''}}">
            <span class="text-danger">{{ $errors->first('capacity_commissioned_date') }}</span>
        </div>
    </div>
    <br>



</div>