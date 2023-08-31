<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('water_facility','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Water Facilities</h5>
    <br>
    <div class="row col-md-12">
        <div class="col-md-6">
            <label>Source of water for park<span class="text-danger">*</span></label>
            <input type="text" name="source_water" id="txtName" class="form-control"
                value="{{($generalData['water_facilities']['source_water'] ?? '')}}">
        </div>
        <div class="clearfix"><br></div>
        <div class="col-md-6 pb-4">
            <label>Details of water requirements<span class="text-danger">*</span><span
                    class="text-primary"><small>(upto
                        1000 Characters)</small></span></label>
            <textarea name="required_water" id="" cols="10" class="form-control"
                rows="5">{{($generalData['water_facilities']['required_water'] ?? '')}}</textarea>
        </div>
        <div class="col-md-6 pb-4">
            <label>Proposed system and progress made so far<span class="text-danger">*</span> <span
                    class="text-primary"><small>(upto
                        255 Characters)</small></span></label>
            <textarea name="proposed_system" id="" cols="10" class="form-control"
                rows="5">{{($generalData['water_facilities']['proposed_system'] ?? '')}}</textarea>
        </div>
        <div class="col-md-6">
            <label>
                Status of tender and schedule for completion of Water Facilities<span class="text-danger">*</span><span
                    class="text-primary"><small>(upto
                        255 Characters)</small></span></label>
            <textarea name="status" id="" cols="10" class="form-control"
                rows="5">{{($generalData['water_facilities']['status'] ?? '')}}</textarea>
        </div>
        <div class="col-md-6">
            <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                        500 Characters)</small></span></label>
            <textarea name="water_facility_remarks" id="" cols="10" class="form-control"
                rows="5">{{($generalData['water_facilities']['water_facility_remarks'] ?? '')}}</textarea>
        </div>
    </div>

</div>