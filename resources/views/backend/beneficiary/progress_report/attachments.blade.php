@php $docBaseUrl =Auth::getDefaultDriver().'/preview-docs/'.Auth::id().'/'.$id.'/';
@endphp
<div id="home" class=" tab-pane active"><br>
    <!-- <div style="float: right;"><input type="checkbox" class="checkoption" value="general"
            onchange="getLastMonthReportData('attachments','{{$generalData["month"]}}','{{$generalData["year"]}}','{{$generalData["id"]}}')">
        Same
        as Previous Month
        <br>
    </div> -->
    <h5 class="pb-3">Attachments</h5>
    <br>



    <div class="col-md-12 pb-4">
        <label>Photo of site/land development and related activities, before and after completion of activities
            <span class="text-primary">(Please Select All Pictures At a time)</span><span
                class="text-danger">*</span></label>
        <input type="file" name="site_photo[]" id="site_photo"
            value="{{$generalData['attachments']['site_photo']['site_photo']  ?? ''}}" accept='image/jpeg ,image/png'
            multiple class="form-control">
        <span name="site_photo"></span>
        <span class="site_photo"></span>


        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['site_photo']))
        @php $i=0; @endphp
        @foreach($generalData['attachments']['site_photo'][$i] as $value)
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin:5px'><i
                class="fa-solid fa-image text-danger fa-2x"></i></a>
        @endforeach
        @endif
    </div>

    <div class="col-md-12 pb-4">
        <label>Photo of roads, water system, drainage system, before and after completion of activities <span
                class="text-primary">(Please
                Select All Pictures At a time)</span><span class="text-danger">*</span></label>
        <input type="file" name="road_photo[]" id="road_photo" accept='image/jpeg ,image/png' class="form-control"
            multiple>
        <span name="road_photo"></span>
        <span class="road_photo"></span>


        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['road_photo']))
        @php $j=0; @endphp
        @foreach($generalData['attachments']['road_photo'][$j] as $value)
        <!-- <a href="{{$value}}">View File |</a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin:5px'><i
                class="fa-solid fa-image text-danger fa-2x"></i></a>
        @endforeach
        @endif

    </div>

    <div class="col-md-12 pb-4">
        <label>Photo of internal power evacuation systems, pooling substations, lines or associated activates, before
            and after completion of activities <span class="text-primary">(Please
                Select All Pictures At a time)</span><span class="text-danger">*</span></label>
        <input type="file" name="ipes_photo[]" id="ipes_photo" accept='image/jpeg ,image/png' class="form-control"
            multiple>
        <span name="ipes_photo"></span>
        <span class="ipes_photo"></span>

        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['ipes_photo']))
        @php $l=0; @endphp
        @foreach($generalData['attachments']['ipes_photo'][$l] as $value)
        <!-- <a href="{{$value}}">View File |</a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin:5px'><i
                class="fa-solid fa-image text-danger fa-2x"></i></a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('ipes_photo') }}</span>
    </div>

    <div class="col-md-12 pb-4">
        <label>Photo of external transmission system, grid substations, lines or associated activates, before and
            after
            completion of activities <span class="text-primary">(Please
                Select All Pictures At a time)</span><span class="text-danger">*</span></label>
        <input type="file" name="exts_photo[]" id="exts_photo" accept='image/jpeg ,image/png' class="form-control"
            multiple>
        <span name="exts_photo"></span>
        <span class="exts_photo"></span>



        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['exts_photo']))
        @php $m=0; @endphp
        @foreach($generalData['attachments']['exts_photo'][$m] as $value)
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin:5px'><i
                class="fa-solid fa-image text-danger fa-2x"></i></a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('exts_photo') }}</span>
    </div>
    <div class="col-md-12 pb-4">
        <label>Photo of solar projects or associated activates, before and after completion of activities <span
                class="text-primary">(Please
                Select All Pictures At a time)</span><span class="text-danger">*</span></label>
        <input type="file" name="solar_project_photo[]" id="solar_project_photo" accept='image/jpeg ,image/png'
            class="form-control" multiple>
        <span name="solar_project_photo"></span>
        <span class="solar_project_photo"></span>



        <label for="" class="text-primary">Multiple pictures are allowed to upload only in PNG, JPEG format</label>
        @if(!empty($generalData['attachments']['solar_project_photo']))
        @php $n=0; @endphp
        @foreach($generalData['attachments']['solar_project_photo'][$n] as $value)
        <!-- <a href="{{$value}}">View File </a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin:5px'><i
                class="fa-solid fa-image text-danger fa-2x"></i></a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('solar_project_photo') }}</span>
    </div>
    <!-- added new -->


    <div class="col-md-12 pb-4">
        <label>Upload Additional Documents (If Any)<span class="text-primary">(Please upload documents duly signed and
                stamped by the approved head)</span></label>
        <input type="file" name="additional_documents[]" class="form-control" multiple>
        <span name="additional_documents"></span>
        <label for="" class="text-primary"></label>
        @if(!empty($generalData['attachments']['additional_documents']))
        @php $O=0; @endphp
        @foreach($generalData['attachments']['additional_documents'][$O] as $value)
        <!-- <a href="{{$value}}">View File </a> -->
        <a href="{{URL::to($docBaseUrl.$value)}}" target="_blank" style='margin: 5px;'>
            <i class="fa-solid fa-file text-danger fa-2x"></i></a>
        @endforeach
        @endif
        <span class="text-danger">{{ $errors->first('additional_documents') }}</span>
    </div>

    <!-- added new -->

