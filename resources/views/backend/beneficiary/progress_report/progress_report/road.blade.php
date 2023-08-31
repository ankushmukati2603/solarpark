<div>
    <label class="headLebels">Road Infrastructure Details</label>
    <br>
    <div class="col-sm-12">
        <label for="name" class="pb-2"> Approach road to the park Status of Road
            <span class="error">*</span></label>
        <br>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="road_status" value="A"
                    @if(($generalData['road']['road_status'] ?? '' )=='A' ) checked @endif checked> Already available
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="road_status" value="B"
                    @if(($generalData['road']['road_status'] ?? '' )=='B' ) checked @endif>New road to be developed
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="road_status" value="C"
                    @if(($generalData['road']['road_status'] ?? '' )=='C' ) checked @endif>Only rework/modification of
                road
            </label>
        </div>
        <span class="text-danger"><br>{{ $errors->first('road_status') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Length of approach road up to the park boundary (in km) <span class="error">*</span></label>
        <input type="number" min="0" name="park_boundary" id="txtContact" class="form-control  number"
            value="{{($generalData['road']['park_boundary'] ?? '' )}}">
        <span class="text-danger">{{ $errors->first('park_boundary') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Length of access road to each plot inside the park (in km)<span class="error">*</span></label>
        <input type="number" min="0" name="road_distance" id="txtContact" class="form-control  number"
            value="{{($generalData['road']['road_distance'] ?? '' )}}">
        <span class="text-danger">{{ $errors->first('road_distance') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Status of tender and schedule for completion of road work<span class="error">*</span><span
                class="text-primary"><small>(upto
                    255 Characters)</small></span></label>
        <textarea type="text" name="work_status" id="" cols="10" rows="2"
            value="{{($generalData['road']['work_status'] ?? '' )}}">{{($generalData['road']['work_status'] ?? '' )}}</textarea>
        <span class="text-danger">{{ $errors->first('work_status') }}</span>
    </div>
    <div class="clearfix"></div><br>
    <div class="col-md-4 col-sm-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="road_remarks" id="" cols="10" rows="2"
            value="{{($generalData['road']['road_remarks'] ?? '' )}}">{{($generalData['road']['road_remarks'] ?? '' )}}</textarea>
        <span class="text-danger">{{ $errors->first('road_remarks') }}</span>
    </div>
</div>