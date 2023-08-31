@extends('layouts.masters.backend')
@section('content')


<section class="section dashboard">

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bidder List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
                    <li class="breadcrumb-item active">Bidder List</li>
                </ol>
            </nav>
        </div>
        <strong>
            <h1 class="text-center">REIA</h1>
        </strong>
        <strong>
            <h4 class="text-center">Bidder List</h4>
        </strong>
        @include('layouts.partials.backend._flash')
        
 
        <div class="clearfix"></div><br>
        <a href="{{URL::to('/'.Auth::getDefaultDriver().'/add-bidder')}}" class="btn btn-success"
            style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>Add Bidder</a>

        <table class="table table-bordered">
            <tr class=" bg-dark text-dark">
                <th>S.No</th>
                <th>Name of Bidder</th>
                <th>Edit</th>
                <th>Action</th>
            </tr>
            @if(!Empty($Bidder))
            @foreach($Bidder as $bidders)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$bidders->bidder_name}}</td>
                <td> 
                <a href="{{URL::to(Auth::getDefaultDriver().'/bidder/edit/'.$bidders->id)}}"
                   class="btn btn-primary"><i class="fa fa-pencil">
                </td>
                <td>
                <input data-id="{{$bidders->id}}" class="toggle-class" type="checkbox" data-onstyle="success" 
	 data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $bidders->status ? 'checked' : '' }}>
                </td>
                
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="11">No Record Found</td>
            </tr>
            @endif
        </table>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
      $(document).ready(function(){
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var id = $(this).data('id'); 
             
            $.ajax({
                type: "GET",
                dataType: "json",
                url: baseUrl + '/{{Auth::getDefaultDriver()}}/bidders_status',
                data: {'status': status, 'id': id},
                success: function(data){
                  alert(data.success)
                }
            });
        })
      })
    </script>
    </main>
</section>

@endsection
<style>
.error {
    color: red
}
</style>
<script src="{{asset('public/js/custom.js')}}"></script>