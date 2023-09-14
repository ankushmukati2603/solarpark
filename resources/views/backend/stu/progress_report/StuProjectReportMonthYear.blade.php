@extends('layouts.masters.backend')
@section('content')
<!-- @if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif -->
<section class="section dashboard">
    <main id="main" class="main">

        <div class="row">

            <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
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

                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Month <span class="text-danger">*</span></label>
                                    <select name="month" id="" class="form-control"><?php for($i=1;$i<=12;$i++) {?>
                                        <option value="<?=$i?>">
                                            <?=date("F", strtotime("2001-" . $i . "-25"))?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Year <span class="text-danger">*</span></label>
                                    <select name="year" id="" class="form-control"><?php for($j=2023;$j>2004;$j--) {?>
                                        <option value="<?=$j?>"><?=$j?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 pb-3">
                                    <label for="email">Project <span class="text-danger">*</span></label>
                                    <select name="project_id" id="project_id" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($projectList as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">

                                    <div class=" pt-4">

                                        <button type="submit" value="Submit" name="submit"
                                            class="btn btn-flat btn-success">Add
                                            Report</button>
                                        <input type="reset" class="btn btn-danger" value="Cancel" />
                                    </div>
                                </div>
                            </div>


                        </form>
                    </section>
                </div>
            </div>
        </div>
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