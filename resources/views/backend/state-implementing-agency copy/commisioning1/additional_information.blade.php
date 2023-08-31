@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<label class="headLebels">Additional Information</label>
<br>
<div style="float: right;"><input type="checkbox" class="checkoption" value="general"
        onchange="getLastMonthReportData('additional_information','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
    Same
    as Previous Month
    <br>
</div>
<div class="col-md-8 col-sm-12">
    <label>Any issue of SPPD/SPD/STU/CTU which you want to highlight in MNRE/SECI, please upload a brief<span
            class="error">*</span></label>
    <input type="file" name="other_documents" class="form-control">
    @if($generalData['additional_information']!='')

    <a href=" {{URL::to($docBaseUrl.$generalData['additional_information'])}}" target="_blank"
        style='float: right;'>View File</a>

    @endif
    <label for="" class="text-primary">Upload only in PDF format</label><br>
    <span class="text-danger">{{ $errors->first('other_documents') }}</span>

</div>