<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Project Type</label></h5>
    <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthSNAReportDetails('general','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Project Type
            <span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type_gm" value="1"
                @if(($generalData['project_type']['project_type_gm'] ?? '' )==1) checked @endif id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Ground Mounted
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('project_type') }}</span>

        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type_rt"
                @if(($generalData['project_type']['project_type_rt'] ?? '' )==2) checked @endif value="2"
                id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">
                Rooftop
            </label>
        </div>
        <span class="text-danger"> <br>{{ $errors->first('project_type') }}</span>

        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type" value="3"
                @if(($generalData['project_type']['project_type'] ?? '' )==3) checked @endif id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                other
            </label>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Type of Module
            <span class="text-danger">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="THIN"
                    @if(($generalData['project_type']['type_of_module'] ?? '' )=='THIN' ) checked @endif checked>
                Thin
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">

                <input type="radio" class="form-check-input" name="type_of_module" value="POLY"
                    @if(($generalData['project_type']['type_of_module'] ?? '' )=='POLY' ) checked @endif> Poly
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="MONO"
                    @if(($generalData['project_type']['type_of_module'] ?? '' )=='MONO' ) checked @endif> Mono
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="OTHER"
                    @if(($generalData['project_type']['type_of_module'] ?? '' )=='OTHER' ) checked @endif> Other
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('dpr_status') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-8">
        <label>Module Make<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
    </div>
    <div class="col-md-12" inline>
        <textarea name="module_remarks" id="" cols="30" class="form-control" rows="2"
            value="{{$generalData['project_type']['module_remarks'] ?? ''}}">{{$generalData['project_type']['module_remarks'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('module_remarks') }}</span>
    </div>

</div>