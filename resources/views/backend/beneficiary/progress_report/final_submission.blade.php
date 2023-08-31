@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<div id="home" class=" tab-pane active"><br>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('final_submission','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same as Previous Month
        <br>
    </div>
    <h5 class="pb-3">Final Submission</h5>
    <br>
    <div class="row col-md-12">
        <div class="col-md-6 pb-4">
            <label>Upload PDF File for Undertaking<span class="text-danger">*</span> (<small class="text-primary">Upload
                    only in PDF format </small>)</label>
            <input type="file" name="undertaking" class="form-control" />
        </div>
    </div>
    <!-- added new -->
    <div class="col-sm-12 row">
        <div class="col-md-6 col-sm-12">
            <label>Upload PDF File For Detailed Project Report<span class="text-danger">*</span> (<small
                    class="text-primary">Upload only in PDF format </small>)</label>
            <input type="file" name="project_report_detail" class="form-control" />
        </div>
        <div class="col-md-6 col-sm-12">
            <label>Upload PDF File For Detailed Statement of Expenditure Ocurred in the Development of Solar<span
                    class="text-danger">*</span> (<small for="" class="text-primary">Upload only in PDF format
                </small>)</label>
            <input type="file" name="expenditure_statement" class="form-control" />
        </div>
    </div>
    <div class="clearfix"><br><br></div>
    <div class="col-md-12 pb-4">
        <input type="checkbox" id="" name="authorize" value="1">
        <label for="vehicle1"> I authorize that entered information in proposal are correct and verified</label> <br>
    </div>
</div>