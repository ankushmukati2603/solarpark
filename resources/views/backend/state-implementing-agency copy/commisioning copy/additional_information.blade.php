@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<label class="headLebels">Additional Information</label>
<br>

<div class="col-md-8 col-sm-12">
    <label>Any issue of SPPD/SPD/STU/CTU which you want to highlight in MNRE/SECI, please upload a brief<span
            class="error">*</span></label>
    <input type="file" name="other_documents">
    @if($generalData['additional_information']!='')

    <a href=" {{URL::to($docBaseUrl.$generalData['additional_information'])}}" target="_blank"
        style='float: right;'>View File</a>

    @endif
    <label for="" class="text-primary">Upload only in PDF format</label><br>
    <span class="text-danger">{{ $errors->first('other_documents') }}</span>

</div>