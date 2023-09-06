@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Profile</h1>
        </div>
        <section class="section dashboard">
            <form action="{{URL::to(Auth::getDefaultDriver().'/edit-profile')}}" method="post">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>Name <span class="text-danger">*</span></th>
                        <td colspan="3"><input type="text" name="name" id="name" class="form-control"
                                               placeholder="Enter Your Name" value="{{$user->name ?? ''}}"> </td>
                    </tr>
                    <tr>
                        <th width="20%">Email ID</th>
                        <td width="30%"><input type="text"class="form-control" readonly="" value="{{$user->email ?? ''}}"> </td>
                        <th width="20%">Contact Person <span class="text-danger">*</span></th>
                        <td width="30%"><input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter Contact Person" 
                         value="{{$user->contact_person ?? ''}}"> </td>
                    </tr>
                    <tr>
                        <th width="20%">State <span class="text-danger">*</span></th>
                        <td width="30%"> <select class="form-control" id="txtState" name="state"
                                                 onchange="getDistrictByState(this.value, '')">
                                <option disabled selected>Select</option>
                                @foreach($states as $state)
                                <option value="{{$state->code }}" @if(isset($user->state_id)
                                    && $state->code==$user->state_id)selected @endif> {{$state->name }}</option>
                                @endforeach
                            </select> </td>
                        <th width="20%">Contact Number <span class="text-danger">*</span></th>
                        <td width="30%"><input type="text" name="phone" id="phone" minlength="10" maxlength="10"
                                               onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                               class="form-control" placeholder="Enter Contact Number"
                                               value="{{$user->phone ?? ''}}"> </td>
                    </tr>
                    <tr>
                        <th>Address  <span class="text-danger">*</span></th>
                        <td colspan="3"><input type="text"  name="address" id="address" placeholder="Enter Address" class="form-control"
                                               value="{{$user->address ?? ''}}"></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" name="submit" class="btn btn-success" value="Save" />
                            <input type="reset" class="btn btn-danger" value="Cancel" />
                        </td>
                    </tr>

                </table>
            </form>


        </section>
    </main>
</section>
<!-- </section> -->
@endsection

@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script src="{{asset('public/js/custom.js')}}"></script>
@endpush