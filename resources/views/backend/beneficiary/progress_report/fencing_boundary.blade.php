<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('fencing','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Fencing/Boundary</h5>
    <br>

    <div class="col-md-12 pb-4">
        <label>Details of of fencing/boundary (including length)<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="fencing_details" id="" cols="10" rows="3" class="form-control"
            value="{{$generalData['fencing_boundary']['fencing_details'] ?? ''}}">{{$generalData['fencing_boundary']['fencing_details'] ?? ''}}</textarea>

    </div>
    <div class="col-md-12 pb-4">
        <label>Status of tender and schedule for completion for fencing/boundary<span class="text-danger">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="fencing_status" id="" cols="10" rows="3" class="form-control"
            value="{{$generalData['fencing_boundary']['fencing_status'] ?? ''}}">{{$generalData['fencing_boundary']['fencing_status'] ?? ''}}</textarea>
        <label for="" class="text-primary">Note: Please mention length, proposed system and progress made so
            far</label><br>
    </div>
    <div class="col-md-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="otherRemark" id="" cols="10" rows="3" class="form-control"
            value="{{$generalData['fencing_boundary']['otherRemark'] ?? ''}}">{{$generalData['fencing_boundary']['otherRemark'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('otherRemark') }}</span>
    </div>
</div>