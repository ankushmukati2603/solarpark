@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<div id="home" class=" tab-pane active"><br>
    <!-- <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('final_submission','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div> -->
    <h5 class="pb-3">Final Submission</h5>
    <br>

    <div class="row col-md-12">
        <div class="col-md-6 pb-4">
            <label>Upload PDF File<span class="text-danger">*</span> (<small for="" class="text-primary">Upload only in
                    PDF
                    format </small>)</label>
            <input type="file" name="undertaking" class="form-control" />
            @if($generalData['undertaking']!='')

            <a href=" {{URL::to($docBaseUrl.$generalData['undertaking'])}}" target="_blank" style='float: right;'>View
                File</a>

            @endif

        </div>
        <!-- <div class="col-md-6 pb-4">
            <ul>
                <li>Please click on link <a href="{{URL::to('/'.Auth::getDefaultDriver().'/pdf-preview/'.$id)}}"
                        class="text-primary">
                        Download
                        Application </a>to download filled application</li>
                <li>Please authorized the application by signed on it and upload scan copy</li>
            </ul>

        </div> -->
    </div>
    <!-- added new -->
    <div class="col-sm-12">
        <div class="col-md-12 col-sm-12">
            <label>Detailed Project Report<span class="text-danger">*</span></label>
            <textarea name="project_report_detail" id="" class="form-control " cols="10"
                rows="4">{{$generalData['project_report_detail'] ?? 'NA'}}</textarea>
            <!-- <input type="text" name="concerned_person_name" id="txtName" class="form-control "
                value="{{$generalData['general']['concerned_person_name'] ?? ''}}"> -->
            <span class="text-danger">{{ $errors->first('project_report_detail') }}</span>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>Detailed Statement of Expenditure Ocurred in the Development of Solar<span
                    class="text-danger">*</span></label>
            <textarea name="expenditure_statement" id="" cols="10" rows="4"
                class="form-control">{{$generalData['expenditure_statement'] ?? 'NA'}}</textarea>
            <!-- <input type="text" name="concerned_person_name" id="txtName" class="form-control "
                value="{{$generalData['general']['concerned_person_name'] ?? ''}}"> -->
            <span class="text-danger">{{ $errors->first('expenditure_statement') }}</span>
        </div>
    </div>

    <!-- added new -->

    <div class="clearfix"><br><br></div>
    <div class="col-md-12 pb-4">
        <input type="checkbox" id="" name="authorize" value="1" @if(($generalData['final_submission']['authorize'] ?? ''
            )==1)checked @endif>
        <label for="vehicle1"> I authorize that entered information in proposal are
            correct and verified</label> <br>
        <span class="text-danger">{{ $errors->first('authorize') }}</span>
    </div>
</div>