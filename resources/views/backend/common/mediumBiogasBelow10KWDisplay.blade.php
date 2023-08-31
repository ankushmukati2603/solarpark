@extends('layouts.masters.backend')
@section('content')
@section('title', ' Proposal for Medium Biogas Plants ( Above 25 M^3 to 25 M3) - Above 10 KW')
<div class="col-md-12">
     @include('layouts.partials.backend._flash')
    <div class="frontPagesBox">
        <div class="box box-primary">
           
                        
                <div class="box-header with-border text-right">
                </div>
                <div class="box-body">
                    <form action="{{url('mnre/medium/below/add-remarks')}}" method="post">
                         @csrf
                          <input type="hidden" name="medium_below_plant_id" value="{{$consumer->id}}">
                    <table class="table table-bordered">
                        <tr>
                            <td width="20%">Name of state Govt. Nodal Deptt. / Nodal Agency / BDTC/ KVIC other Approved
                                Organization </td>
                            <th width="30%">{{$consumer['organization_name'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="organization_name" value="Please enter correct information for organization name"> @elseif($consumer_log && $consumer_log->organization_name==1)<input type="checkbox" checked name="organization_name" value="Please enter correct information for organization name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" > @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td width="20%">Address of state Govt. Nodal Deptt./Nodal Agency/BDTC/ KVIC other Approved
                                Organization</td>
                            <th width="30%">{{$consumer['organization_address'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="organization_address" value="Please enter correct information for organization address"> @elseif($consumer_log && $consumer_log->organization_address==1)<input type="checkbox" checked name="organization_address" value="Please enter correct information for organization address"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                 @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Name of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)</td>
                            <th>{{$consumer['project_name'] ?? ''}} 
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="project_name" value="Please enter correct information for project name"> @elseif($consumer_log && $consumer_log->project_name==1)<input type="checkbox" checked name="project_name" value="Please enter correct information for project name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                  @else &nbsp; @endif </span>
                                
                            </th>
                        </tr>
                        <tr>
                            <td>Address of project executing organization/agency (if other than SNA/SND./BDTC/ KVIC)
                            </td>
                            <th>{{$consumer['project_address'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="project_address" value="Please enter correct information for project address"> @elseif($consumer_log && $consumer_log->project_address==1)<input type="checkbox" checked name="project_address" value="Please enter correct information for project name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                  @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Details of site indicating location and address with expected load and use of
                                electricity or biogas for thermal applications</td>
                            <th>{{$consumer['applications_details'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="applications_details" value="Please enter correct information for applications details"> @elseif($consumer_log && $consumer_log->organization_address==1)<input type="checkbox" checked name="applications_details" value="Please enter correct information for applications details"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                 @else &nbsp; @endif </span>
                            </th>
                        </tr>
                        <tr>
                            <td>Capacity of biogas plant (cubic meter per day/per hour)</td>
                            <th>{{$consumer['capacity'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="capacity" value="Please enter correct information for capacity"> @elseif($consumer_log && $consumer_log->capacity==1)<input type="checkbox" checked name="capacity" value="Please enter correct information for capacity"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" > 
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                @else &nbsp; @endif </span>
                            </th>
                        </tr>

                        <tr>
                            <td>Mention details of cattles</td>
                            <th>Adult: {{$consumer['cattles_details']['no_adult'] ?? ''}}<br>
                                Age: {{$consumer['cattles_details']['age'] ?? ''}}<br>
                                Weight: {{$consumer['cattles_details']['weight'] ?? ''}}
                            </th>
                        </tr>
                        <tr>
                            <td>Any other source of waste (goats, pigs, poultry diary effluent, food, kitchen, Agro/
                                Food processing waste etc.)</td>
                            <th>Animals: {{$consumer['other_sources']['No_animals'] ?? ''}}<br>
                                Weight: {{$consumer['other_sources']['weight'] ?? ''}}</th>
                        </tr>

                        <tr>
                            <td>Name of manufacturer/supplier and cost of 100% biogas engines, DG-Genset and associated
                                control panel etc')</td>
                            <th>{{$consumer['manufacturer_name'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="manufacturer_name" value="Please enter correct information for manufacturer name"> @elseif($consumer_log && $consumer_log->manufacturer_name==1)<input type="checkbox" checked name="manufacturer_name" value="Please enter correct information for manufacturer name"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Required daily demand /power in KWh/day')</td>

                            <th>{{$consumer['required_daily_power'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="required_daily_power" value="Please enter correct information for required daily power"> @elseif($consumer_log && $consumer_log->required_daily_power==1)<input type="checkbox" checked name="required_daily_power" value="Please enter correct information for required daily power"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Required amount of biogas generation daily( in cubic metre) including cooking/
                                heating/cooling etc.(Kcal requirement per day for thermal energy applications)</td>
                            <th>{{$consumer['biogas_generation'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="biogas_generation" value="Please enter correct information for biogas generation"> @elseif($consumer_log && $consumer_log->biogas_generation==1)<input type="checkbox" checked name="biogas_generation" value="Please enter correct information for biogas generation"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>No. of biogas plants units with capacity of each cubic metre proposed</td>
                            <th>{{$consumer['no_of_plants'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="no_of_plants" value="Please enter correct information for no of plants"> @elseif($consumer_log && $consumer_log->no_of_plants==1)<input type="checkbox" checked name="no_of_plants" value="Please enter correct information for no of plants"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Estimated actual cost worked out by concerned user agency /manufacturer and verified by
                                concerned SND / SNA / KVIC /BDTC etc</td>
                            <th>{{$consumer['actual_cost'] ?? ''}}
                                <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="actual_cost" value="Please enter correct information for actual cost"> @elseif($consumer_log && $consumer_log->actual_cost==1)<input type="checkbox" checked name="actual_cost" value="Please enter correct information for actual cost"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                 @else &nbsp; @endif </span>
                            </th>
                            <td>Proposed operational hours per day entirely based on Biogas (100% biogas utilization
                                basis)</td>
                            <th>{{$consumer['operational_hours'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="operational_hours" value="Please enter correct information for operational hours"> @elseif($consumer_log && $consumer_log->operational_hours==1)<input type="checkbox" checked name="operational_hours" value="Please enter correct information for operational hours"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td>Total estimated project cost (in Rs.)</td>
                            <th>{{$consumer['project_cost'] ?? ''}}
                                 <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="project_cost" value="Please enter correct information for project cost"> @elseif($consumer_log && $consumer_log->project_cost==1)<input type="checkbox" checked name="project_cost" value="Please enter correct information for project cost"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                    @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                                  @else &nbsp; @endif </span>
                            </th>
                            <td>Amount of CFA worked out as per the approved rates and norms of scheme of BPGTP (in Rs.)
                            </td>
                            <th>{{$consumer['amount_of_cfa'] ?? ''}}
                            <span class="approved_reject1"></span><span class="papproved">@if(!$consumer_log) <input type="checkbox" name="amount_of_cfa" value="Please enter correct information for amount of cfa"> @elseif($consumer_log && $consumer_log->amount_of_cfa==1)<input type="checkbox" checked name="amount_of_cfa" value="Please enter correct information for amount of cfa"> @elseif($consumer_log && $consumer_log->status==1) <img src="{{ URL::asset('public/images/checked.png') }}" width="16" height="16" >
                                @elseif($consumer_log && $consumer_log->status==3) <img src="{{ URL::asset('public/images/cross.png') }}" width="16" height="16" >
                             @else &nbsp; @endif </span></th>
                        </tr>
                        <tr>
                            <td> Upload Undertaking on Non- Judical Stamp/e - Stamp paper</td>
                            <th><a href="{{url('storage/documents/systems/BioDocument/'.$consumer['undertaking'])}}">View</a>
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
                          <a href="{{URL::to(Auth::getDefaultDriver().'/medium-biogas-10KW-list/')}}"<button type="button" class="btn btn-primary">Back</button></a>
                    </th>
                    </tr>
                    </table>
                </form> 
                </div>
            
        </div>
    </div>
</div>
<!-- </div>
</div> -->
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
        url: "{{url('mnre/medium/below/save')}}",
        type: "POST",
        data: $('#ajax-contact-form').serialize(),
        datatpe:'html',
        success: function( response ) {
            if(response)
            {
            $('#ajax-contact-form')[0].reset();
           alert('Forworded to Mnre status has been updated successfully');
           $('#myModal').modal('toggle'); 
           window.location = '{{URL::to(Auth::getDefaultDriver().'/medium-biogas-10KW-list/')}}';
       }

        }
       });
  }
  })
}
</script>
@include('modals.consumerInstallerAssociation')
@endsection
<!-- @section('scripts')
<script src="{{asset('public/js/custom.js')}}"></script>
@endsection -->