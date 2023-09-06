@extends('layouts.masters.backend')
@section('content')
<!-- @if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif -->
<section class="section dashboard">
    <main id="main" class="main">

    <section class="form_sctn" >
            <div class="row">
            </div>
            <div class="row">
                
                <div class="col-xxl-6 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>New Report</h1> 
                            <hr style="color: #959595;">
                        </div>
                        
        <section class="section dashboard">
            @include('layouts.partials.backend._flash')

            <form action="{{url(Auth::getDefaultDriver().'/add-progress-report')}}" method="POST">
                @csrf
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                            <th width="10%"><label>Month<span class="text-danger">*</span></label></th>
                            <td><select name="month" id="" class="form-control"><?php for($i=1;$i<=12;$i++) {?>
                                    <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <th><label>Year<span class="text-danger">*</span></label></th>
                            <td><select name="year" id="" class="form-control"><?php for($j=2023;$j>2004;$j--) {?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                       
                        <tr>
                            <th colspan="2"><button type="submit" value="Submit" name="submit"
                                    class="btn btn-flat btn-success">Add
                                    Report</button>
                                <input type="hidden" name="editId" value="{{$progressData->id ?? ''}}">
                            </th>
                        </tr>
                    </table>
                   
                </div>
            </form>
    </main>
</section>
<!-- </section> -->
@include('modals.consumerInstallerAssociation')
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

@endpush