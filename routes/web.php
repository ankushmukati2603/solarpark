<?php

use App\Models\State;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'frontend.home')->name('home');
// Ekta Added for solar park
Route::match(['post', 'get'], 'user-registration', 'beneficiaryRegisterController@userRegistration');
Route::match(['post', 'get'], 'login-type', 'beneficiaryRegisterController@UserLogInType')->name('login-type');
Route::match(['post', 'get'], 'log-in', 'beneficiaryRegisterController@UserLogIn');
Route::match(['post', 'get'], 'gec-login', 'gecRegisterController@gecLogIn')->name('gec-login');
Route::match(['post', 'get'], 'secilog-in', 'beneficiaryRegisterController@SeciLogIn')->name('secilog-in');
Route::match(['post', 'get'], 'admin-log-in', 'beneficiaryRegisterController@adminLogIn');
Route::match(['post', 'get'], 'gec-admin-log-in', 'beneficiaryRegisterController@gecadminLogIn');
Route::view('sandes','frontend.sandes')->name('sandes');
Route::view('contact-us','frontend.contactUs')->name('contact-us');
Route::view('sandes','frontend.sandes')->name('sandes');
// Route::view('feedback','frontend.feedback')->name('feedback');
Route::match(['post', 'get'],'/feedback','HomeController@feedback')->name('feedback');
Route::view('faqs','frontend.faqs')->name('faqs');
Route::view('whatsNew','frontend.whatsNew')->name('whatsNew');
Route::match(['post','get'], '/test-sandes-app','HomeController@testSandes');
Auth::routes();
Route::match(['get', 'post'],'/audit-trail','MainController@userAuditTrail')->name('audit.trail');
Route::match(['get', 'post'],'/action-notification','MainController@actionNotification')->name('action.notification');
Route::get('/district/{stateId}','AjaxController@getDistrictsByState');
Route::match(['get', 'post'],'/log-out','Auth\LoginController@logout')->name('log-out');

// SECI Routes

Route::group(['prefix' => 'seci', 'as' => 'seci.', 'namespace' => 'Backend\SECI', 'middleware' => 'auth:seci'], function () {
    Route::get('/','MainController@dashboard')->name('dashboard');
    Route::match(['post', 'get'], 'solar_park_applications', 'MainController@solarParkApplications');
    Route::match(['post', 'get'], 'solar_park_applications/{id}', 'MainController@solarParkApplications');
    Route::get('/preview-progress-report/{id}', 'MainController@previewProgressReport');
    Route::post('seci-remark', 'MainController@seciRemark');
});

