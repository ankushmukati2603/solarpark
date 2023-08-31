@extends('layouts.masters.home')
@section('content')
@section('title', 'Consumer Interest Form')
<div class="container" style="width: 90%">
    <div class=" row">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="col-md-12">
            <div class="frontPagesBox">
                <div class="box box-primary">
                    <form id="consumerInterestForm" action="{{URL::to('smallBiogasPlants')}}" method="POST">
                        @csrf
                        <!--<div class="box-header with-border text-right">
                        </div> -->
                        <div class="box-body">
                            <div class="row">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-center"> Proposal for Small Biogas Plants (1 M^3 to 25
                                        M^3)</h3>
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name <span class="error">*</span></label>
                                        <input type="text" class="form-control required" name="name"
                                            value="{{old('name')}}">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone">Contact Number<span class="error">*</span></label>

                                        <input type="text" class="form-control required number" maxlength="10"
                                            minlength="10" name="phone" value="{{$consumer['phone'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }} <span class="error">*</span></label>
                                        @if (($editable ?? '') == 'disabled')
                                        <p>{{$consumer['email'] ?? ''}}</p>
                                        @else
                                        <input type="email" {{$editable ?? ''}} class="form-control required"
                                            name="email" value="{{$consumer['email'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="aadhar_no">{{ __('Aadhar Card Number') }} <span class="error">*</span></label>
                                @if (($editable ?? '') == 'disabled')
                                    <p>{{'XXXXXXXX'.substr(base64_decode($consumer['aadhar_no']), 8) ?? ''}}</p>
                                @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required number" maxlength="12" minlength="12" name="aadhar_no" value="{{base64_decode($consumer['aadhar_no'] ?? '')}}">
                                @endif
                            </div>
                        </div> -->
                                <div class="col-md-4">
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
                            </div>
                            <hr>
                            <label class="headLebels">Address Details</label>
                            <br>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state_id">{{ __('State') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['state'] ?? ''}}</p>
                                    @else
                                    <select class="form-control required" id="state_id" name="state_id"
                                        onchange="getDistrictByState(this.value,'')">

                                        <option value="">Select State</option>
                                        @foreach($states as $state)<option value="{{$state->code }}"> {{$state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('state_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="district_id">{{ __('District') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['district'] ?? ''}}</p>
                                    @else
                                    <select class="form-control required" id="district_id" name="district_id"
                                        onchange="getSubDistrictByDistrict(this.value,'') ;  getBlockByDistricts(this.value,'')">
                                        <option value="">Select District</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sub_district_id">{{ __('Sub District') }} <span
                                            class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['sub_district'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="sub_district_id" name="sub_district_id"
                                        onchange="getVillageBySubDistrict(this.value,'')">
                                        <option value="" selected disabled>Select Sub-District</option>

                                    </select>
                                    <span class="text-danger">{{ $errors->first('sub_district_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="block">{{ __('Block') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['block'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="block_id" name="block"
                                        onchange="getVillageBySubDistrict(this.value,'')">
                                        <option value="" selected disabled>Select Block</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('block') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="village">{{ __('Village') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['village'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="village_id" name="village">
                                        <option value="" selected disabled>Select Village</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('village') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="panchayat_id">{{ __('Localbody Type') }} <span
                                            class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['panchayat'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="localbody_id" name="localbody_type"
                                        onchange="getPanchayatByLocalbodies(this.value,'')">
                                        <option value="">Select </option>
                                        <option value="1">RURAL</option>
                                        <option value="2">URBAN</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('localbody_type') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="panchayat_id">{{ __('Panchayat') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['panchayat'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="panchayat_id" name="panchayat"
                                        onchange="getWardByPanchayat(this.value,'')">
                                        <option value="">Select Panchayat</option>
                                        <!-- <option value="A"> 1</option>
                                <option value="B"> 2</option>
                                <option value="C"> 3</option> -->
                                    </select>
                                    <span class="text-danger">{{ $errors->first('panchayat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ward_no">{{ __('Ward No.') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['ward_no'] ?? ''}}</p>
                                    @else
                                    <select class="form-control  required" id="ward_id" name="ward_no">
                                        <option value="">Select Ward</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('ward_no') }}</span>
                                    <!-- <input type="text" {{$editable ?? ''}} class="form-control required" name="ward_no"
                                value="{{$consumer['ward_no'] ?? ''}}"> -->
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="post">{{ __('Post office') }} <span class="error">*</span></label>
                                    @if (($editable ?? '') == 'disabled')
                                    <p>{{$consumer['post'] ?? ''}}</p>
                                    @else
                                    <input type="text" {{$editable ?? ''}} class="form-control required" name="post"
                                        value="{{$consumer['post'] ?? ''}}">
                                    <span class="text-danger">{{ $errors->first('post') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="house_no">{{ __('House No.') }} <span class="error">*</span></label>
                                        @if (($editable ?? '') == 'disabled')
                                        <p>{{$consumer['house_no'] ?? ''}}</p>
                                        @else
                                        <input type="text" {{$editable ?? ''}} class="form-control required"
                                            name="house_no" value="{{$consumer['house_no'] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('house_no') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label class="headLebels">Other Details</label>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="toilet_linked">{{ __('Do you require toilet linked biogas plants?') }}
                                            <span class="error">*</span></label>
                                        @if (($editable ?? '') == 'disabled')
                                        @if(($consumer['toilet_linked'] ?? '') == 1)
                                        <p>Yes</p>
                                        @else
                                        <p>No</p>
                                        @endif
                                        @else
                                        <input class="form-check-input" type="radio" name="toilet_linked"
                                            id="type_project" value="1" />
                                        <label class="form-check-label" for="">Yes</label>
                                        <input class="form-check-input" type="radio" name="toilet_linked"
                                            id="type_project" value="0" />
                                        <label class="form-check-label" for="">No</label>
                                        <span class="text-danger">{{ $errors->first('toilet_linked') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="existing_biogas_plant">{{ __('Do you already have a biogas plant installed?') }}
                                            <span class="error">*</span></label>
                                        @if (($editable ?? '') == 'disabled')
                                        @if(($consumer['existing_biogas_plant'] ?? '') == 1)
                                        <p>Yes</p>
                                        @else
                                        <p>No</p>
                                        @endif
                                        @else
                                        <input class="form-check-input" type="radio" name="existing_biogas_plant"
                                            id="type_project" value="1" />
                                        <label class="form-check-label" for="">Yes</label>
                                        <input class="form-check-input" type="radio" name="existing_biogas_plant"
                                            id="type_project" value="0" />
                                        <label class="form-check-label" for="">No</label>
                                        <span class="text-danger">{{ $errors->first('existing_biogas_plant') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label
                                            for="slurry_filter_unit">{{ __('Do you require biogas slurry filter unit?') }}
                                            <span class="error">*</span></label>
                                        @if (($editable ?? '') == 'disabled')
                                        @if(($consumer['slurry_filter_unit'] ?? '') == 1)
                                        <p>Yes</p>
                                        @else
                                        <p>No</p>
                                        @endif
                                        @else
                                        <input class="form-check-input" type="radio" name="slurry_filter_unit"
                                            id="type_project" value="1" />
                                        <label class="form-check-label" for="">Yes</label>
                                        <input class="form-check-input" type="radio" name="slurry_filter_unit"
                                            id="type_project" value="0" />
                                        <label class="form-check-label" for="">No</label>
                                        <span class="text-danger">{{ $errors->first('slurry_filter_unit') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Number of cattle available<span class="error">*</span></label>
                                    <input class="form-check-input" type="radio" name="cattle_available" checked
                                        id="type_project" value="0" />
                                    <label class="form-check-label" for="">No</label>
                                    <input class="form-check-input" type="radio" name="cattle_available"
                                        id="type_project" value="1" />
                                    <label class="form-check-label" for="">Yes</label>
                                    <span class="text-danger">{{ $errors->first('cattle_available') }}</span>
                                </div>
                                <span id="cattle_id" style="display:none">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <input type="text" class="form-control required"
                                                name="number_of_cattles[BuffaloesBig]" placeholder="Buffaloes (Big)"
                                                onkeypress="return isNumber(event)" value="0">
                                            <span class="text-danger">{{ $errors->first('number_of_cattles') }}</span>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if (($editable ?? '') == 'disabled')
                                            <p>Buffaloes (small) :
                                                {{$consumer['number_of_cattle']['buffaloes']['small'] ?? ''}}</p>
                                            @else
                                            <input type="text" {{$editable ?? ''}} class="form-control required"
                                                name="number_of_cattles[BuffaloesSmall]" placeholder="Buffaloes (Small)"
                                                onkeypress="return isNumber(event)" value="0">
                                            <span
                                                class="text-danger">{{ $errors->first('cattles[buffaloes][small]') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if (($editable ?? '') == 'disabled')
                                            <p>Cows (big) : {{$consumer['number_of_cattle']['cows']['big'] ?? ''}}</p>
                                            @else
                                            <input type="text" {{$editable ?? ''}} class="form-control required"
                                                name="number_of_cattles[CowsBig]" placeholder="Cows (Big)"
                                                onkeypress="return isNumber(event)" value="0">
                                            <span class="text-danger">{{ $errors->first('cattles[cows][big]') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            @if (($editable ?? '') == 'disabled')
                                            <p>Cows (small) : {{$consumer['number_of_cattle']['cows']['small'] ?? ''}}
                                            </p>
                                            @else
                                            <input type="text" {{$editable ?? ''}} class="form-control required"
                                                name="number_of_cattles[CowsSmall]" placeholder="Cows (Small)"
                                                onkeypress="return isNumber(event)" value="0">
                                            <span
                                                class="text-danger">{{ $errors->first('cattles[cows][small]') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </span>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="comment">{{ __('Comment') }}</label>
                                        @if (($editable ?? '') == 'disabled')
                                        <p>{{$consumer['comment'] ?? ''}}</p>
                                        @else
                                        <textarea class="form-control" {{$editable ?? ''}} name="comment" cols="30"
                                            rows="4"
                                            placeholder="Write here...">{{$consumer['comment'] ?? ''}}</textarea>
                                        @endif
                                        <input type="checkbox" id="" name="authorized" value="1">
                                        <label for="vehicle1"> I authorize that entered information in proposal are
                                            correct and verified</label> <br>
                                        <span class="text-danger">{{ $errors->first('authorized') }}</span>
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- <input type="submit" {{$editable ?? ''}}
                                            class="mt-1 btn btn-info @isset($editable) hidden @endisset" value="Cancel"> -->
                                        <a href="{{URL::to('smallBiogasPlants')}}" {{$editable ?? ''}}
                                            class="mt-1 btn btn-info @isset($editable) hidden @endisset"> Cencel</a>
                                        <input type="submit" {{$editable ?? ''}}
                                            class="mt-1 btn btn-primary @isset($editable) hidden @endisset"
                                            value="Submit"
                                            onclick="if (confirm('Are You Sure ? Once You Submit Your Application, You Will Not Update it Latter')) {}else{return false;}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.consumerInstallerAssociation')
@endsection

@section('scripts')

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
</script>
@endsection