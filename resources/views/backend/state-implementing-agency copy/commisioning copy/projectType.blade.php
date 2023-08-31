<div>
    <div class="clearfix"></div><br>

    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Project Type
            <span class="error">*</span></label>
        <br>
        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type" value="1"
                @if(($generalData['internal_infrastructure']['project_type'] ?? '' )==1) checked @endif
                id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Ground Mounted
            </label>
        </div>
        <span class="text-danger">{{ $errors->first('project_type') }}</span>

        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type"
                @if(($generalData['internal_infrastructure']['project_type'] ?? '' )==2) checked @endif value="2"
                id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">
                Rooftop
            </label>
        </div>
        <span class="text-danger"> <br>{{ $errors->first('project_type') }}</span>

        <div class="form-check-inline">
            <input class="form-check-input" type="checkbox" name="project_type" value="3"
                @if(($generalData['internal_infrastructure']['project_type'] ?? '' )==3) checked @endif
                id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                other
            </label>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Type of Module
            <span class="error">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="A"
                    @if(($generalData['internal_infrastructure']['type_of_module'] ?? '' )=='A' ) checked @endif
                    checked>
                Thin
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">

                <input type="radio" class="form-check-input" name="type_of_module" value="B"
                    @if(($generalData['internal_infrastructure']['type_of_module'] ?? '' )=='B' ) checked @endif> Poly
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="C"
                    @if(($generalData['internal_infrastructure']['type_of_module'] ?? '' )=='C' ) checked @endif> Mono
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="type_of_module" value="D"
                    @if(($generalData['internal_infrastructure']['type_of_module'] ?? '' )=='D' ) checked @endif> Other
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
        <textarea name="module_remarks" id="" cols="30" class="form-control"
            rows="2">{{$generalData['module_remarks']['module_remarks'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('module_remarks') }}</span>
    </div>

</div>