@extends('layouts.masters.backend')
@section('content')
@section('title', 'Medium Biogas Requests')

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">

                <div class="mt-25">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Beneficiary Name</th>
                                <th>Category</th>
                                <th>Generated Power</th>
                                <th>Plant Size</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mediumBiogasData as $biogasData)
                            <!-- mediumBiogasData ek varriable hai jo mnre controller mai define kiya hai -->
                            <tr id="row_{{$biogasData->id}}">
                                <td>{{$biogasData->application_id}} </td>
                                <td>{{$biogasData->beneficiary_name}}</td>
                                <td>
                                    @if($biogasData->category == 'A')
                                    <span>General/SC/ST/Others</span>
                                    @elseif($biogasData->category == 'B')
                                    <span>Private</span>
                                    @elseif($biogasData->category == 'C')
                                    <span>Government</span>
                                    @else
                                    <span>Others</span>
                                    @endif
                                </td>
                                <td>{{$biogasData->generated_power}}</td>
                                <td>{{$biogasData->plant_size}} (m3)</td>
                                <td>
                                    @if($biogasData->status == '1')
                                    <span style="color:green">Verified</span>
                                    @elseif($biogasData->status == '2')
                                    <span>Partial Approved</span>
                                    @elseif($biogasData->status == '3')
                                    <span style="color:red">Rejected</span>
                                     @elseif($biogasData->status == '4')
                                    <span style="color:blue">Forwarded</span>
                                    @else
                                    <span>Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-primary"
                                        href="{{URL::to(Auth::getDefaultDriver().'/displayAbove10KW/'.base64_encode($biogasData->id))}}">View</a>
                                    <!-- {{URL::to(Auth::getDefaultDriver().'/consumer-detail/'.base64_encode($biogasData->id))}} -->
                                    @if($biogasData->status == '1')
                                        <span id="forwardToMnre_{{$biogasData->id}}"><a class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" onclick="popup({{$biogasData->id}})">Forward</a></span>
                                        @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ///popup /// -->
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
            <input type="submit" id="submit" name="submit" value="Forward to Mnre">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
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
        url: "{{url('mnre/medium/above/save')}}",
        type: "POST",
        data: $('#ajax-contact-form').serialize(),
        datatpe:'html',
        success: function( response ) {
            if(response)
            {
            $('#ajax-contact-form')[0].reset();
           alert('Forword to Mnre status has been updated successfully');
           $('#myModal').modal('toggle');
           $("#row_"+response).find("td:eq(5)").html('<span style="color:blue">Forwarded</span>');
           $('#forwardToMnre_'+response).hide();
       }

        }
       });
  }
  })
}
</script>
@endsection