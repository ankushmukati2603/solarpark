$(function () {
    $('.dropdown-toggle').dropdown()
    $('.sidebar-toggle').click(function () {
        if ($(this).data('state') == '1') {
            $('#footer').css('margin-left', '50px')
            $(this).data('state', '0')
        } else {
            $('#footer').css('margin-left', '230px')
            $(this).data('state', '1')
        }
    })
    $('#btnchkStatus').click(() => {
        let appId = $('#hdAppId').val()
        if (appId !== '') {
            $('#error-req').html('')
            $('.small-spinner').css({ display: 'block' })
            $.ajax({
                type: 'GET',
                url: baseUrl + 'ajax/checkapplicationstatus/' + appId,
                success: (resp) => {
                    $('.small-spinner').css({ display: 'none' })
                    $('#appStatus').html('<label>Status</label><p>' + resp + '</p>')
                }
            })
        } else {
            $('#error-req').html('Enter application id')
            $('#appStatus').html('')
        }
    })
})
//////////////////////////////////////////////////////////////////////////////////////////////////////
let checkSignStampFile = () => {
    if ($('#inpFileSigStamp').val() == '') {
        $('#fileSigStamp').css('border-color', '#f63a3a')
        $('#signstamperror').show()
    } else if ($('#formRegister').valid()) $('#formRegister').submit()
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function startTime() {
    var today = new Date()
    var h = today.getHours()
    var m = today.getMinutes()
    var s = today.getSeconds()
    var d = today.getDate()
    var M = today.getMonth() + 1
    var y = today.getFullYear()
    document.getElementById('datetime').innerHTML =
        checkTime(d) +
        '-' +
        checkTime(M) +
        '-' +
        y +
        '   ' +
        checkTime(h) +
        ':' +
        checkTime(m) +
        ':' +
        checkTime(s)
    var t = setTimeout(startTime, 500)
}

function checkTime(i) {
    if (i < 10) {
        i = '0' + i
    } // add zero in front of numbers < 10
    return i
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function OpenMenu() {
    $('.mobile-menu').css({ display: 'block' })
}

function CloseMenu() {
    $('.mobile-menu').css({ display: 'none' })
}

$(function () {
    $('.mobileMenuStatus').click(function () {
        $('.mobile-menu').css({ display: 'none' })
    })
})
////////////////////////////////////////////////////////////////////////////////////////////////////
function redirectOnLogout() {
    if (localStorage.getItem('active-session') == 'Y') {
        $.ajax({
            type: 'GET',
            url: baseUrl + 'ajax/checksession',
            success: (resp) => {
                if (!resp.success) {
                    location.reload()
                }
            }
        })
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function makeid(length) {
    var result = ''
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'
    var charactersLength = characters.length
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength))
    }
    return result
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function mysql_date_format(date) {
    date = date.split('-')
    return date[2] + '-' + date[1] + '-' + date[0]
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function fetchCities(stateSelectBox, districtSelectBox) {
    let state = stateSelectBox.value
    ajaxcall('GET', {}, baseUrl + 'ajax/fetchCities/' + state).then((resp) => {
        setDropdownHtml(resp, districtSelectBox)
    })
}



function fetchSubDistricts(districtSelectBox, SubDistrictSelectBox) {
    let district = districtSelectBox.value
    ajaxcall('GET', {}, baseUrl + 'ajax/fetchSubDistricts/' + district).then((resp) => {
        setDropdownHtml(resp, SubDistrictSelectBox)
    })
}

function fetchblocks(districtSelectBox, blocksSelectBox) {
    let district = districtSelectBox.value
    ajaxcall('GET', {}, baseUrl + 'ajax/fetchblocks/' + district).then((resp) => {
        setDropdownHtmlnew(resp, blocksSelectBox)
    })
}

function fetchvillages(SubDistrictSelectBox, VillagesSelectBox) {
    let subdistrict = SubDistrictSelectBox.value
    ajaxcall('GET', {}, baseUrl + 'ajax/fetchvillages/' + subdistrict).then((resp) => {
        setDropdownHtml(resp, VillagesSelectBox)
    })
}

// Panchayat

function getPanchayatByLocalbodies(localbody_id, panchayat_id) {
    var panchayatID = localbody_id;
    var stateId = $('#txtstate').val();
    var panchayatData = '<option value="">Select Panchayat </option>';
    if (panchayatID) {
        $.ajax({
            type: 'GET',
            url: baseUrl + 'ajax/fetchpanchayat/' + stateId + '/' + panchayatID,
            //data: 'state_id=' + stateID,
            success: function (data) {
                $.each(data, function (index, value) {
                    // statements
                    var flg = '';
                    if (value.local_body_code == panchayat_id) { flg = 'selected'; }
                    panchayatData += '<option value="' + value.code +
                        '" ' + flg + '>' + value.name +
                        '</option>';
                });
                $('#panchayat_id').html(panchayatData);
            }
        });
    }
}




////////////////////////////////////////////////////////////////////////////////////////////////////
function setDropdownHtml(dataArray, selectBox) {
    let html = '<option disabled selected>Select</option>'
    $.each(dataArray, (index, node) => {
        html += '<option value="' + node.code + '">' + node.name + '</option>'
    })
    $('#' + selectBox).html(html)
}

function setDropdownHtmlnew(dataArray, selectBox) {
    let html = '<option disabled selected>Select</option>'
    $.each(dataArray, (index, node) => {
        html += '<option value="' + node.block_code + '">' + node.block_name + '</option>'
    })
    $('#' + selectBox).html(html)
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function ajaxcall(method, params, url) {
    $('#loader').css({ display: 'block' })
    return new Promise((resolve, reject) => {
        $.ajax({
            type: method,
            data: params,
            url: url,
            success: (resp) => {
                $('#loader').css({ display: 'none' })
                resolve(resp)
            },
            error: (resp) => {
                reject(resp)
            }
        })
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
$('.sNc').click(function () {
    validator.destroy()
    validator = $('#' + $(this).data('form')).validate()
    if ($('#' + $(this).data('form')).valid()) {
        saveNContinue($(this))
    }
})
////////////////////////////////////////////////////////////////////////////////////////////////////
function saveNContinue(tabButton) {
    let form = fillFormData()
    ajaxcall('POST', form, baseUrl + 'ajax/addeditapplication').then((resp) => {
        $('#appID').val(resp)
        $('#' + tabButton.data('tabination') + ' li a[href$=' + tabButton.data('next') + ']').tab(
            'show'
        )
        $('html, body').animate({ scrollTop: 0 }, 100)
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function setCounter(secs, type) {
    var counter = setInterval(function setCounter() {
        let mins = Math.trunc(secs / 60)
        let rem_secs = secs - mins * 60
        if (mins == 0 && rem_secs == 0) {
            clearInterval(counter)
            resendActive(type)
        } else {
            secs--
            time =
                (mins < 10 ? '0' + mins : mins) + ':' + (rem_secs < 10 ? '0' + rem_secs : rem_secs)
            switch (type) {
                case 'E':
                    $('#spnEmail').text(time)
                    break
                case 'M':
                    $('#spnPhone').text(time)
                    break
            }
        }
    }, 1000)
}

function resendActive(type) {
    switch (type) {
        case 'E':
            $('#spnEmail').text('00:00')
            $('#resend-email-otp').css({ color: '#466dbb', cursor: 'pointer' }).data('en', 'en')
            break
        case 'M':
            $('#spnPhone').text('00:00')
            $('#resend-phone-otp').css({ color: '#466dbb', cursor: 'pointer' }).data('en', 'en')
            break
    }
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function eventResend() {
    $('.resend').click(function () {
        if ($(this).data('en') != 'dis') {
            let type = $(this).data('type')
            let elem
            ajaxcall('GET', {}, baseUrl + 'ajax/resendotp/' + type).then((resp) => {
                if (resp.success) {
                    let elem
                    switch (type) {
                        case 'E':
                            elem = $('#resend-email-otp')
                            break
                        case 'M':
                            elem = $('#resend-phone-otp')
                            break
                    }
                    elem.css({ color: 'grey', cursor: 'not-allowed' })
                    elem.data('en', 'dis')
                    setCounter(120, type)
                }
            })
        }
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function handleOtpVerification(data) {
    ajaxcall('POST', data, 'ajax/checkotp').then((resp) => {
        if (resp.E) {
            $('#txtEmail').attr('style', 'border-color:green!important')
            emailOtpValid = true
        } else {
            $('#txtEmail').attr('style', 'border-color:red!important')
            emailOtpValid = false
        }
        if (resp.M) {
            $('#txtPhone').attr('style', 'border-color:green!important')
            phoneOtpValid = true
        } else {
            $('#txtPhone').attr('style', 'border-color:red!important')
            phoneOtpValid = false
        }
        if (emailOtpValid && phoneOtpValid) {
            $('#formRegister').submit()
        }
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function fetchLogs(AppCode, type) {
    ajaxcall('POST', { AppCode: btoa(AppCode) }, baseUrl + 'ajax/fetchlogs').then((resp) => {
        docCodes = null
        $.getJSON(baseUrl + 'public/js/document_codes.json', function (json) {
            docCodes = json
            let html = makeLogsHtml(resp)
            if (type == 'modal') {
                $('#log-app-code').text(AppCode)
                $('#log-container').html(html)
                $('#logsModal').modal('show')
            } else if (type == 'tab') {
                $('#log-container').removeClass('log-box')
                $('#log-container').html(html)
            }
            activateLogClose()
        })
    })
}

function makeLogsHtml(logs) {
    let html = ''
    if (logs.length) {
        $.each(logs, (indx, log) => {
            let logReview = JSON.parse(log.review)
            html +=
                '<div id="logPanel' +
                log.id +
                '" class="col-md-12 feedback-box ' +
                (log.status == 0 ? 'open' : 'closed') +
                '">'
            html +=
                '<h4>' +
                (log.type == 'FD'
                    ? 'Feedback'
                    : log.type == 'AC'
                        ? 'Application accepted'
                        : log.type == 'AP'
                            ? 'Approved & Sanctioned'
                            : log.type == 'RJ'
                                ? 'Rejected'
                                : log.type == 'CM'
                                    ? 'Commissioned'
                                    : '') +
                ' <span id="spn' +
                log.id +
                '" class="label label-' +
                (log.status == 0 ? 'danger' : 'success') +
                ' pull-right">' +
                (log.status == 0 ? 'Open' : 'Closed') +
                '</span></h4>'
            html +=
                '<span><b>Stage: </b> ' +
                (log.stage == 1 ? 'Application' : 'Commissioning') +
                '</span>'
            html +=
                '<span class="ml-10 blue"><b>Initiated On: </b> <i class="fa fa-calendar" aria-hidden="true"></i> ' +
                log.created_at +
                '</span>'
            html += '<span id="closedOn' + log.id + '">'
            if (log.closed_at != null)
                html +=
                    '<span class="ml-10 red"><b>Closed On: </b> <i class="fa fa-calendar" aria-hidden="true"></i> ' +
                    log.closed_at +
                    '</span>'
            html += '</span>'
            html += '<div class="clearfix"></div>'
            html += '<span><b>By: </b> ' + log.created_by + '</span><br>'
            html += '<div class="mt-20">'
            if (logReview.comment != null || logReview.comment != undefined) {
                html += '<label>Comments:   </label><br><ul>'
                logReview.comment = JSON.parse(logReview.comment)
                $.each(logReview.comment, (key, val) => {
                    html += val != null ? '<li><label>' + key + ': </label> ' + val + '</li>' : ''
                })
                html += '</ul>'
            }
            if (log.review_doc != null) {
                html +=
                    '<label>Review Document(from MNRE):   </label>' +
                    '<a class="' +
                    (log.status == 0 ? 'closelog' : '') +
                    '" data-ref="' +
                    btoa(log.id) +
                    '" href="' +
                    baseUrl +
                    'storage/documents/' +
                    log.apptype +
                    '/' +
                    log.app_code +
                    '/reviewdocs/' +
                    log.review_doc +
                    '" target="_blank"> View</a>' +
                    '<br>'
            }
            if (log.mom != null || log.mom != null)
                html += '<label>PAC meeting MoM: </label>' + log.mom + '<br>'

            if (logReview.documents != null) {
                html += '<label>Problem with following Documents</label>'
                html += '<ul>'
                $.each(logReview.documents, (inx, docs) => {
                    html += '<li>' + docCodes[docs] + '</li>'
                })
                html += '</ul>'
            }
            html += '</div></div><div class="clearfix"></div>'
        })
        $('#log-container').addClass('log-box')
    } else {
        $('#log-container').removeClass('log-box')
        html = '<h5>No Feedbacks Yet</h5>'
    }
    return html
}

function activateLogClose() {
    $('.closelog').click(function () {
        let ref = $(this).data('ref')
        ajaxcall('POST', { logref: ref }, baseUrl + 'ajax/closelog').then((resp) => {
            if (resp.upd) {
                $(this).removeClass('closelog')
                $('#spn' + atob(ref))
                    .removeClass('label-danger')
                    .addClass('label-success')
                    .text('Closed')
                $('#logPanel' + atob(ref))
                    .removeClass('open')
                    .addClass('closed')
                $('#closedOn' + atob(ref)).html(
                    '<span class="ml-10 red"><b>Closed On: </b> <i class="fa fa-calendar" aria-hidden="true"></i> ' +
                    resp.date +
                    '</span>'
                )
            }
        })
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
$('.btn-action').click(function () {
    let action = $(this).data('action')
    if (action == 'HT') activateApprove()
    else {
        if (action == 'RJ') {
            $('#fleReviewDocumentLbl').html('*')
            $('#fleReviewDocument').addClass('required')
        } else {
            $('#fleReviewDocumentLbl').html('')
            $('#fleReviewDocument').removeClass('required').removeClass('error')
        }
        $('#actionsForm').validate()
        if ($('#actionsForm').valid()) {
            $('#hdAction').val(action)
            $('#actionsForm').submit()
        }
    }
})
/////////////////////////////////////////////////////////////////////////////////////////////////////
$('.btnActions').click(function () {
    $('#actionBtnsDiv').remove()
})
////////////////////////////////////////////////////////////////////////////////////////////////////
function activateApprove() {
    $('*[data-action="HT"]').data('action', 'AP')
    let html = '<div class="col-md-6">'
    html += '<label>Sanction Amount (Rs. in Lakhs)</label><span class="req">*</span>'
    html += '<input type="text" class="form-control required number mb-25" name="sanction_amount">'
    html += '</div>'
    html += '<div class="col-md-6">'
    html += '<label>Sanction Letter</label><span class="req">*</span>'
    html += '<input type="file" class="form-control required mb-25" name="sanction_letter">'
    html += '</div>'
    $('*[data-action="RJ"], *[data-action="SF"]').remove()
    $('#fileAP').html(html)
    $('#actionsForm').validate()
}
////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btn-comm-approve').click(() => {
    $('#commissionModal').modal('show')
})
////////////////////////////////////////////////////////////////////////////////////////////////////
$('#btn-comm-reject').click(() => {
    $('#rejectionModal').modal('show')
})
////////////////////////////////////////////////////////////////////////////////////////////////////
$('.btn-letters').click(function () {
    let AppCode = $(this).data('code')
    let scheme = $(this).data('scheme')
    let prefix = $(this).data('prefix')
    ajaxcall('POST', { AppCode: btoa(AppCode) }, baseUrl + 'ajax/fetchletters').then((resp) => {
        let html = makeLettersHtml(resp, scheme, false, prefix)
        $('#letters-app-code').text(AppCode)
        $('#letters-container').html(html)
        $('#lettersModal').modal('show')
    })
})
////////////////////////////////////////////////////////////////////////////////////////////////////
function fetchLetters(AppCode, scheme, prefix) {
    ajaxcall('POST', { AppCode: btoa(AppCode) }, baseUrl + 'ajax/fetchletters').then((resp) => {
        let html = makeLettersHtml(resp, scheme, true, prefix)
        $('#letters-container').html(html)
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function makeLettersHtml(data, scheme, page = false, prefix) {
    let html = ''
    html += '<div class="col-md-' + (page == true ? '3' : '6 text-center') + '">'
    html += '<label>Sanction letter</label><br>'
    if (data.sanction_letter != null)
        html +=
            '<a href="' +
            baseUrl +
            prefix +
            '/download-letter/' +
            scheme +
            '/' +
            btoa(data.app_code) +
            '/' +
            btoa(data.sanction_letter) +
            '"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>'
    else html += '<span><em>Not alloted yet</em></span>'
    html += '<br><br><label>Sanction amount (Rs. in lakh)</label><br>'
    html += (data.sanction_amount == null || data.sanction_amount == '' ? '<span><em>N/A</em></span>' : '<span>&#8377; ' + data.sanction_amount + '</span>')
    html += '</div>'
    html += '<div class="col-md-' + (page == true ? '3' : '6 text-center') + '">'
    html += '<label>Subsidy release letter</label><br>'
    if (data.release_letter != null)
        html +=
            '<a href="' +
            baseUrl +
            prefix +
            '/download-letter/' +
            scheme +
            '/' +
            btoa(data.app_code) +
            '/' +
            btoa(data.release_letter) +
            '"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>'
    else html += '<span><em>Not alloted yet</em></span>'
    html += '<br><br><label>Amount of CFA released (Rs. in lakh)</label><br>'
    html += (data.cfa_amount == null || data.cfa_amount == '' ? '<span><em>N/A</em></span>' : '<span>&#8377; ' + data.cfa_amount + '</span>')
    html += '</div>'
    html += '<div class="clearfix"></div>'

    return html
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function activateLoader(form) {
    if ($('#' + form).valid()) $('#loader').css({ display: 'block' })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function formatBarChartData(data) {
    console.log(data)
    let apps_submitted = 0
    let apps_sanctioned = 0
    let apps_commissioned = 0
    let apps_complete = 0
    let apps_rejected = 0
    let apps_underReview_sanctioning = 0
    let apps_underReview_commissioning = 0
    let apps_accepted = 0
    $.grep(data, (node, indx) => {
        if (node.under_review == 1 && node.status <= 4) apps_underReview_sanctioning++
        else if (node.under_review == 1 && node.status > 4) apps_underReview_commissioning++
        else if (node.status == 2 && node.accepted == 1 && node.under_review == 0) apps_accepted++
        else if (node.status == 2) apps_submitted++
        else if (node.status == 4) apps_sanctioned++
        else if (node.status == 5) apps_commissioned++
        else if (node.status == 7) apps_complete++
        else if (node.status == 8) apps_rejected++
    })
    data = [
        apps_submitted,
        apps_underReview_sanctioning,
        apps_accepted,
        apps_sanctioned,
        apps_commissioned,
        apps_underReview_commissioning,
        apps_complete,
        apps_rejected
    ]
    if (data.every((n) => n == 0)) data = [null, null, null, null, null, null]
    return data
}

function filterChartData(type, data) {
    let filtered_data = $.grep(data, (node, indx) => {
        if (type == 'ALL') return node
        else if (type == 'BMC') {
            if (node.type == 'BMS') return node
        } else if (type == 'WTE') {
            if (node.type != 'BMS') return node
        }
    })
    return filtered_data
}

function makeBarChart(barChartCanvas, data) {
    let applicationData = {
        label: 'Application Status',
        minBarLength: 1,
        data: data,
        backgroundColor: [
            '#00c0ef',
            '#f39c12',
            '#22365d',
            '#466dbb',
            '#5a6384',
            '#ffbb4d',
            '#00a65a',
            '#dd4b39'
        ],
        borderColor: [
            '#00c0ef',
            '#f39c12',
            '#22365d',
            '#466dbb',
            '#5a6384',
            '#ffbb4d',
            '#00a65a',
            '#dd4b39'
        ],
        borderWidth: 2,
        hoverBorderWidth: 0
    }
    let chartOptions = {
        scales: {
            xAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                        userCallback: function (label, index, labels) {
                            if (Math.floor(label) === label) {
                                return label
                            }
                        },
                        suggestedMax: Math.max(...data) + 10
                    }
                }
            ]
        },
        elements: {
            rectangle: {
                borderSkipped: 'left'
            }
        },
        legend: { position: 'bottom' }
    }
    var barChart = new Chart(barChartCanvas, {
        type: 'horizontalBar',
        data: {
            labels: [
                'Application submitted',
                'Under review - Sanctioning',
                'Project Accepted',
                'Project sanctioned',
                'Project commissioned',
                'Under review - Commissioning',
                'Subsidy released',
                'Rejected'
            ],
            datasets: [applicationData]
        },
        options: chartOptions
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function markNotificationsRead(app_code) {
    $.ajax({
        type: 'GET',
        url: baseUrl + 'ajax/markasread/' + btoa(app_code),
        success: (resp) => {
            $('#appNotifications').hide()
        }
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
function markAdminNotificationsRead(app_code) {
    $.ajax({
        type: 'GET',
        url: baseUrl + 'ajax/markadminnotificationasread/' + btoa(app_code),
        success: (resp) => {
            $('#appNotifications').hide()
        }
    })
}
////////////////////////////////////////////////////////////////////////////////////////////////////
let isNumber = (evt) => {
    evt = evt ? evt : window.event
    var charCode = evt.which ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false
    }
    return true
}
////////////////////////////////////////////////////////////////////////////////////////////////////
let isPercentage = (element) => {
    if (parseInt(element.value) > 100) element.value = 100
}
////////////////////////////////////////////////////////////////////////////////////////////////////
let makeDocMandatory = (file, label) => {
    $('#' + file).addClass('required')
    $('#' + label).html('*')
}
////////////////////////////////////////////////////////////////////////////////////////////////////
let makeDocNonMandatory = (file, label) => {
    $('#' + file)
        .removeClass('required')
        .removeClass('error')
    $('#' + label).html('')
    $('#' + file + '-error').remove()
}

