<div>
    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                    500 Characters)</small></span></label>
        <textarea name="additional_information" id="" cols="10"
            rows="2">{{$generalData['additional_information'] ?? ''}}</textarea>
        <span class="text-danger">{{ $errors->first('additional_information') }}</span>
    </div>
</div>