/**************SANJEEV********* */
Route::group(['prefix' => 'gecdeveloper', 'as' => 'gecdeveloper.', 'namespace' => 'Backend\Gecdeveloper', 'middleware' => 'auth:gecdeveloper'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['post', 'get'],'application/progress_report', 'MainController@application');
    Route::match(['post', 'get'],'application/progress_report/{id}', 'MainController@application');
    Route::match(['post', 'get'], 'new-gec-progress-report', 'MainController@newProgressReport');
    Route::match(['post', 'get'], 'progress-report', 'MainController@ProgressReport');
    Route::match(['post', 'get'],'preview-progress-report/{id}', 'MainController@previewProgressReport');
    
    
});
Route::group(['prefix' => 'gecmnre', 'as' => 'gecmnre.', 'namespace' => 'Backend\GECMNRE', 'middleware' => 'auth:gecmnre'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['post', 'get'], 'gec-progress-report', 'MainController@gecProgressReport');
    Route::post('preview-gec-report', 'MainController@previewgecReport');
    Route::get('/preview-gec-report/{id}', 'MainController@previewgecReport');
    // Route::post('gec-remark', 'MainController@gecRemark');
    
});
// BENEFICIARY Routes
Route::group(['prefix' => 'developer', 'as' => 'beneficiary.', 'namespace' => 'Backend\Beneficiary', 'middleware' => 'auth:developer'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::get('preview-docs/{folder}/{subfolder}/{file}', 'MainController@previewDocs');
    // Route::get('solarPowerReport', 'MainController@solarPowerReport');
    Route::match(['post', 'get'],'application/progress_report', 'MainController@application');
    Route::get('application/progress_report/{id}', 'MainController@application');
    Route::match(['post', 'get'],'checked-previous-report/{type}/{month}/{year}/{id}', 'MainController@checkedPreviousReport');

    Route::match(['post', 'get'], 'new-progress-report', 'MainController@newProgressReport');
    Route::match(['post', 'get'], 'my-progress-report', 'MainController@myProgressReport');
    Route::match(['post', 'get'], 'consolidate-report', 'MainController@consolidateReport');

    Route::get('/preview-progress-report/{id}', 'MainController@previewProgressReport');
    Route::get('/preview-consolidate-report/{id}', 'MainController@previewconsolidateReport');
    Route::get('/pdf-preview/{id}', 'MainController@pdfpreviewProgressReport');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/edit-project-details', 'MainController@editProjectDetails');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    Route::match(['get', 'post'], '/add-solar-park', 'MainController@addSolarPark');
    Route::match(['get', 'post'], '/add-solar-park/{id}', 'MainController@addSolarPark');
    Route::match(['get', 'post'], '/solar-park-list', 'MainController@solarParkList');
    Route::match(['get', 'post'], '/feedback', 'MainController@feedback');

});
Route::group(['prefix' => 'mnre', 'as' => 'mnre.', 'namespace' => 'Backend\Mnre', 'middleware' => 'auth:mnre'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::get('preview-docs/{folder}/{subfolder}/{file}', 'MainController@previewDocs');
    
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');


    //Created By Raushan
    Route::match(['post', 'get'], 'developer-mnre', 'MainController@mnredeveloper');
    Route::match(['post', 'get'], 'developer-mnre/{id}', 'MainController@mnredeveloper');
    Route::match(['post', 'get'], 'agency-mnre', 'MainController@mnreagency');
    Route::match(['post', 'get'], 'agency-mnre/{id}', 'MainController@mnreagency');
    Route::match(['post', 'get'], 'mnre-form', 'MainController@mnreform');
   
    Route::get('mnredeveloper-list', 'MainController@mnredeveloperList');
    Route::get('mnredeveloper-list/{id}', 'MainController@mnredeveloperList');
    
    Route::get('mnre-list', 'MainController@mnreList');

    //Created By Ekta

    
    Route::match(['post', 'get'], 'agency-archive-report', 'MainController@agencyarchiveReport');
    Route::match(['post', 'get'], 'developer-archive-report', 'MainController@developerArchiveReport');
    Route::match(['post', 'get'], 'view-agency-archive-report', 'MainController@viewAgencyarchiveReport');
    Route::get('/preview-archive-snareport/{id}', 'MainController@previewArchiveSNAReport');
    Route::match(['post', 'get'], 'view-solarrooftop-archive-report', 'MainController@viewSolarRooftoparchiveReport');
    Route::get('/preview-solarrooftoparchive-report/{id}', 'MainController@previewArchiveSolarRooftopReport');


    // New Routes added by Ankush
    Route::get('sna-list', 'MainController@snaList');
    Route::post('SnaApproveReject','MainController@snaApproveReject');

    Route::get('sppd-list', 'MainController@sppdList');
    Route::post('SppdApproveReject','MainController@sppdApproveReject');

    Route::get('stu-list', 'MainController@stuList');
    Route::post('StuApproveReject','MainController@StuApproveReject');
    
    // Recieved Report Development of Solar Parks and Ultra Mega Solar Power Projects
    Route::match(['post', 'get'], 'solar-park-reports', 'ReportController@solarParkProgressReport');
    Route::get('/preview-solar-park-reports/{id}', 'ReportController@previewSolarParkProgressReport');
    Route::post('mnreRemarkSolarPark', 'ReportController@mnreRemarkSolarPark');

    // REIA Report
    Route::get('Reia-Reports', 'ReportController@reiaReports');
    Route::match(['post', 'get'], 'Preview-Reia-Report/{id}', 'ReportController@reiareportpreview');  
    Route::post('submitRemarkReia', 'ReportController@mnreRemarkReia');


    // STU-CTU Report
    Route::match(['post', 'get'], 'Stu-Reports', 'ReportController@stuReports');
    Route::match(['post', 'get'], 'Preview-Stu-Report/{id}', 'ReportController@stureportpreview');
    Route::post('submitRemarkStu', 'ReportController@mnreRemarkStu');

    
    // SNA Report 
    Route::match(['post', 'get'], 'Sna-Reports', 'ReportController@snaReports');
    Route::match(['post', 'get'], 'Preview-Sna-Report/{id}', 'ReportController@snareportpreview');
    Route::post('mnreRemarkSna', 'ReportController@mnreRemarkSna');

    // Solar Park View 
    Route::match(['post', 'get'], 'solar-park', 'MainController@solarPark');
    Route::match(['post', 'get'], 'Preview-solar-park/{id}', 'MainController@solarparkpreview');

    Route::get('capacity-tendered-list', 'MainController@tenderList');
    Route::get('cancelled-tender-list', 'MainController@cancelledtenderList');
    
    
});

