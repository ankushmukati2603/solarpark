@extends('layouts.masters.backend')
@section('content')
@section('title', 'Small Biogas Plant')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to(Auth::getDefaultDriver().'/')}}">Home</a></li>
            <li class="breadcrumb-item active">Proposal for Small Biogas Plants (1 M^3 to 25 M^3)</li>
        </ol>
    </nav>
</div>
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<section class="section dashboard">
    <div class="row">
        <form id="consumerInterestForm" action="{{URL::to(Auth::getDefaultDriver().'/smallBiogasPlants')}}"
            method="POST">
            @csrf
            <h4 class="pb-3">Proposal for Small Biogas Plants (1 M^3 to 25 M^3)</h2>

                <div class="col-lg-12 form_main_stng">
                    <div class="row form_cmn_stng">
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Name
                                    <span class="error">*</span></label>

                                <input type="text" class="form-control required" name="name"
                                    value="{{Auth::user()->name}}" readonly>
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Contact Number
                                    <span class="error">*</span></label>
                                <input type="number" class="form-control required" name="phone"
                                    value="{{Auth::user()->contact_number}}" readonly>
                                <!-- <textarea class="form-control" name="contact_number" cols="30" rows="1"
                                    placeholder="Address Write here..." value="{{Auth::user()->contact_number}}"
                                    readonly></textarea> -->
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">Email
                                    <span class="error">*</span></label>

                                <input type="text" class="form-control required" name="email"
                                    value="{{Auth::user()->email}}" readonly>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="category">Category</label>
                                @if (($editable ?? '') == 'disabled')
                                @if (($consumer['category'] ?? '') == 'gen')
                                <p>General</p>
                                @elseif(($consumer['category'] ?? '') == 'sc')
                                <p>SC</p>
                                @elseif(($consumer['category'] ?? '') == 'st')
                                <p>ST</p>
                                @else
                                <p>Not defined</p>
                                @endif
                                @else
                                <select class="form-control required" name="category" {{$editable ?? ''}}>
                                    <option selected disabled>Select Category</option>
                                    @foreach(Config::get('constants.categories') as $category)
                                    <option value="{{$category['code']}}" @if(($consumer['category'] ?? ''
                                        )==$category['code']) selected @endif>{{$category['name']}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-xxl-12">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name">Address Details
                                        <span class="error">*</span></label>
                                </div>
                                <div class="col-md-12 inner_table_form mb-3 mt-2">
                                    <div class="row">
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="district_id">State <span class="error">*</span></label>
                                            <select class="form-control required" id="state_id" name="state_id"
                                                onchange="getDistrictByState(this.value,'')">

                                                <option value="">Select State</option>
                                                @foreach($states as $state)<option value="{{$state->code }}"
                                                    @if(isset($consumer->
                                                    state_id) && $state->code==$consumer->state_id)selected
                                                    @endif>
                                                    {{$state->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('state_id') }}</span>

                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="district_id">{{ __('District') }} <span
                                                    class="error">*</span></label>
                                            @if (($editable ?? '') == 'disabled')
                                            <p>{{$consumer['district'] ?? ''}}</p>
                                            @else
                                            <select class="form-control required" id="district_id" name="district_id"
                                                onchange="getSubDistrictByDistrict(this.value,'') ; getBlockByDistricts(this.value,'')">
                                                <option value="">Select District</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="sub_district_id">{{ __('Sub District') }} <span
                                                    class="error">*</span></label>
                                            @if (($editable ?? '') == 'disabled')
                                            <p>{{$consumer['sub_district'] ?? ''}}</p>
                                            @else
                                            <select class="form-control  required" id="sub_district_id"
                                                name="sub_district_id"
                                                onchange="getVillageBySubDistrict(this.value,'')">
                                                <option value="" selected disabled>Select Sub-District</option>

                                            </select>
                                            <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="block">{{ __('Block') }} <span class="error">*</span></label>
                                            @if (($editable ?? '') == 'disabled')
                                            <p>{{$consumer['block'] ?? ''}}</p>
                                            @else
                                            <select class="form-control  required" id="block_id" name="block">
                                                <option value="" selected disabled>Select Block</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('block') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="village">{{ __('Village') }} <span
                                                    class="error">*</span></label>
                                            @if (($editable ?? '') == 'disabled')
                                            <p>{{$consumer['village'] ?? ''}}</p>
                                            @else
                                            <select class="form-control  required" id="village_id" name="village">
                                                <option value="" selected disabled>Select Village</option>
                                            </select>
                                            @endif
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="panchayat_id">{{ __('Localbody Type') }} <span
                                                    class="error">*</span></label>
                                            @if (($editable ?? '') == 'disabled')
                                            <p>{{$consumer['panchayat'] ?? ''}}</p>
                                            @else
                                            <select class="form-control  required" id="localbody_id"
                                                name="localbody_type"
                                                onchange="getPanchayatByLocalbodies(this.value,'')">
                                                <option value="">Select </option>
                                                <option value="1" @if (($consumer->localbody_type ?? '') ==
                                                    '1')Selected
                                                    @endif>RURAL
                                                </option>
                                                <option value="2" @if (($consumer->localbody_type ?? '') ==
                                                    '2')Selected
                                                    @endif>URBAN
                                                </option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('localbody_type') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="name">Panchayat
                                                <label for="panchayat_id">Panchayat<span class="error">*</span></label>
                                                @if (($editable ?? '') == 'disabled')
                                                <p>{{$consumer['panchayat'] ?? ''}}</p>
                                                @else
                                                <select class="form-control  required" id="panchayat_id"
                                                    name="panchayat" onchange="getWardByPanchayat(this.value,'')">
                                                    <option value="">Select Panchayat</option>

                                                </select>
                                                <span class="text-danger">{{ $errors->first('panchayat') }}</span>
                                                @endif
                                        </div>

                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">

                                            <label for="ward_no">Ward No<span class="error">*</span></label>

                                            <select class="form-control  required" id="ward_id" name="ward_no"
                                                value="{{$consumer['ward_no'] ?? ''}}">
                                                <option value="">Select Ward</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('ward_no') }}</span>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="name">Post office
                                                <span class="error">*</span></label>
                                            <input type="text" class="form-control required" name="post"
                                                placeholder="Post Office Number" value="{{$consumer['post'] ?? ''}}">
                                            <span class="text-danger">{{ $errors->first('post') }}</span>
                                        </div>
                                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                            <label for="name">House No.
                                                <span class="error">*</span></label>
                                            <input type="text" class="form-control required" name="house_no"
                                                placeholder=" House Number" value="{{$consumer['house_no'] ?? ''}}">
                                            <span class="text-danger">{{ $errors->first('house_no') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">

                            <label for="name">Other Details
                                <span class="error">*</span></label>
                        </div>
                        <div class="col-md-12 inner_table_form mb-3 mt-2">
                            <div class="row">
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                    <label for="name" class="pb-2">Do you require toilet linked biogas plants?
                                        <span class="error">*</span></label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="toilet_linked" value="1"
                                                @if(($consumer->toilet_linked ?? '') == 1)
                                            checked @endif> Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="toilet_linked" value="0"
                                                @if(($consumer->toilet_linked ?? '') == 0)
                                            checked @endif> No
                                        </label>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('biogas_generation') }}</span>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                    <label for="name" class="pb-2">Do you already have a biogas plant
                                        installed?
                                        <span class="error">*</span></label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="existing_biogas_plant"
                                                value="1" @if(($consumer->existing_biogas_plant ?? '') ==
                                            1)checked @endif >
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="existing_biogas_plant"
                                                value="0" @if(($consumer->existing_biogas_plant ?? '') == 0) checked
                                            @endif> No
                                        </label>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('biogas_generation') }}</span>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                    <label for="name" class="pb-2">Do you require biogas slurry filter unit?
                                        <span class="error">*</span></label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slurry_filter_unit"
                                                value="1" @if(($consumer->slurry_filter_unit ?? '') ==
                                            1)checked @endif>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="slurry_filter_unit"
                                                value="0" @if(($consumer->slurry_filter_unit ?? '') ==
                                            0)checked @endif> No
                                        </label>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('slurry_filter_unit') }}</span>
                                </div>
                                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-12 pb-3">
                                    <label for="name" class="pb-2">Number of cattle available
                                        <span class="error">*</span></label>
                                    <br>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="cattle_available"
                                                value="1" @if(($consumer->cattle_available ?? '') ==
                                            1)checked @endif>
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="cattle_available"
                                                value="0" @if(($consumer->cattle_available ?? '') ==
                                            0)checked @endif> No
                                        </label>
                                    </div>

                                </div>
                                <span id="cattle_id" style="display:@if(($consumer->cattle_available ?? '') ==
                                    0)none @endif">
                                    <div class="col-md-12 row">
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <input type="text" class="form-control required"
                                                    name="number_of_cattles[BuffaloesBig]" placeholder="Buffaloes (Big)"
                                                    onkeypress="return isNumber(event)"
                                                    value="{{$consumer['number_of_cattles']['BuffaloesBig'] ?? '0'}}">
                                                <!-- <span class="text-danger">{{ $errors->first('number_of_cattles') }}</span> -->

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @if (($editable ?? '') == 'disabled')
                                                <p>Buffaloes (small) :
                                                    {{$consumer['number_of_cattle']['buffaloes']['small'] ?? ''}}</p>
                                                @else
                                                <input type="text" {{$editable ?? ''}} class="form-control required"
                                                    name="number_of_cattles[BuffaloesSmall]"
                                                    placeholder="Buffaloes (Small)" onkeypress="return isNumber(event)"
                                                    value="{{$consumer['number_of_cattles']['BuffaloesSmall'] ?? '0'}}">
                                                <!-- <span
                                                class="text-danger">{{ $errors->first('cattles[buffaloes][small]') }}</span> -->
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @if (($editable ?? '') == 'disabled')
                                                <p>Cows (big) : {{$consumer['number_of_cattle']['cows']['big'] ?? ''}}
                                                </p>
                                                @else
                                                <input type="text" {{$editable ?? ''}} class="form-control required"
                                                    name="number_of_cattles[CowsBig]" placeholder="Cows (Big)"
                                                    onkeypress="return isNumber(event)"
                                                    value="{{$consumer['number_of_cattles']['CowsBig'] ?? '0'}}">
                                                <!-- <span class="text-danger">{{ $errors->first('cattles[cows][big]') }}</span> -->
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                @if (($editable ?? '') == 'disabled')
                                                <p>Cows (small) :
                                                    {{$consumer['number_of_cattle']['cows']['small'] ?? ''}}
                                                </p>
                                                @else
                                                <input type="text" {{$editable ?? ''}} class="form-control required"
                                                    name="number_of_cattles[CowsSmall]" placeholder="Cows (Small)"
                                                    onkeypress="return isNumber(event)"
                                                    value="{{$consumer['number_of_cattles']['CowsSmall'] ?? '0'}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @error('number_of_cattles.*')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </span>

                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
                                    <label for="name">Comment
                                        <span class="error">*</span></label>
                                    <textarea class="form-control" rows="3" id="comment"
                                        name="comment">{{$consumer['comment'] ?? ''}}</textarea>
                                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-12">
                        <input type="checkbox" id="" name="authorized" value="1" @if(($consumer->authorized
                        ?? '') ==1)checked @endif >
                        <label for="vehicle1"> I authorize that entered information in proposal are
                            correct and verified</label> <br>
                        <span class="text-danger">{{ $errors->first('authorized') }}</span>
                    </div>


                    <div class="col-xxl-12 text-center pt-3 pb-3">
                        <a href="{{URL::to(Auth::getDefaultDriver().'/smallBiogasPlants')}}" {{$editable ?? ''}}
                            class="mt-1 btn btn-info @isset($editable) hidden @endisset"> Cencel</a>

                        <input type="submit" {{$editable ?? ''}}
                            class="mt-1 btn btn-primary @isset($editable) hidden @endisset" value="Save" onclick="">
                        @if(($consumer['final_submission'] ?? '') == '0')
                        <input type="submit" {{$editable ?? ''}}
                            class="mt-1 btn btn-success @if($consumer['final_submission']=='0') @else hidden  @endif"
                            value="Final Submission" name="final_submission"
                            onclick="if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {}else{return false;}">

                        <input type="hidden" name="editId" value="{{$consumer->id ?? ''}}">
                        @endif

                        <!-- <input type="submit" name="submit" value="cancel" class="btn btn-secondary btn-lg" id="">
                        <input type="submit" name="submit" value="save" class="btn btn-success btn-lg" id="">
                        <input type="submit" name="submit" value="Final Submission" class="btn btn-success green btn-lg"
                            id="">
                        <input type="hidden" name="editId" value="0"> -->
                    </div>


                </div>


        </form>

    </div>