</div>
<script>
$(document).ready(function() {
    $('#site_photo').change(function() {
        $('.site_photo').html('');
        var flg = true;
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            // if (files[i].type != 'image/png' || files[i].type != 'image/jpeg') {
            //     flg = false
            // }
            myarray = ['image/png', 'image/jpeg'];
            if (jQuery.inArray(files[i].type, myarray) === -1) {
                console.log("Not exists in array");
                flg = false;
            }
        }
        if (flg == false) {
            $('.site_photo').html('<span class="text-danger">Please upload valid files</span>');
            $('#site_photo').val('');
        }

    });
});

$(document).ready(function() {
    $('#road_photo').change(function() {
        $('.road_photo').html('');
        var flg = true;
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            // if (files[i].type != 'image/png' || files[i].type != 'image/jpeg') {
            //     flg = false
            // }
            myarray = ['image/png', 'image/jpeg'];
            if (jQuery.inArray(files[i].type, myarray) === -1) {
                console.log("Not exists in array");
                flg = false;
            }
        }
        if (flg == false) {
            $('.road_photo').html('<span class="text-danger">Please upload valid files</span>');
            $('#road_photo').val('');
        }

    });


});
$(document).ready(function() {
    $('#ipes_photo').change(function() {
        $('.ipes_photo').html('');
        var flg = true;
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            // if (files[i].type != 'image/png' || files[i].type != 'image/jpeg') {
            //     flg = false
            // }
            myarray = ['image/png', 'image/jpeg'];
            if (jQuery.inArray(files[i].type, myarray) === -1) {
                console.log("Not exists in array");
                flg = false;
            }
        }
        if (flg == false) {
            $('.ipes_photo').html('<span class="text-danger">Please upload valid files</span>');
            $('#ipes_photo').val('');
        }

    });


});

$(document).ready(function() {
    $('#exts_photo').change(function() {
        $('.exts_photo').html('');
        var flg = true;
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            // if (files[i].type != 'image/png' || files[i].type != 'image/jpeg') {
            //     flg = false
            // }
            myarray = ['image/png', 'image/jpeg'];
            if (jQuery.inArray(files[i].type, myarray) === -1) {
                console.log("Not exists in array");
                flg = false;
            }
        }
        if (flg == false) {
            $('.exts_photo').html('<span class="text-danger">Please upload valid files</span>');
            $('#exts_photo').val('');
        }

    });


});

$(document).ready(function() {
    $('#solar_project_photo').change(function() {
        $('.solar_project_photo').html('');
        var flg = true;
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            // if (files[i].type != 'image/png' || files[i].type != 'image/jpeg') {
            //     flg = false
            // }
            myarray = ['image/png', 'image/jpeg'];
            if (jQuery.inArray(files[i].type, myarray) === -1) {
                console.log("Not exists in array");
                flg = false;
            }
        }
        if (flg == false) {
            $('.solar_project_photo').html(
                '<span class="text-danger">Please upload valid files</span>');
            $('#solar_project_photo').val('');
        }

    });


});
</script>