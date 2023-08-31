@extends('layouts.masters.backend')
@section('content')
<!-- @if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif -->
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
            <!-- <li class="breadcrumb-item active">Progress Report Data</li> -->
        </ol>
    </nav>
</div>
<section class="section dashboard">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-3 col-sm-6 " style="display:inline-block">
                    <select name="month" id=""><?php for($i=1;$i<=12;$i++) {?>
                        <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6" style="display:inline-block">
                    <select name="year" id=""><?php for($j=2005;$j<2024;$j++) {?>
                        <option value="<?=$j?>"><?=$j?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" value="Submit" name="submit" class="btn btn-flat btn-success">Add Report</button>
                <input type="hidden" name="editId" value="{{$progressData->id ?? ''}}">
            </div>
        </div>
    </form>
</section>
@include('modals.consumerInstallerAssociation')
@endsection