// $(document).ready(function () {
//     $('#state_id').on('change', function () { // state jo h form m id le rahe h
//         var stateID = $(this).val();
//         var districtData = '<option value="">Select District</option>';
//         if (stateID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/district/' + stateID,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         districtData += '<option value="' + value.code +
//                             '">' + value.name +
//                             '</option>';
//                     });
//                     $('#district_id').html(districtData);
//                 }
//             });
//         }
//     });
// });

function getDistrictByState(state_id, district_id) {
    var stateID = state_id;
    $('#sub_district_id').html("<option value=''>Select Sub District</option>");
    $('#block_id').html("<option value=''>Select Block</option>");
    $('#village_id').html("<option value=''>Select Village</option>");
    $('#panchayat_id').html("<option value=''>Select Panchayat</option>");
    $('#ward_id').html("<option value=''>Select Ward</option>");
    var districtData = '<option value="">Select District</option>';
    if (stateID) {
        $.ajax({

            type: 'GET',
            url: baseUrl + '/ajax/district/' + stateID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.code == district_id) { flg = 'selected'; }
                    districtData += '<option value="' + value.code +
                        '" ' + flg + '>' + value.name +
                        '</option>';
                });

                $('#district_id').html(districtData);
            }
        });
    }
}
function getSubDistrictByDistrict(district_id, sub_district_id) {
    var districtID = district_id;
    //$('#localbody_id').val("");
    var subDistrictData = '<option value="">Select Sub District</option>';
    if (districtID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/SubDistricts/' + districtID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.code == sub_district_id) { flg = 'selected'; }
                    subDistrictData += '<option value="' + value.code +
                        '"' + flg + '>' + value.name +
                        '</option>';
                });
                $('#sub_district_id').html(subDistrictData);
            }
        });
    }
}
// $(document).ready(function () {
//     $('#district_id').on('change', function () { // state jo h form m id le rahe h
//         var districtID = $(this).val();
//         var subDistrictData = '<option value="">Select Sub District</option>';
//         if (districtID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/SubDistricts/' + districtID,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         subDistrictData += '<option value="' + value.code +
//                             '">' + value.name +
//                             '</option>';
//                     });
//                     $('#sub_district_id').html(subDistrictData);
//                 }
//             });
//         }
//     });
// });
function getBlockByDistricts(district_id, block_id) {
    var districtID = district_id;
    var blockData = '<option value="">Select block </option>';
    if (districtID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/block/' + districtID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.code == block_id) { flg = 'selected'; }
                    blockData += '<option value="' + value.code +
                        '" ' + flg + '>' + value.name +
                        '</option>';
                });
                $('#block_id').html(blockData);
            }
        });
    }
}
// $(document).ready(function () {
//     $('#district_id').on('change', function () { // state jo h form m id le rahe h
//         var districtID = $(this).val();
//         var blockData = '<option value="">Select block </option>';
//         if (districtID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/block/' + districtID,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         blockData += '<option value="' + value.code +
//                             '">' + value.name +
//                             '</option>';
//                     });
//                     $('#block_id').html(blockData);
//                 }
//             });
//         }
//     });
// });
// function getBlockByDistrict() {
//     var districtID = $('#district_id').val();
//     var blockData = '<option value="">Select block </option>';
//     if (districtID) {
//         $.ajax({
//             type: 'GET',
//             url: baseUrl + '/ajax/block/' + districtID,
//             //data: 'state_id=' + stateID,
//             success: function(data) {
//                 $.each(data, function(index, value) {
//                     // statements
//                     blockData += '<option value="' + value.code +
//                         '">' + value.name +
//                         '</option>';
//                 });
//                 $('#block_id').html(blockData);
//             }
//         });
//     }
// }
function getVillageBySubDistrict(sub_district_id, village_id) {

    var subDistrictID = sub_district_id;
    var villageData = '<option value="">Select Village </option>';
    if (subDistrictID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/village/' + subDistrictID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements

                    var flg = '';
                    if (value.code == village_id) { flg = 'selected'; }
                    villageData += '<option value="' + value.code +
                        '" ' + flg + '>' + value.name +
                        '</option>';
                });
                $('#village_id').html(villageData);
            }
        });
    }
}
// $(document).ready(function () {
//     $('#sub_district_id').on('change', function () { // state jo h form m id le rahe h
//         var subDistrictID = $(this).val();
//         var villageData = '<option value="">Select Village </option>';
//         if (subDistrictID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/village/' + subDistrictID,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         villageData += '<option value="' + value.code +
//                             '">' + value.name +
//                             '</option>';
//                     });
//                     $('#village_id').html(villageData);
//                 }
//             });
//         }
//     });
// });
function getPanchayatByLocalbodies(localbody_id, panchayat_id) {
    var panchayatID = localbody_id;
    var stateId = $('#state_id').val();
    var panchayatData = '<option value="">Select Panchayat </option>';
    if (panchayatID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/panchayat/' + panchayatID + '/' + stateId,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.code == panchayat_id) { flg = 'selected'; }
                    panchayatData += '<option value="' + value.code +
                        '" ' + flg + '>' + value.localbody_name +
                        '</option>';
                });
                $('#panchayat_id').html(panchayatData);
            }
        });
    }
}

// $(document).ready(function () {
//     $('#localbody_id').on('change', function () { // state jo h form m id le rahe h
//         var panchayatID = $(this).val();
//         var stateId = $('#state_id').val();
//         var panchayatData = '<option value="">Select Panchayat </option>';
//         if (panchayatID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/panchayat/' + panchayatID + '/' + stateId,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         panchayatData += '<option value="' + value.code +
//                             '">' + value.localbody_name +
//                             '</option>';
//                     });
//                     $('#panchayat_id').html(panchayatData);
//                 }
//             });
//         }
//     });
// });
function getWardByPanchayat(panchayat_id, ward_id) {
    var wardID = panchayat_id;
    var wardData = '<option value="">Select Ward </option>';
    if (wardID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + '/ajax/ward/' + wardID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.code == ward_id) { flg = 'selected'; }
                    wardData += '<option value="' + value.code +
                        '" ' + flg + '>Ward No.:' + value.ward_number +
                        ' (' + value.ward_name +
                        ')</option>';
                });
                $('#ward_id').html(wardData);
            }
        });
    }

}

// $(document).ready(function () {
//     $('#panchayat_id').on('change', function () { // state jo h form m id le rahe h
//         var wardID = $(this).val();
//         var wardData = '<option value="">Select Ward </option>';
//         if (wardID) {
//             $.ajax({
//                 type: 'GET',
//                 url: baseUrl + '/ajax/ward/' + wardID,
//                 //data: 'state_id=' + stateID,
//                 success: function (data) {
//                     $.each(data, function (index, value) {
//                         // statements
//                         wardData += '<option value="' + value.code +
//                             '">Ward No.:' + value.ward_number +
//                             ' (' + value.ward_name +
//                             ')</option>';
//                     });
//                     $('#ward_id').html(wardData);
//                 }
//             });
//         }
//     });
// });
function getLastMonthReportData(type, month, year, id) {
    // alert(type + '-' + month + '-' + year);
    if (confirm('Do you want to copy previous month report?')) {
        if (type) {
            $.ajax({
                type: 'GET',
                url: baseUrl + '/beneficiary/checked-previous-report/' + type + '/' + month + '/' + year + '/' + id,
                //data: 'state_id=' + stateID,
                success: function (data) {
                    //alert(data.status);
                    if (data.status == 'success') {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }


                }
            });
        }
    }

}