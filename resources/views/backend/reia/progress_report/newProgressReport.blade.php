@extends('layouts.masters.backend')
@section('content')

<section class="section dashboard">

    <main id="main" class="main">
        <section class="form_sctn">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 custm_cmn_form_stng">
                    <div class="row ">
                        <div class="pagetitle col-xl-12">
                            <h1>Add Progress Report</h1>
                            <hr style="color: #959595;">
                        </div>
                    </div>
                    <section class="section dashboard">
                        @include('layouts.partials.backend._flash')

                        <form action="{{url(Auth::getDefaultDriver().'/add-progress-report')}}" method="POST">
                            @csrf
                            <div class="row">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="20%"><label>Month<span class="text-danger">*</span></label></th>
                                        <td><select name="month" id="" class="form-control">
                                                <option value="">Select Month</option>
                                                <?php for($i=1;$i<=12;$i++) {?>
                                                <option value="<?=$i?>"><?=date("F", strtotime("2001-" . $i . "-25"))?>
                                                </option>
                                                <?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th><label>Year<span class="text-danger">*</span></label></th>
                                        <td><select name="year" id="" class="form-control">
                                                <option value="">Select Year</option>
                                                <?php for($j=2023;$j>2004;$j--) {?>
                                                <option value="<?=$j?>"><?=$j?></option>
                                                <?php } ?>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <th><label>Scheme <span class="text-danger">*</span></label></th>
                                        <td><select name="scheme_id" id="scheme_id" class="form-control">
                                                <option value="">Select Scheme</option>
                                                @foreach($schemes as $scheme)
                                                <option value="{{$scheme->id}}">{{$scheme->scheme_name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><button type="submit" value="Submit" id="submit" name="submit"
                                                class="btn btn-flat btn-success">Add
                                                Report</button>
                                            <input type="hidden" name="editId" value="{{$progressData->id ?? ''}}">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </section>
    </main>
</section>
@endsection
@push('backend-js')
<script type="text/javascript" src="{{asset('public/js/form_custom.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/custom.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->

@endpush