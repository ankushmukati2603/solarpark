@inject('general', 'App\Http\Controllers\Backend\Mnre\MainController')
@extends('layouts.masters.backend')
@section('content')
<section class="section dashboard">
    <main id="main" class="main">
        <section class="section dashboard form_sctn">
            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                <div class="row ">
                    <div class="pagetitle col-xl-12">
                        <h1>Feedback</h1>
                        <hr style="color: #959595;">
                        <table class="table table-bordered" id="example">
                            <thead>
                                <tr class=" bg-dark text-dark">
                                    <th>S.No</th>
                                    <th>User Type</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Contact Number</th>
                                    <th width="20%">Feedback</th>
                                    <th>Submitted On</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feedbacklist as $feedback)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ ucfirst($feedback->user_type) ?? '--' }}</td>
                                    <td>{{ $feedback->name ?? '--'}}</td>
                                    <td>{{ $feedback->email ?? '--' }}</td>
                                    <td>{{ $feedback->contact_no ?? '--' }}</td>
                                    <td>{{ $feedback->message ?? '--' }}</td>
                                    <td>{{ $feedback->created_date ?? '--' }}</td>
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