@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Feedback</h1>
        </div>
        <section class="section dashboard">
            <form action="{{URL::to(Auth::getDefaultDriver().'/feedback')}}" method="post">
                @csrf
                <table class="table table-bordered">
                  
                     <tr>
                        <th width="20%">Name</th>
                        <td width="30%"><input type="text"class="form-control" readonly="" value="{{Auth::user()->name}}"> </td>
                      <th width="20%">Email ID</th>
                        <td width="30%"><input type="text"class="form-control" readonly="" value="{{Auth::user()->email}}"> </td>
                    </tr>
                    <tr>
                        <th width="20%">Contact Number <span class="text-danger">*</span></th>
                        <td width="30%"><input type="text"  class="form-control" readonly="" placeholder="Enter Contact Person"  value="{{Auth::user()->phone}}"> </td>
                  <th width="20%">Message</th>
                  <td width="30%"><textarea class="form-control" name="message" id="message"></textarea>
                        </td>
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