</section>


<style>
.col-md-4 {
    display: inline-block;
}
</style>
@include('modals.consumerInstallerAssociation')
@endsection

@push('backend-js')

<script src="{{asset('public/js/custom.js')}}"></script>
<script>
$('input[name=cattle_available]').change(function() {
    var value = $('input[name=cattle_available]:checked').val();
    if (value == 0) {
        $('#cattle_id').hide();
    } else {
        $('#cattle_id').show();
    }
});


function setOrEditPriority(element) {
    let value = $(element).val();
    let systemId = $(element).data('system');
    ajaxcall('GET', {}, baseUrl + '/ajax/setOrEditPriority/' + systemId + '/' + value).then((resp) => {
        if (resp === 'SUCCESS') {
            window.location = '{{URL::to("/".Auth::getDefaultDriver()."/consumer-list")}}'
        }
    })
}
</script>

@if(($consumer['final_submission'] ?? '') == '0')
<script>
$(document).ready(function() {
    getDistrictByState('{{ $consumer["state_id"] }}', '{{ $consumer["district_id"] }}');
    getSubDistrictByDistrict('{{ $consumer["district_id"] }}', '{{ $consumer["sub_district_id"] }}');
    getBlockByDistricts('{{ $consumer["district_id"] }}', '{{ $consumer["block"] }}');
    // block table k  column ka name
    getVillageBySubDistrict('{{ $consumer["sub_district_id"] }}', '{{ $consumer["village"] }}');
    getPanchayatByLocalbodies('{{$consumer["localbody_type"] }}', '{{ $consumer["panchayat"] }}');
    getWardByPanchayat('{{ $consumer["panchayat"] }}', '{{$consumer["ward_no"] }}');
});
</script>
@endif
@endpush