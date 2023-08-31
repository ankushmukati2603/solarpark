@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<label class="headLebels">Additional Information</label>
<br>

<div class="col-md-6 col-sm-12">
    <label>Upload PDF File<span class="error">*</span> (<small for="" class="text-primary">Upload only in PDF format
            </samll>)</label>
    <input type="file" name="undertaking">

</div>
<div class="col-md-6 col-sm-12 text-danger">
    <ul>
        <li>Please click on link <a href="{{URL::to('/'.Auth::getDefaultDriver().'/pdf-preview/'.$id)}}">Download
                Application</a> to download filled application</li>
        <li>Please authorized the application by signed on it and upload scan copy</li>
    </ul>

</div>
<div class="clearfix"></div>
<div class="col-md-12">
    <input type="checkbox" id="" name="authorize" value="1" @if(($generalData['final_submission']['authorize'] ?? ''
        )==1)checked @endif>
    <label for="vehicle1"> I authorize that entered information in proposal are
        correct and verified</label> <br>
    <span class="text-danger">{{ $errors->first('authorize') }}</span>
</div>