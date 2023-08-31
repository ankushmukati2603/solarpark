@extends('layouts.masters.backend')
@section('content')
@section('title', 'Small Biogas Application')
<div class="row">
    <div class="col-md-12">
        @include('layouts.partials.backend._flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{url(Auth::getDefaultDriver().'/small-biogas-list')}}" method="post">@csrf
                    <div class="row">
                        @if (Auth::getDefaultDriver() === 'mnre')
                        <div class="col-md-3">
                            <label>State</label>
                            <select class="form-control select2" name="filter[state]">
                                <option selected value="All">All</option>
                                @foreach($states as $state)
                                <option value="{{$state['code']}}" @if($state['code'] == @$filters['state']) selected @endif>{{$state['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <label>Status</label>
                            <select class="form-control select2" name="filter[status]">
                                <option value="">Select</option>
                                <option value="1" @if(@$filters['status'] == "1") selected @endif>Verified</option>
                                <option value="2" @if(@$filters['status'] == "2") selected @endif>Partial Verified</option>
                                <option value="3" @if(@$filters['status'] == "3") selected @endif>Rejected</option>
                                <option value="4" @if(@$filters['status'] == "4") selected @endif>Forward to MNRE</option>
                                <option value="0" @if(@$filters['status'] == "0") selected @endif>Pending</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Consumer Type</label>
                            <select class="form-control select2" name="filter[customer_type]">
                                <option value="">Select</option>
                                <option value="old" @if(@$filters['customer_type'] == "old") selected @endif>Old</option>
                                <option value="new" @if(@$filters['customer_type'] == "new") selected @endif>New</option>
                            </select>
                        </div>
                        <div class="col-md-3 pull-right">
                            <button class="btn btn-sm btn-info pull-right mt-25" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="mt-25">
                    <table id="stakeHoldersTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Application ID</th>
                                <th>Consumer name</th>
                                <th>Email</th>
                                <th>State</th>
                                <th>Contact No.</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($smallBiogasData as $biogasData)
                               <tr id="row_{{$biogasData->id}}">
                                <td>{{$biogasData->consumer_id}}</td>
                                <td>{{$biogasData->name}}</td>
                                <td>{{$biogasData->email}}</td>
                                <td>{{$biogasData->state_name}}</td>
                                <td>{{$biogasData->phone}}</td>
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
                                        href="{{URL::to(Auth::getDefaultDriver().'/small-biogas/'.base64_encode($biogasData->id))}}">View</a>
                                         @if($biogasData->status == '1')
                                        <span id="forwardToMnre_{{$biogasData->id}}"><a class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#myModalsmall" onclick="popup({{$biogasData->id}})">Forward</a></span>
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
<div class="modal" id="myModalsmall">
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
        url: "{{url('mnre/save')}}",
        type: "POST",
        data: $('#ajax-contact-form').serialize(),
        datatpe:'html',
        success: function( response ) {
            if(response)
            {
            $('#ajax-contact-form')[0].reset();
           alert('Forword to Mnre status has been updated successfully');
           $('#myModalsmall').modal('toggle');
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

