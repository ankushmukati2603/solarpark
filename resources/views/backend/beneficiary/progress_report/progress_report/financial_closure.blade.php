<label class="headLebels">Financial Closure</label>
<br>
<div class="col-md-8 col-sm-12">
    <label>Details of Financial Closure of Solar Park (arrangement of 90% of fund of total park cost)<span
            class="error">*</span><span class="text-primary"><small>(upto
                1000 Characters)</small></span></label>
    <textarea name="financial_closure_details" id="" cols="10"
        rows="2">{{$generalData['financial_closure']['financial_closure_details'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('financial_closure_details') }}</span>
</div>
<div class="col-md-8 col-sm-12">
    <label>Issues/ Remarks<span class="req"></span><span class="text-primary"><small>(upto
                500 Characters)</small></span></label>
    <textarea name="financial_closure_remarks" id="" cols="10"
        rows="2">{{$generalData['financial_closure']['financial_closure_remarks'] ?? ''}}</textarea>
    <span class="text-danger">{{ $errors->first('financial_closure_remarks') }}</span>
</div>