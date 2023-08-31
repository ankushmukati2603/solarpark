<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Additional information</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('additional_information','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same as Previous Month
        <br>
    </div>
    <div class="col-md-8 col-sm-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="additional_information" id="" cols="10" class="form-control"
            rows="3">{{$generalData['additional_information'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('additional_information') }}</span>
    </div>
</div>