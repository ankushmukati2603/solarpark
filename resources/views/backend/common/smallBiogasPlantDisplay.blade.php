@extends('layouts.masters.backend')
@section('content')
@section('title', ' Proposal for Small Biogas Plants (1 M^3 to 25 M^3)')

<div class="col-md-12">
     @include('layouts.partials.backend._flash')
    <div class="frontPagesBox">
        <div class="box box-primary">

            <div class="box-body">
                 <form action="{{url('mnre/add-remarks')}}" method="post">
                         @csrf
                         <input type="hidden" name="small_plant_id" value="{{$consumer->id}}">
                <table class="table table-bordered">
                    <tr>
                        <td width="20%">Name </td>
                        <th width="30%">{{$consumer['name'] ?? ''}} <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="name" value="Please enter correct information for name"> @elseif($consumer_log && $consumer_log->name==1)<input type="checkbox" checked name="name" value="Please enter correct information for name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        <td width="20%">Contact Number</td>
                        <th width="30%">{{$consumer['phone'] ?? ''}} <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox"  name="phone" value="Please enter correct contact number"> @elseif($consumer_log && $consumer_log->phone==1)<input type="checkbox" checked name="phone" value="Please enter correct contact number">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <th>{{$consumer['email'] ?? ''}} <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox"  name="email" value="Please enter correct email"> @elseif($consumer_log && $consumer_log->email==1)<input type="checkbox" checked value="Please enter correct email">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span></th>
                        <td>Category</td>
                        <th>
                            @if($consumer->category == 'gen')
                            <span>General</span>
                            @elseif(($consumer->category == 'sc'))
                            <span>SC</span>
                            @elseif(($consumer->category == 'st'))
                            <span>ST</span>
                            @else
                            <span>Not Defined</span>
                            @endif
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox"  name="category" value="Please enter correct category"> @elseif($consumer_log && $consumer_log->category==1)<input type="checkbox" checked name="category" value="Please enter correct category">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                          
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">Address Details
                            <hr>
                        </th>
                    </tr>

                    <tr>
                        <td>State</td>
                        <th>
                           <span class="approved_reject1"></span><span class="papproved"> {{$consumer['state_name'] ?? ''}}  @if(!$consumer_log) <input type="checkbox"  name="state_id" value="Please select correct state"> @elseif($consumer_log && $consumer_log->state_id==1)<input type="checkbox" checked name="state_id" value="Please select correct state">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif  </span>
                        </th>

                        <td>District</td>
                        <th>{{$consumer['district_name'] ?? ''}} 
                          <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox"  name="district_id" value="Please select correct dostrict name"> @elseif($consumer_log && $consumer_log->district_id==1)<input type="checkbox" checked name="district_id" value="Please select correct dostrict name">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                    </tr>

                    <tr>
                        <td>Sub District</td>
                        <th>{{$consumer['sub_districts_name'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox" name="sub_district_id" value="Please select correct sub dostrict name"> @elseif($consumer_log && $consumer_log->sub_district_id==1)<input type="checkbox" checked name="sub_district_id">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                     
                     </th>
                        <td>Block</td>
                        <th>{{$consumer['blocks_name'] ?? ''}} 
                          <span class="approved_reject1"></span><span class="papproved">   @if(!$consumer_log) <input type="checkbox" name="block" value="Please select correct block name"> @elseif($consumer_log && $consumer_log->block==1)<input type="checkbox" checked vvalue="Please select correct block name">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            
                        </th>
                    </tr>
                    <tr>
                        <td>Village</td>
                        <th>{{$consumer['village_name'] ?? ''}}
                             <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox"  name="village" value="Please enter correct village name"> @elseif($consumer_log && $consumer_log->village==1)<input type="checkbox" checked name="village">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                        
                     </th>
                        <td>Localbody Type</td>
                        <th>
                            @if($consumer->localbody_type == '2')
                            <span>Urban</span>
                            @else
                            <span>Rural</span>
                            @endif
                          <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox"  name="localbody_type" value="Please enter correct localbody type"> @elseif($consumer_log && $consumer_log->localbody_type==1)<input type="checkbox" checked name="localbody_type" value="Please enter correct localbody type">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>                            
                        </th>
                    </tr>
                    <tr>
                        <td>Panchayat</td>
                        <th>{{$consumer['localbody_name'] ?? ''}} 
                          <span class="approved_reject1"></span><span class="papproved">   @if(!$consumer_log) <input type="checkbox" name="panchayat" value="Please enter correct Panchayat"> @elseif($consumer_log && $consumer_log->panchayat==1)<input type="checkbox" checked name="panchayat" value="Please enter correct Panchayat"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                           </th>
                        <td>Ward No.</td>
                        <th>{{$consumer['ward_name'] ?? ''}} 
                           <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox" name="ward_no"  value="Please enter correct ward name"> @elseif($consumer_log && $consumer_log->ward_no==1)<input type="checkbox" checked name="ward_no" value="Please enter correct ward name">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                           </th>
                    </tr>
                    <tr>
                        <td>Post office</td>
                        <th>{{$consumer['post'] ?? ''}} 
                           <span class="approved_reject1"></span><span class="papproved"> @if(!$consumer_log) <input type="checkbox" name="post" value="Please enter correct post office"> @elseif($consumer_log && $consumer_log->post==1)<input type="checkbox" checked name="post" value="Please enter correct post office">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                           </th>
                        <td>House No.</td>
                        <th>{{$consumer['house_no'] ?? ''}} 
                            <span class="approved_reject1"></span><span class="papproved"> @if(!$consumer_log) <input type="checkbox" name="house_no" value="Please enter correct house no"> @elseif($consumer_log && $consumer_log->house_no==1)<input type="checkbox" checked name="house_no" value="Please enter correct house no">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="4">Other Details
                            <hr>
                        </th>
                    </tr>

                    <tr>
                        <td>Do you require toilet linked biogas plants?</td>
                        <th>
                            @if($consumer->toilet_linked == '1')
                            <span>yes</span>
                            @else
                            <span>No</span>
                            @endif
                          <span class="approved_reject1"></span><span class="papproved"> @if(!$consumer_log) <input type="checkbox" name="toilet_linked" value="Please enter correct toilet link"> @elseif($consumer_log && $consumer_log->toilet_linked==1)<input type="checkbox" checked name="toilet_linked">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                           
                        </th>
                        <td>Do you already have a biogas plant installed?</td>
                        <th>
                            @if($consumer->existing_biogas_plant == '1')
                            <span>yes</span>
                            @else
                            <span>No</span>
                            @endif

                         <span class="approved_reject1"></span><span class="papproved">  @if(!$consumer_log) <input type="checkbox" name="existing_biogas_plant" value="Please enter correct existing biogas plant"> @elseif($consumer_log && $consumer_log->existing_biogas_plant==1)<input type="checkbox" checked name="existing_biogas_plant" value="Please enter correct existing biogas plant">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                        </th>
                    </tr>

                    <tr>
                        <td>Do you require biogas slurry filter unit?</td>
                        <th>
                            @if($consumer->slurry_filter_unit == '1')
                            <span>yes</span>
                            @else
                            <span>No</span>
                            @endif
                           <span class="approved_reject1"></span><span class="papproved"> @if(!$consumer_log) <input type="checkbox" name="slurry_filter_unit" value="Please enter correct slurry filter unit"> @elseif($consumer_log && $consumer_log->slurry_filter_unit==1)<input type="checkbox" checked name="slurry_filter_unit" value="Please enter correct slurry filter unit"">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif  </span>
                           
                        </th>
                        <td>Number of cattle available</td>
                        <th>@if($consumer->cattle_available ==1) <span>Yes</span>@endif 
                           <span class="approved_reject1"></span><span class="papproved"> @if(!$consumer_log) <input type="checkbox" name="cattle_available" value="Please enter correct cattle availability"> @elseif($consumer_log && $consumer_log->slurry_fcattle_availableilter_unit==1)<input type="checkbox" checked name="cattle_available" value="Please enter correct cattle availability">  @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @else &nbsp; @endif  </span>
                       
                            @if($consumer->cattle_available == '1')
                            <span>Big Buffaloe: {{$consumer['number_of_cattles']['BuffaloesBig'] ?? ''}} <br>
                                Small Buffaloe: {{$consumer['number_of_cattles']['BuffaloesSmall'] ?? ''}}<br>
                                Big Cow: {{$consumer['number_of_cattles']['CowsBig'] ?? ''}}<br>
                                Small Cow: {{$consumer['number_of_cattles']['CowsSmall'] ?? ''}}</span>
                            @endif
                        </th>
                    </tr>
                   
                     <tr>
                        <td>Status</td>
                        <th colspan="3">
                            @if($consumer->status==0 || $consumer->status==2)
                            <input type="radio" name="status" class="status" id="approved" @if($consumer->status==1) checked @endif value='1'> Verified
                            <input type="radio" style="margin-left: 30px;" name="status" class="status" id="partial_approved" @if($consumer->status==2) checked @endif value='2'> Send Back For Correction <span style="color:red;">(please do checkbox check for incorrect detail)</span>
                            <input type="radio" style="margin-left: 30px;" name="status" class="status" id="reject" @if($consumer->status==3) checked @endif  value='3'> Reject
                            @elseif($consumer->status==1)
                            <span style="color:green;">Verified</span>
                             @elseif($consumer->status==3)
                             <span style="color:red;">Rejected</span>
                              @elseif($consumer->status==4)
                             <span style="color:blue;">Forwarded</span>
                             @endif
                    </th>
                    </tr>
                    </tr>
                    <tr>
                        <td>Remarks</td>
                        <th colspan="3">
                            @if($consumer->status==2 || $consumer->status==0)
                            <textarea name="comment" id="sna_remarks">{{$consumer->sna_remarks}}</textarea>
                            @elseif($consumer->status==1) <span style="color:green;">{{$consumer->sna_remarks}}</span>
                             @elseif($consumer->status==3) <span style="color:red;">{{$consumer->sna_remarks}}</span>
                              @elseif($consumer->status==4) <span style="color:green;">{{$consumer->sna_remarks}}</span>
                              @endif
                      
                    </th>
                    </tr>
                      @if($consumer->status==4)
                    <tr>
                        <td>Remarks To MNRE</td>
                        <th colspan="3">
                           <span style="color:blue;">{{$consumer->mnre_remarks_by_sna}}</span>
                        </th>
                    </tr>
                       @endif
                     @if($consumer->status==2 || $consumer->status==0)
                    <tr>
                        <td></td>
                        <th colspan="3">
                            <input type="submit" name="submit" id="submit" value="Status Update">
                    </th>
                    </tr>
              @endif
               @if($consumer->status==1)
                    <tr>
                        <td></td>
                        <th colspan="3">
                           <span id="forwardToMnre_{{$consumer->id}}"><a class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" onclick="popup({{$consumer->id}})">Forward To MNRE</a></span> 
                    </th>
                    </tr>
              @endif
<tr>
                        <td></td>
                        <th colspan="3">
                          <a href="{{URL::to(Auth::getDefaultDriver().'/small-biogas-list/')}}"<button type="button" class="btn btn-primary">Back</button></a>
                    </th>
                    </tr>
                </table>
                  </form>
            </div>

        </div>
    </div>
</div>
///popup ///
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remarks</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form name="ajax-contact-form" id="ajax-contact-form" method="post" action="javascript:void(0)">
            <input type="hidden" name="small_biogas_id" id="small_biogas_id" value="">
            <input type="hidden" name="status" id="mnre_status" value="">
            <textarea name="mnre_remarks_by_sna" id="mnre_remarks_by_sna"></textarea>

            <input type="submit" id="popup_submit" name="popup_submit" value="Forward to Mnre">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
     var arr = [];
      $(document).ready(function(){
       
        var sna_remarks = $("#sna_remarks").val();
        if(sna_remarks!='')
        {
           arr = sna_remarks.split(",");
        }
       
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                arr.push($(this).val());
                $("#sna_remarks").val(arr);
            }
            else if($(this).prop("checked") == false){
                 var x = arr.indexOf($(this).val());
                arr.splice(x,1);
                 $("#sna_remarks").val(arr);

            }

        });
         });

  $("#approved").click(function(){
    arr = [];
  $(".approved_reject1").show();
  $(".approved_reject1").html('<img src="http://localhost/biogas_live/public/images/checked.png" width="16" height="16" >');
  $("input:checkbox").each(function() {
            this.checked = false;
        });
  $(".papproved").hide();
  $("#sna_remarks").val("Proposal has been verified");
});
   $("#partial_approved").click(function(){ 
  $(".approved_reject1").hide();
  $(".papproved").show();
});
  $("#reject").click(function(){
    arr = [];
  $(".approved_reject1").show();
   $(".approved_reject1").html('<img src="http://localhost/biogas_live/public/images/cross.png" width="16" height="16" >');
  $(".papproved").hide();
   $("input:checkbox").each(function() {
            this.checked = false;
        });
  $("#sna_remarks").val("Proposal has been rejected");
});
    $("#submit").click(function(){
        var sna_remarks = $("#sna_remarks").val();
        var status = $(".status").val();
        var error=0;
        if ($('input[name="status"]:checked').length == 0) {
         alert('please select status');
         return false;
        }
        if(sna_remarks=="")
        {
            alert('please enter remarks');
            return false;
        }
    });
    
</script>
///popup jquery
<script>
    function popup(id)
    { 
       
       $("#small_biogas_id").val(id);
       $("#mnre_status").val(4);
    }
   
</script>
<script>
if ($("#ajax-contact-form").length > 0) {
$("#ajax-contact-form").validate({
  rules: {
    mnre_remarks_by_sna: {
    required: true,
    maxlength: 200
  },
  },
  messages: {
  mnre_remarks_by_sna: {
    required: "Please enter remarks",
    maxlength: "Your name maxlength should be 200 characters long."
  },
  
  },
  submitHandler: function(form) {
  $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
      $.ajax({
        url: "{{url('mnre/save')}}",
        type: "POST",
        data: $('#ajax-contact-form').serialize(),
        datatpe:'html',
        success: function( response ) {
            if(response)
            {
            $('#ajax-contact-form')[0].reset();
           alert('Forworded to Mnre status has been updated successfully');
           $('#myModal').modal('toggle'); 
           window.location = '{{URL::to(Auth::getDefaultDriver().'/small-biogas-list/')}}';
       }

        }
       });
  }
  })
}
</script>

@include('modals.consumerInstallerAssociation')
@endsection
@section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>

@endsection