<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('telecommunication_facility','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Telecommunication Facilities</h5>
    <br>
    <div class="col-md-12 pb-4">
        <label>Details of telecommunication facilities<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="tele_facility_details" id="" cols="10" class="form-control"
            rows="3">{{$generalData['telecommunication_facilities']['tele_facility_details'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('tele_facility_details') }}</span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Status of tender and schedule for completion and progress made so far<span
                class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="tender_progress_status" id="" cols="10" class="form-control"
            rows="3">{{$generalData['telecommunication_facilities']['tender_progress_status'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('tender_progress_status') }}</span>
    </div>

    <div class="col-md-12 pb-4">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="telecomunication_remark" id="" cols="10" class="form-control"
            rows="3">{{$generalData['telecommunication_facilities']['telecomunication_remark'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('telecomunication_remark') }}</span>
    </div>
</div>