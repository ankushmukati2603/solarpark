<div id="home" class=" tab-pane active">
    <h5> <label class="headLebels">Additional information</label></h5>
    <div class="row pb-3">
        <div class="col-md-4 col-sm-12 mb-4">
            <label>Issues/ Remarks<span class="text-danger">*</span></label>
            <textarea name="additional_information" id=""
                class="form-control">{{$generalData['additional_information'] ?? ''}}</textarea>
            <span class="text-primary"><small>(upto 500 Characters)</small></span>
        </div>
    </div>
</div>