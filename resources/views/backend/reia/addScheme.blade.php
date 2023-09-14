@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard form_sctn">
    <main id="main" class="main">

        <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
            <!-- <div class="row "> -->
            <div class="pagetitle col-xl-12">
                <h1>Add Scheme</h1>
                <hr style="color: #959595;">
                @include('layouts.partials.backend._flash')

                <form action="{{url(Auth::getDefaultDriver().'/add-scheme')}}" method="POST">
                    @csrf
                    <div class="row">
                        <table class="table table-bordered">
                            <tr>
                                <th width="30%"><label>Scheme Name<span class="text-danger">*</span></label></th>
                                <td>
                                    <input type="text" name="scheme_name" id="" class="form-control"
                                        value="{{$SchemeData->scheme_name??''}}" placeholder="Scheme Name">
                                    <input type="hidden" name="editId" value="{{$SchemeData->id ?? ''}}">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" value="Submit" id="submit" name="submit"
                                        class="btn btn-flat btn-success">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
@endpush