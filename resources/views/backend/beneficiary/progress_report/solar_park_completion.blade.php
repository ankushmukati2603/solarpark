@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('solarpark_completion','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Solar park Completion</h5>
    <br>
    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label for="name" class="pb-2">Whether the internal infrastructure of park development activities are
            completed<span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="developement_activities" value="A"
                    @if(($generalData['solar_park_completion']['developement_activities'] ?? '' )=='A' ) checked @endif
                    checked> Yes
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="developement_activities" value="B"
                    @if(($generalData['solar_park_completion']['developement_activities'] ?? '' )=='B' ) checked @endif>
                No
            </label>
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 pb-4">
        <label>Date of Approval <span class="text-danger">*</span></label>
        <div class="input-group date">
            <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                placeholder="MM-DD-YYYY" name="date_inprincuple_approval"
                value="{{$generalData['solar_park_completion']['date_inprincuple_approval'] ?? ''}}">
        </div>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12 pb-4">
        <label>Details of material received at site for pooling stations and other work of Solar Park<span
                class="text-danger">*</span><span class="text-primary"><small>(upto
                    1000 Characters)</small></span></label>
        <textarea name="solarPark_work_details" id="" cols="10" class="form-control"
            rows="3">{{$generalData['solar_park_completion']['solarPark_work_details'] ?? ''}}</textarea>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-12 pb-4">
        <label>Upload document<span class="text-primary"></span><span class="text-danger">*</span> (<small for=""
                class="text-primary">Upload only in
                kml and csv
                format </small>)</label>
        <input type="file" name="upload_file" class="form-control" multiple>
        <span name="upload_file"></span>
        @if($generalData['solar_park_completion']!='')

        <a href=" {{URL::to($docBaseUrl.$generalData['solar_park_completion']['upload_file'])}}" target="_blank"
            style='float: right;'>View
            File</a>

        @endif

    </div>

    <div class="col-md-12 pb-4">
        <label>Delay (if any) along with reason<span class="text-danger">*</span><span class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea name="SPC_delay" id="" cols="10" class="form-control"
            rows="3">{{$generalData['solar_park_completion']['SPC_delay'] ?? ''}}</textarea>
    </div><br>
    <div class="col-md-12 pb-4">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="SPC_remarks" id="" cols="10" class="form-control"
            rows="3">{{$generalData['solar_park_completion']['SPC_remarks'] ?? ''}}</textarea>
    </div>
</div>