/****************13/dec/2022****************** */

Route::group(['prefix' => 'state-implementing-agency', 'as' => 'state-implementing-agency.', 'namespace' => 'Backend\SNA', 'middleware' => 'auth:state-implementing-agency'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['post', 'get'],'/solar-Power-Report', 'MainController@solarPowerReport');
    Route::match(['post', 'get'],'/solar-Power-Report/{id}', 'MainController@solarPowerReport');
    Route::match(['post', 'get'], 'recieved-progress-report', 'MainController@recievedProgressReport');
    Route::match(['post', 'get'], 'report-type', 'MainController@selectreporttype');
    Route::match(['post', 'get'],'solarpower-under-implementation', 'MainController@solarPowerunderImplementationReport');
    Route::match(['post', 'get'],'solarpower-under-implementation/{id}', 'MainController@solarPowerunderImplementationReport');
    Route::match(['post', 'get'],'checked-previous-report/{type}/{month}/{year}/{id}', 'MainController@checkedPreviousReport');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    /************************roushan***************** */
    Route::get('developer-list', 'MainController@developerList');
    Route::match(['post', 'get'], 'developer', 'MainController@developermaster');
    Route::match(['post', 'get'], 'developer/Edit/{id}', 'MainController@developermaster');
    Route::match(['post', 'get'],'solar-Power-commissioning-Report', 'MainController@solarPowerCommissioningReport');
    Route::match(['post', 'get'],'solar-Power-commissioning-Report/{id}', 'MainController@solarPowerCommissioningReport');
    Route::match(['post', 'get'],'solar-rooftop-Report', 'MainController@solarRooftopReport');
    Route::match(['post', 'get'],'solar-rooftop-Report/{id}', 'MainController@solarRooftopReport');
    Route::get('/preview-progress-report/{id}', 'MainController@previewProgressReport');
    /************************New Updates***************** */
    Route::match(['post', 'get'], 'Tenders', 'TenderController@tender');
    Route::match(['post', 'get'], 'Tenders/Add', 'TenderController@addEditTender');
    Route::match(['post', 'get'], 'Tenders/Edit/{id}', 'TenderController@addEditTender');

    // Agency
    Route::match(['post', 'get'], 'Agency', 'TenderController@agency');
    Route::match(['post', 'get'], 'Agency/Add', 'TenderController@addEditAgency');
    Route::match(['post', 'get'], 'Agency/Edit/{id}', 'TenderController@addEditAgency');
  
    // Sub Agency or SPDA
    Route::match(['post', 'get'], 'Sub-Agency', 'TenderController@sub_agency');
    Route::match(['post', 'get'], 'Sub-Agency/Add', 'TenderController@addEditSubAgency');
    Route::match(['post', 'get'], 'Sub-Agency/Edit/{id}', 'TenderController@addEditSubAgency');


    Route::match(['post', 'get'], 'Bidder', 'TenderController@bidder');
    Route::match(['post', 'get'], 'Bidder/Add', 'TenderController@addEditBidder');
    Route::match(['post', 'get'], 'Bidder/Edit/{id}', 'TenderController@addEditBidder');

    // Tendering
    Route::match(['post', 'get'], 'ReverseAuction', 'TenderController@reverseAuction');
    Route::match(['post', 'get'], 'CancelTender', 'TenderController@cancelTender');
    Route::match(['post', 'get'], 'SelectedBidder', 'TenderController@selectedBidder');
    Route::match(['post', 'get'], 'ProjectLocation', 'TenderController@projectLocation');
    Route::match(['post', 'get'], 'SigningOfPSA', 'TenderController@signingofPSA');
    Route::match(['post', 'get'], 'SigningOfPPA', 'TenderController@signingofPPA');
    Route::match(['post', 'get'], 'LOA-LOI', 'TenderController@loaLoi');
    Route::match(['post', 'get'], 'TenderCommissioning', 'TenderController@tenderCommissioning');
    Route::match(['post', 'get'], 'TenderPreview/{id}', 'TenderController@tenderPreview');
    Route::match(['post', 'get'], 'TenderReport', 'TenderController@tenderReport');
    Route::match(['post', 'get'], 'ReportView/{id}/{tender_id}', 'TenderController@reportView');


    // Download Report 
    Route::get('DownloadReport/{id}/{tender_id}', 'TenderController@downloadPdf');
    
    Route::get('ajaxtender/{page}/{id}', 'TenderController@getTenderDetailById');
    Route::get('ajaxtenderBidder/{id}', 'TenderController@getTenderBidderById');
    // Signing Of PSA
    Route::get('ajaxSelectedBidderPSAData/{id}/{tender_id}', 'TenderController@getSelectedBidderPSAData');

    // Signing Of PPA
    Route::get('ajaxSelectedBidderPPAData/{id}/{tender_id}', 'TenderController@getSelectedBidderPPAData');


    Route::get('getSelectedBidderProjectData/{id}/{tender_id}', 'TenderController@getSelectedBidderProjectData');
    Route::get('ajaxSelectedLOABidderData/{id}/{tender_id}', 'TenderController@getSelectedLoaBidderData');
    Route::get('ajaxTenderComissioningData/{id}/{tender_id}', 'TenderController@getTenderComissioningData');
    Route::get('ajaxGetSPDByAgencyID/{id}/{spd}', 'TenderController@getSPDByAgencyData');
    
    Route::get('tenderexcelreport', 'TenderController@downloadExcel');

    Route::get('ajaxGetProjectListByBidder/{id}/{tender_id}', 'TenderController@getProjectListData');
    Route::get('ajaxGetCommissionDetails/{project_id}', 'TenderController@getCommissionDetails');


    // Under Implementation
    Route::match(['post', 'get'], 'Under-Implementation', 'UnderImplementationController@under_implementation');
    Route::get('ajaxSelectedBidderRecords/{id}/{tender_id}', 'UnderImplementationController@getSelectedBidderRecords');

    // Commissioned
    Route::match(['post', 'get'], 'Commissioned', 'UnderImplementationController@commissioned');
    Route::get('ajaxSelectedBidderRecordsImplemented/{id}/{tender_id}', 'UnderImplementationController@getSelectedBidderRecordsByImplemented');

    Route::match(['get', 'post'], '/feedback', 'MainController@feedback');

    Route::get('/TenderCancelled', 'MainController@tenderCancelled');

    

});
Route::group(['prefix' => 'ajax'], function () {
    Route::get('fetchCities/{state}', 'AjaxController@getDistrictsByState');
    Route::get('fetchSubDistricts/{district}', 'AjaxController@getSubDistrictsByDistrict');
    Route::get('fetchSubDistrictsByVillage/{village}', 'AjaxController@fetchSubDistrictsByVillage');
    Route::get('fetchDistrictBySubDiscrict/{subDistrict}', 'AjaxController@fetchDistrictBySubDiscrict');
    Route::get('fetchStateByDiscrict/{district}', 'AjaxController@fetchStateByDiscrict');
    Route::get('setOrEditPriority/{systemId}/{priority}', 'AjaxController@setOrEditPriority');
    Route::get('ajax-refresh-csrf','AjaxController@tokencsrf_token_regerate');
    Route::post('addEditSystem', 'AjaxController@addEditSystem');
    //Added by Ekta
    Route::get('SubDistricts/{districtID}', 'AjaxController@getSubDistrictsByDistrict');
    Route::get('block/{blockID}', 'AjaxController@getBlockByDistricts');
    Route::get('village/{villageID}', 'AjaxController@getVillageBySubDistict');
    
    // localbodies and ward add krna h
    Route::get('panchayat/{panchayatID}/{stateId}', 'AjaxController@getpanchayatByState');
    Route::get('ward/{wardID}', 'AjaxController@getwardByPanchayat');
    Route::get('send-otp/{number}','beneficiaryRegisterController@sendOTP');
    Route::get('verify-otp/{number}/{otp}','beneficiaryRegisterController@verifyOTP');
    Route::get('login-otp/{number}','beneficiaryRegisterController@loginOtp');
    Route::get('user-verify-otp/{number}/{otp}','beneficiaryRegisterController@userOTPVerified');
    Route::get('/district/{stateId}','AjaxController@getDistrictsByState');
    Route::post('generate-token/{token}', 'AjaxController@generateToken');

    // sanjeev
    Route::get('geclogin-otp/{number}','gecRegisterController@loginOtp');
    Route::get('gecuser-verify-otp/{number}/{otp}','gecRegisterController@userOTPVerified');
});

