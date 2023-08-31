@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<div>
    <label class="headLebels">Attachments</label>
    <br>
    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Photo of site/land development and related activities, before and after completion of activities
            <span class="text-primary">(Please Select All Pictures At a time)</span><span class="error">*</span></label>
        <input type="file" name="site_photo[]"
            value="{{$generalData['attachments']['site_photo']['site_photo']  ?? ''}}" accept='image/jpeg ,image/png'
            multiple>
        <span name="site_photo"></span>
        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['site_photo']))
        @php $i=0; @endphp
        @foreach($generalData['attachments']['site_photo'][$i] as $value)
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('site_photo') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Photo of roads, water system, drainage system, before and after completion of activities <span
                class="text-primary">(Please
                Select All Pictures At a time)</span><span class="error">*</span></label>
        <input type="file" name="road_photo[]" accept='image/jpeg ,image/png' multiple>
        <span name="road_photo"></span>
        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['road_photo']))
        @php $j=0; @endphp
        @foreach($generalData['attachments']['road_photo'][$j] as $value)
        <!-- <a href="{{$value}}">View File |</a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('road_photo') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Photo of internal power evacuation systems, pooling substations, lines or associated activates, before
            and after completion of activities <span class="text-primary">(Please
                Select All Pictures At a time)</span><span class="error">*</span></label>
        <input type="file" name="ipes_photo[]" accept='image/jpeg ,image/png' multiple>
        <span name="ipes_photo"></span>
        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['ipes_photo']))
        @php $l=0; @endphp
        @foreach($generalData['attachments']['ipes_photo'][$l] as $value)
        <!-- <a href="{{$value}}">View File |</a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('ipes_photo') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Photo of external transmission system, grid substations, lines or associated activates, before and after
            completion of activities <span class="text-primary">(Please
                Select All Pictures At a time)</span><span class="error">*</span></label>
        <input type="file" name="exts_photo[]" accept='image/jpeg ,image/png' multiple>
        <span name="exts_photo"></span>
        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['exts_photo']))
        @php $m=0; @endphp
        @foreach($generalData['attachments']['exts_photo'][$m] as $value)
        <!-- <a href="{{$value}}">View File |</a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('exts_photo') }}</span>
    </div>

    <div class="clearfix"></div><br>
    <div class="col-md-8 col-sm-12">
        <label>Photo of solar projects or associated activates, before and after completion of activities <span
                class="text-primary">(Please
                Select All Pictures At a time)</span><span class="error">*</span></label>
        <input type="file" name="solar_project_photo[]" accept='image/jpeg ,image/png' multiple>
        <span name="solar_project_photo"></span>
        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['solar_project_photo']))
        @php $n=0; @endphp
        @foreach($generalData['attachments']['solar_project_photo'][$n] as $value)
        <!-- <a href="{{$value}}">View File </a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='float: right;'>View File</a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('solar_project_photo') }}</span>
    </div>
</div>