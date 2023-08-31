@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>MNRE</h1>
            <nav>
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="container-fluid ">
                <div class="col-lg-12">
                    <form action="{{URL::to(Auth::getDefaultDriver().'/mnre-list')}}" method="post" id=" ">
                        @csrf
                    </form>
                    <div class="clearfix"></div><br>
                    <input type="hidden" name="editId" value="{{$id ?? ''}}">
                    <!-- <button type="submit" class="btn btn-success" id='submit' style="float:right">Submit
                        Now</button> -->
                </div>
            </div>

            <div class="clearfix"></div><br>
            <a href="{{URL::to('/'.Auth::getDefaultDriver().'/mnre-form')}}" class="btn btn-success"
                style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>

            <table class="table table-bordered">
                <tr class=" bg-dark text-dark">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile Number</th>
                    <th>Designation Name</th>
                    <th>User Type</th>
                    <!-- <th>Action</th> -->
                </tr>
                @foreach($mnreuserDetail as $mnreuserList)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $mnreuserList->name }}</td>
                    <td>{{ $mnreuserList->email }}</td>
                    <td>{{ $mnreuserList->mobile_number}}</td>
                    <td>{{ $mnreuserList->designation_name }}</td>
                    <td>
                        @if($mnreuserList->user_code ==0)
                        admin
                        @elseif($mnreuserList->user_code ==1)
                        Solar Park
                        @else
                        Solar Power
                        @endif
                    </td>
                    <!-- <td><a href=" {{URL::to(Auth::getDefaultDriver().'/mnre-form/Edit/'.$mnreuserList['id'])}}"
                            class="btn btn-primary">Edit</a> </td> -->
                </tr>
                @endforeach
                <!-- <tr>
                    <td colspan="11">No Record Found</td>
                </tr> -->
            </table>
    </main>
</section>
<!-- </section> -->
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
@endpush