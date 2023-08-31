<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('drainage_facility','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Drainage System</h5>
    <br>
    <div class="col-md-12 pb-4">
        <label>Details of proposed drainage system (including length in km)<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="drainage_system_details" id="" cols="10" class="form-control"
            rows="3">{{($generalData['drainage_system']['drainage_system_details'] ?? '')}}</textarea>

    </div>
    <div class="col-md-12 pb-4">
        <label>Status of tender & schedule for completion of the drainage system & progress made so far
            (including length in km)<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="tender_status" id="" cols="10" class="form-control"
            rows="3">{{($generalData['drainage_system']['tender_status'] ?? '')}}</textarea>

    </div>
    <div class="col-md-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="otherRemarks" id="" cols="10" class="form-control"
            rows="3">{{($generalData['drainage_system']['otherRemarks'] ?? '')}}</textarea>
    </div>
</div>