Route::group(['prefix' => 'reia', 'as' => 'reia.', 'namespace' => 'Backend\REIA', 'middleware' => 'auth:reia'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['post', 'get'], 'new-reia-progress-report', 'MainController@newProgressReport');
    Route::match(['post', 'get'], 'new-reia-progress-report/{id}', 'MainController@newProgressReport');
    
    Route::match(['post', 'get'], 'reia-progress-report/edit/{any}', 'MainController@editReiaProgressReport');
    Route::match(['post', 'get'], 'progress-report', 'MainController@ProgressReport');
    Route::match(['post', 'get'], 'add-progress-report', 'MainController@addProgressReport');
    //Route::match(['post', 'get'], 'add-progress-report/{id}', 'MainController@addProgressReport');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    Route::match(['post', 'get'], 'schemes', 'MainController@schemes');
    Route::match(['post', 'get'], 'add-scheme', 'MainController@addScheme');
    Route::match(['post', 'get'], 'scheme/edit/{any}', 'MainController@addScheme');
    Route::match(['post', 'get'], 'schemes_status', 'MainController@Changeschemesstatus');
    Route::match(['get', 'post'], '/feedback', 'MainController@feedback');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/view-profile', 'MainController@vieweditProfile');

    Route::match(['post', 'get'], 'bidder', 'MainController@bidder');
    Route::match(['post', 'get'], 'add-bidder', 'MainController@addBidder');
    Route::match(['post', 'get'], 'bidder/edit/{any}', 'MainController@addBidder');
    Route::match(['post', 'get'], 'bidders_status', 'MainController@Changebidderstatus');
    Route::match(['post', 'get'], 'previewprogressreport/{id}', 'MainController@progressreportpreview');   
});


