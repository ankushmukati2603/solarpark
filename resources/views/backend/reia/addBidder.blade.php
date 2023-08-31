@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add Bidder</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a>/</li>
                       <li class="breadcrumb-item"><a href="#">Add Bidder </a></li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            @include('layouts.partials.backend._flash')

            <form action="{{url(Auth::getDefaultDriver().'/add-bidder')}}" method="POST">
                @csrf
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%"><label>Bidder Name<span class="text-danger">*</span></label></th>
                            <td>
                                <input type="text" name="bidder_name" id="" class="form-control" value="{{$BidderData->bidder_name??''}}" placeholder="Bidder Name">
                                  <input type="hidden" name="editId" value="{{$BidderData->id ?? ''}}">
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
    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
@endpush