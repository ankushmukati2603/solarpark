@inject('general', 'App\Http\Controllers\Backend\Mnre\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <section class="section dashboard form_sctn">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <!-- <a href="{{URL::to('/'.Auth::getDefaultDriver().'/Agency/Add')}}" class="btn btn-success"
                            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New SPPD</a> -->
                        <h1>SPPD Users</h1>

                        <hr style="color: #959595;">

                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-dark text-dark">
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Mobile Number</th>
                                    <th>PAN Number</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Status</th>
                                    <th width="10%">Registered On</th>
                                    <th>Action</th>
                                    <!-- <th>Action</th> -->
                                </tr>

                            </thead>
                            <tbody>@foreach($sppdList as $sppd)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $sppd->name }}</td>
                                    <td>{{ $sppd->email }}</td>
                                    <td>{{ $sppd->contact_no}}</td>
                                    <td>{{ '******' . substr( $sppd->pan_no, - 4) }}</td>
                                    <td>{{ $sppd->state_name }}</td>
                                    <td>{{ $sppd->district_name }}</td>
                                    <td>
                                        @if($sppd->isApproved==0)
                                        <b class="text-warning">Pending</b>
                                        @elseif($sppd->isApproved==1)
                                        <b class="text-success">Approved</b>
                                        @else
                                        <b class="text-danger">Rejected</b><br>
                                        <a href="javascript:;" data-bs-target="#sppdRemarkModal{{$sppd->id}}"
                                            data-bs-toggle="modal" class="badge bg-success">Remarks</a>
                                        <div class="modal fade" id="sppdRemarkModal{{$sppd->id}}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $sppd->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Remark: </label><br>
                                                                {{ $sppd->remarks }}
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td>{{ $sppd->created_at }}</td>
                                    <!--<td><a href=" {{URL::to(Auth::getDefaultDriver().'/developer-mnre/Edit/'.$sppd->id)}}"
                                        class="btn btn-primary">Edit</a> </td>-->
                                    <td><a data-bs-toggle="modal" href="javascript:;"
                                            data-bs-target="#sppdModal{{$sppd->id}}" class="badge bg-success">Action</a>
                                        <!-- Model -->
                                        <div class="modal fade" id="sppdModal{{$sppd->id}}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{URL::to(Auth::getDefaultDriver().'/SppdApproveReject')}}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                {{ $sppd->name }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Status: <span
                                                                            class="text-danger">*</span></label>
                                                                    <select name="isApproved" id="isApproved"
                                                                        class="form-control">
                                                                        <option value="">Select</option>
                                                                        <option value="1">Approved</option>
                                                                        <option value="2">Rejected</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 mt-3">
                                                                    <label for="">Remark: <span
                                                                            class="text-danger">*</span></label>
                                                                    <textarea name="remarks" id="remarks" cols="30"
                                                                        rows="5" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" id="id"
                                                                value="{{$general->encodeid($sppd->id)}}">
                                                            <button type="submit" id="submit"
                                                                class="btn btn-primary">Save
                                                                changes</button>
                                                            <input type="hidden" name="email" id=""
                                                                value="{{$general->encodeid($sppd->email)}}">
                                                            <input type="hidden" name="name" id=""
                                                                value="{{$general->encodeid($sppd->name)}}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush