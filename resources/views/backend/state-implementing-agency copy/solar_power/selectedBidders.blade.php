        <div id="home" class=" tab-pane active">
            <div>
                <div class="clearfix"></div><br>
                <div class="col-md-12 col-sm-12">
                    <div class="input-group date">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Company Name<span class="text-danger">*</span></th>
                                    <th class="text-center">Selected Bidders Capacity (MW)<span
                                            class="text-danger">*</span></th>
                                    <th class="text-center">Date of LoI/LoA<span class="text-danger">*</span></th>
                                    <th class="text-center">Tariff<span class="text-danger">*</span></th>
                                    <th class="text-center">Date of PPA/PSA<span class="text-danger">*</span></th>
                                    <th class="text-center">PPA/PSA Capacity (MW)<span class="text-danger">*</span></th>
                                    <th class="text-center">Name of State in PPA/PSA Signed<span
                                            class="text-danger">*</span></th>
                                    <th class="text-center">Name of DISCOM who have signed PPA/PSA<span
                                            class="text-danger">*</span></th>
                                    <th class="text-center">Per Unit cost of electricity as per said PPA<span
                                            class="text-danger">*</span></th>
                                    <th class="text-center">Duration of PPA<span class="text-danger">*</span></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if($generalData['selectedBidders']!='')
                                @for($i=0;$i<=count($generalData['selectedBidders']['company_name'])-1;$i++) <tr id="">
                                    <td class="row-index text-center">
                                        <input type="text" placeholder="Name" name="company_name[]"
                                            id="txtgeneralLatitude" class="form-control  number"
                                            value="{{$generalData['selectedBidders']['company_name'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                    </td>

                                    <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                                            id="txtgeneralLatitude" class="form-control"
                                            value="{{$generalData['selectedBidders']['select_bidders_capacity'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('select_bidders_capacity') }}</span>
                                    </td>

                                    <td><input type="date" class="form-control pull-right alldatepicker "
                                            id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="loi_loa_date[]"
                                            value="{{$generalData['selectedBidders']['loi_loa_date'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
                                    </td>

                                    <td><input type="number" placeholder="" step="any" min="0" name="tariff[]"
                                            id="txtgeneralLatitude" class="form-control  number"
                                            value="{{$generalData['selectedBidders']['tariff'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('tariff') }}</span>
                                    </td>

                                    <td> <input type="date" class="form-control pull-right alldatepicker "
                                            id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="ppa_psa_date[]"
                                            value="{{$generalData['selectedBidders']['ppa_psa_date'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_psa_date') }}</span>
                                    </td>

                                    <td> <input type="number" step="any" min="0" name="ppa_psa_capacity[]"
                                            id="txtgeneralLatitude" class="form-control"
                                            value="{{$generalData['selectedBidders']['ppa_psa_capacity'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_psa_capacity') }}</span>
                                    </td>

                                    <td> <input type="text" placeholder="Name" name="ppa_psa_state_name[]"
                                            id="txtgeneralLatitude" class="form-control  number"
                                            value="{{$generalData['selectedBidders']['ppa_psa_state_name'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_psa_state_name') }}</span>
                                    </td>

                                    <td> <input type="text" placeholder="Name" name="ppa_signed_discom_name[]"
                                            id="txtgeneralLatitude" class="form-control  number"
                                            value="{{$generalData['selectedBidders']['ppa_signed_discom_name'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_signed_discom_name') }}</span>
                                    </td>

                                    <td> <input type="number" placeholder="per Unit Cost" name="ppa_electricity_unit[]"
                                            id="txtgeneralLatitude" class="form-control  number" step="any"
                                            value="{{$generalData['selectedBidders']['ppa_electricity_unit'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_electricity_unit') }}</span>
                                    </td>

                                    <td> <input type="text" placeholder="PPA Duration" name="ppa_duration[]"
                                            id="txtgeneralLatitude" class="form-control  number"
                                            value="{{$generalData['selectedBidders']['ppa_duration'][$i] ?? ''}}">
                                        <span class="text-danger">{{ $errors->first('ppa_duration') }}</span>
                                    </td>

                                    <td class="text-center">
                                        @if($i>0)
                                        <button class="btn btn-md btn-primary" id="addBtn" type="button">
                                            Add new Row
                                        </button>
                                        @else
                                        <button class="btn btn-danger remove" type="button">Remove</button>
                                        @endif
                                    </td>
                                    </tr>
                                    @endfor
                                    @else
                                    <tr id="">
                                        <td class="row-index text-center">
                                            <input type="text" placeholder="Name" name="company_name[]"
                                                id="txtgeneralLatitude" class="form-control  number" value="">
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                        </td>

                                        <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                                                id="txtgeneralLatitude" class="form-control" value="">
                                            <span
                                                class="text-danger">{{ $errors->first('select_bidders_capacity') }}</span>
                                        </td>

                                        <td><input type="date" class="form-control pull-right alldatepicker "
                                                id="txtdate_commissioning" placeholder="MM-DD-YYYY"
                                                name="loi_loa_date[]" value="">
                                            <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
                                        </td>

                                        <td><input type="number" placeholder="" step="any" min="0" name="tariff[]"
                                                id="txtgeneralLatitude" class="form-control  number" value="">
                                            <span class="text-danger">{{ $errors->first('tariff') }}</span>
                                        </td>

                                        <td> <input type="date" class="form-control pull-right alldatepicker "
                                                id="txtdate_commissioning" placeholder="MM-DD-YYYY"
                                                name="ppa_psa_date[]" value="">
                                            <span class="text-danger">{{ $errors->first('ppa_psa_date') }}</span>
                                        </td>

                                        <td> <input type="number" step="any" min="0" name="ppa_psa_capacity[]"
                                                id="txtgeneralLatitude" class="form-control" value="">
                                            <span class="text-danger">{{ $errors->first('ppa_psa_capacity') }}</span>
                                        </td>

                                        <td> <input type="text" placeholder="Name" name="ppa_psa_state_name[]"
                                                id="txtgeneralLatitude" class="form-control  number" value="">
                                            <span class="text-danger">{{ $errors->first('ppa_psa_state_name') }}</span>
                                        </td>

                                        <td> <input type="text" placeholder="Name" name="ppa_signed_discom_name[]"
                                                id="txtgeneralLatitude" class="form-control  number" value="">
                                            <span
                                                class="text-danger">{{ $errors->first('ppa_signed_discom_name') }}</span>
                                        </td>

                                        <td> <input type="number" placeholder="per Unit Cost"
                                                name="ppa_electricity_unit[]" id="txtgeneralLatitude"
                                                class="form-control  number" step="any" value="">
                                            <span
                                                class="text-danger">{{ $errors->first('ppa_electricity_unit') }}</span>
                                        </td>

                                        <td> <input type="text" placeholder="PPA Duration" name="ppa_duration[]"
                                                id="txtgeneralLatitude" class="form-control  number" value="">
                                            <span class="text-danger">{{ $errors->first('ppa_duration') }}</span>
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-md btn-primary" id="addBtn" type="button">
                                                Add new Row
                                            </button>
                                        </td>
                                    </tr>

                                    @endif
                            </tbody>
                        </table>
                    </div>
                    <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                // Denotes total number of rows
                var rowIdx = 0;
                // jQuery button click event to add a row
                $('#addBtn').on('click', function() {
                    // Adding a row inside the tbody.
                    $('#tbody').append(`<tr id="R${++rowIdx}">
                    
                    <td class="row-index text-center">
                             <input type="text" placeholder="Name" name="company_name[]" id="txtgeneralLatitude"
                                        class="form-control  number"
                                        value="">
                                    <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                </td>
                                
                                <td> <input type="number" step="any" min="0" name="select_bidders_capacity[]"
                                        id="txtgeneralLatitude" class="form-control"
                                        value="">
                                    <span class="text-danger">{{ $errors->first('select_bidders_capacity') }}</span>
                                </td>

                                <td> <input type="date" class="form-control pull-right alldatepicker "
                                        id="txtdate_commissioning" placeholder="MM-DD-YYYY" name="loi_loa_date[]"
                                        value="">
                                    <span class="text-danger">{{ $errors->first('loi_loa_date') }}</span>
                                </td>

                                <td><input type="number" placeholder="" step="any" min="0" name="tariff[]" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                    <span class="text-danger">{{ $errors->first('tariff') }}</span>
                                </td>

                                <td> <input type="date" class="form-control pull-right alldatepicker " id="txtdate_commissioning"
                                        placeholder="MM-DD-YYYY" name="ppa_psa_date[]"
                                        value="">
                                    <span class="text-danger">{{ $errors->first('ppa_psa_date') }}</span>
                                </td>
                                
                                 <td> <input type="number" step="any" min="0" name="ppa_psa_capacity[]" id="txtgeneralLatitude" class="form-control"
                                    value="">
                                  <span class="text-danger">{{ $errors->first('ppa_psa_capacity') }}</span>
                                </td>

                                <td> <input type="text" placeholder="Name" name="ppa_psa_state_name[]" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                    <span class="text-danger">{{ $errors->first('ppa_psa_state_name') }}</span>
                                </td>

                                <td> <input type="text" placeholder="Name" name="ppa_signed_discom_name[]" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                    <span class="text-danger">{{ $errors->first('ppa_signed_discom_name') }}</span>
                                </td>

                                <td> <input type="number" placeholder="per Unit Cost" step="any" name="ppa_electricity_unit[]" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                    <span class="text-danger">{{ $errors->first('ppa_electricity_unit') }}</span>
                                </td>

                                <td> <input type="text" placeholder="PPA Duration" name="ppa_duration[]" id="txtgeneralLatitude"
                                        class="form-control  number" value="">
                                    <span class="text-danger">{{ $errors->first('ppa_duration') }}</span>
                                </td>
                                  
                                <td class="text-center">
                                    <button class="btn btn-danger remove"
                                    type="button">Remove</button>
                                    </td>
                                </tr>`);
                });
                // jQuery button click event to remove a row.
                $('#tbody').on('click', '.remove', function() {
                    // Getting all the rows next to the row
                    // containing the clicked button
                    var child = $(this).closest('tr').nextAll();
                    // Iterating across all the rows
                    // obtained to change the index
                    child.each(function() {
                        // Getting <tr> id.
                        var id = $(this).attr('id');
                        // Getting the <p> inside the .row-index class.
                        var idx = $(this).children('.row-index').children('p');
                        // Gets the row number from <tr> id.
                        var dig = parseInt(id.substring(1));
                        // Modifying row index.
                        idx.html(`Row ${dig - 1}`);

                        // Modifying row id.
                        $(this).attr('id', `R${dig - 1}`);
                    });
                    // Removing the current row.
                    $(this).closest('tr').remove();
                    // Decreasing total number of rows by 1.
                    rowIdx--;
                });
            });
            </script>
        </div>