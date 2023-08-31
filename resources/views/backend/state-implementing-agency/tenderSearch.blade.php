<div class="row">
    <div class="col-xl-2 col-lg-6 col-md-12 pb-3">
        <div class=""><label>Select Tender <span class="text-danger">*</span></label></div>

    </div>
    <div class="col-xl-10 col-lg-6 col-md-12 pb-3">
        <div class=""> @if(!$tenderList->isEmpty())
            <select name="tender" id="tender" class="form-control tenderSelectBox"
                style="width:90%;display: inline-block;">
                <option value="">Select Tender</option>
                @foreach($tenderList as $tender)
                <option value="{{ base64_encode($tender->id) }}">
                    {{ $tender->nit_no }} - [{{ $tender->tender_no }}]
                </option>
                @endforeach
            </select>
            <!-- <button class="btn btn-primary" id="searchTender" on>Search</button> -->
            @else
            <span class="text-danger">No Tender Found. Please <a href="">Click Here</a> to Add Tender</span>
            @endif
        </div>
    </div>
    <hr><br>
    <span id="tenderDetails"></span>
</div>