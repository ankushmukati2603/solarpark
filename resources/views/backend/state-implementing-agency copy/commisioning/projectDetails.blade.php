<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Project Details</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div><br>
    <div class="col-md-4 col-sm-12">
        <label>Name of DISCOM<span class="text-danger">*</span></label>
        <input type="text" placeholder="Name" name="discom_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['project_details']['discom_name'] ?? ''}}">
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Substation Name<span class="text-danger">*</span></label>
        <input type="text" placeholder="Name" name="substation_name" id="txtgeneralLatitude"
            class="form-control  number" value="{{$generalData['project_details']['substation_name'] ?? ''}}">
    </div>
    <div class="col-md-4 col-sm-12">
        <label>Substation Voltage Level<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="substation_voltage_level" id="txtgeneralLongitude"
            placeholder="00.00" class="form-control  number"
            value="{{$generalData['project_details']['substation_voltage_level'] ?? ''}}">
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Feeder Name<span class="text-danger">*</span></label>
        <input type="text" placeholder="Name" name="feeder_name" id="txtgeneralLatitude" class="form-control  number"
            value="{{$generalData['project_details']['feeder_name'] ?? ''}}">
    </div>

    <div class="col-md-4 col-sm-12">
        <label>Feeder Voltage<span class="text-danger">*</span></label>
        <input type="number" step="any" min="0" name="feeder_voltage" id="txtgeneralLongitude" placeholder="00.00"
            class="form-control  number" value="{{$generalData['project_details']['feeder_voltage'] ?? ''}}">
    </div>

</div>