/************************Added By Roshan*******************/
Route::group(['prefix' => 'stu-users', 'as' => 'stu-users.', 'namespace' => 'Backend\STU', 'middleware' => 'auth:stu-users'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');

    Route::match(['post', 'get'],'application/progress_report', 'MainController@application');
    Route::match(['post', 'get'],'application/progress_report/{id}', 'MainController@application');
   
     //For Monthly Progress Report
    Route::match(['post', 'get'], 'progress-report', 'MainController@ProgressReport');
    Route::match(['post', 'get'], 'progress-report/{id}', 'MainController@ProgressReport');

    Route::match(['post', 'get'], 'add-progress-report', 'MainController@addProgressReport');
    Route::match(['post', 'get'],'new-stu-progress_report', 'MainController@newStuProgressReport');
    Route::match(['post', 'get'],'new-stu-progress_report/{id}', 'MainController@newStuProgressReport');
    Route::match(['post', 'get'], 'new-stu-progress_report/edit/{any}', 'MainController@editStuProgressReport');
    //edit View Profile & change password
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/view-profile', 'MainController@vieweditProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
    Route::match(['get', 'post'], '/feedback', 'MainController@feedback');
    //Manage STUs/CTUs Project
    Route::match(['get', 'post'], '/add-stu-project', 'MainController@addstuproject');
    Route::match(['get', 'post'], '/add-stu-project/{id}', 'MainController@addstuproject');
    Route::match(['get', 'post'], '/stu-project-list', 'MainController@stuProjectList');
    Route::match(['post', 'get'], 'previewprogressreport/{id}', 'MainController@progressreportpreview');
});


/************************testing*******************/
Route::match(['post', 'get'], 'reset-user-password','ResetPassController@sendOtpToUser')->name('reset.password');
Route::match(['post' , 'get'],'verify-otp','ResetPassController@checkOtp');
Route::match(['post','get'],'change-password','ResetPassController@updatePassword');
Route::get('almm','ResetPassController@almmForm');
Route::get('almmPdf','ResetPassController@almmPdfForm')->name('almmPdf');
Route::match(['post','get'],'developerData','ResetPassController@developerData');
Route::get('developerData/Edit/{id}','ResetPassController@developerData');
Route::get('viewDeveloperData','ResetPassController@viewDeveloperData');
Route::get('deleteDeveloperData/Delete/{delete_id}','ResetPassController@deleteDeveloperData');
/*********************2nd form***********************/
Route::match(['post', 'get'],'solarProjectData','ResetPassController@solarProjectData');
Route::get('viewsolarData','ResetPassController@viewsolarData');