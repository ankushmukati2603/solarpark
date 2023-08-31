<p>Dear {{$installer}},</p>
<p>{{$agency}} has provided comments for the system registration details submitted by you for <b>{{$system_code}}</b>. Following are the details:</p>
<p>
    <b>Review:</b> {{$review}}<br>
    @if(count($docs))
    <b>Documents that need to be corrected:</b><br>
        @foreach($docs as $key => $doc)
            <span style="margin-left: 10px;">{{Config::get('constants.documentCodes')[$doc]}}</span><br>
        @endforeach
    @endif
</p>
<br>
<span style="font-size: 10px; color: #666666;">This is an auto-generated email. Please do not reply to this email.</span>