<?php

namespace App\Http\Controllers\Backend\SNA;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Program;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Village;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\Developer;
use App\Models\SubDistrict;
use App\Models\Installation;
use App\Models\SolarRooftop;
use App\Models\AuditTrail;
use App\Models\solarPowerReport;
use App\Models\ProgressReport;
use App\Models\InstallationReviewLog;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\LocalbodyUser;
use App\Models\Inspection;
use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRegistry;
use App\Models\SiaInspectorAssociation;
use App\Models\SiaInstallerAssociation;
use App\Models\PasswordHistoryLog;
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\FormValidator;
use App\Utils\EmailSmsNotifications;
use DB, URL, Auth, Hash, Storage, Config, Gate,Validator;

class MainController extends Controller
{
    use General;
    
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function index(){
        $dashboard = new Dashboard();
        $data = $dashboard->getSNADashboardData();
        $auditData = array('action_type'=>'1','description'=>'SNA viewed Dashboard  ','user_type'=>'2');
        $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.dashboard', compact('data'));
    }
    public function editProfile_bk(Request $request){
        try { 
            $user = Auth::user();
            $states = State::orderby('name')->get();
            if($request->isMethod('get')){
                return view('backend.state-implementing-agency.editProfile', compact('user','states'));
            }
            $user->name = $request->name;
            // $user->name_of_solar_park = $request->name_of_solar_park;
            $user->phone = $request->phone;
            $user->state_id = $request->state_id;
            $user->district_id = $request->district_id;
            $user->sub_district_id = $request->sub_district_id;
            $user->village = $request->village;
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;
            //dd($user);
             $user->save();
            //dd($user);
            $auditData = array('action_type'=>'7','description'=>' SNA Edit Profile','user_type'=>'2');
            $this->auditTrail($auditData);
            if($isSaved){

                return redirect()->back()->with("status","Profile edited successfully !");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server Error !");
        }
    }
    public function editProfile(Request $request) {
        $url='/'.Auth::getDefaultDriver().'/edit-profile';
        $states = State::orderby("name")->get();
        $user = Auth::user();
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                        'name' => 'required',
                        'phone' => 'required',
                        'contact_person' => 'required',
                        'address' => 'required',
                        'state' => 'required',
                        'district_id'=>'required'
                        
                ]
            );
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            }
            try {
                //code...
                // $data = Auth::user();
                $user->name = $request->input('name');
                $user->contact_person = $request->input('contact_person');
                $user->state_id = $request->input('state');
                $user->phone = $request->input('phone');
                $user->address = $request->input('address');
                $user->save();
                $auditData = array('action_type' => '3', 'description' => "SNA update profile successfuly", 'user_type' => '2');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'success', 'message' => 'Profile updated successfully!', 'url' => $url,'user', 'states','redirect' => 'yes']);
            } catch (\Throwable $th) {
                return redirect()->back()->with("error","Server Error !");
            }
            
        }
        $auditData = array('action_type' => '1', 'description' => 'SNA View Profile', 'user_type' => '2');
        $this->auditTrail($auditData);
        $agencydetails = array();
        $states = State::orderby("name")->get();
        return view('backend.state-implementing-agency.editProfile', compact('user', 'states','url'));

    }
    public function changePassword_bk(Request $request){
        // try {
            if($request->isMethod('get')){
                $submitUrl = URL::to('/state-implementing-agency/change-password');
                
                $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'2');
                $this->auditTrail($auditData);
               
                return view('backend.state-implementing-agency.changePassword',compact('submitUrl'));
            }
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                // dd($request->current_password);
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User  Match Password ','user_type'=>'2');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }
            if(!$this->passwordPolicyTest($request->new_password)){
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'1','description'=>' MNRE User Test password Policy  ','user_type'=>'2');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return redirect()->back()->with("error", $error);
            }
            if(strcmp($request->current_password, $request->new_password) == 0){
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User verify condition currunt and new password not same  ','user_type'=>'2');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                //Current password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }
            //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->new_password);
                $user->save();
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'2','description'=>' MNRE User Inserted new password  ','user_type'=>'2');
                $this->auditTrail($auditData);
             /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status","Password changed successfully !");
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with("error","Server Error !");
        // }
    }
    public function changePassword(Request $request) {
        try {
            if ($request->isMethod('get')) {
                $submitUrl = URL::to('/state-implementing-agency/change-password');
                $auditData = array('action_type' => '3', 'description' => ' MNRE User  Change Password ', 'user_type' => '2');
                $this->auditTrail($auditData);
                return view('backend.state-implementing-agency.changePassword', compact('submitUrl'));
            }

            // Decrypt Password
            $random_session_id1 = Session::get('random_session_id1');
            $random_session_id2 = Session::get('random_session_id2');
            $key = hex2bin("0123456789abcdef0123456789abcdef");
            $iv = hex2bin("abcdef9876543210abcdef9876543210");

            $current_password = openssl_decrypt($request->current_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $current_password = trim($current_password);
            $current_password = str_replace($random_session_id1, "", $current_password);
            $current_password = str_replace($random_session_id2, "", $current_password);

            $new_password = openssl_decrypt($request->new_password, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $new_password = trim($new_password);
            $new_password = str_replace($random_session_id1, "", $new_password);
            $new_password = str_replace($random_session_id2, "", $new_password);

            $new_password_confirmation = openssl_decrypt($request->new_password_confirmation, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
            $new_password_confirmation = trim($new_password_confirmation);
            $new_password_confirmation = str_replace($random_session_id1, "", $new_password_confirmation);
            $new_password_confirmation = str_replace($random_session_id2, "", $new_password_confirmation);

            if (!(Hash::check($current_password, Auth::user()->password))) {
                /*                 * ***********************Audit Trail Start********************************* */
                $auditData = array('action_type' => '1', 'description' => ' MNRE User  Match Password ', 'user_type' => '1');
                $this->auditTrail($auditData);
                /*                 * ***********************Audit Trail Start********************************* */
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }

            if ($new_password != $new_password_confirmation) {
                $error = 'New Password and Confirm Password not match';
                /*                 * ***********************Audit Trail Start********************************* */
                $auditData = array('action_type' => '1', 'description' => 'New Password and Confirm Password not match', 'user_type' => '1');
                $this->auditTrail($auditData);
                /*                 * ***********************Audit Trail Start********************************* */
                return redirect()->back()->with("error", $error);
            }
            if ((strpos($new_password, Auth::user()->name) !== false)) {
                return redirect()->back()->with("error", "Password not match as well as name");
            }
            $user_type = Auth::getDefaultDriver();
            $user_id = Auth::user()->id;

            $histories = PasswordHistoryLog::select('password')->where('user_id', $user_id)->where('user_type', 'sna')->get();
            foreach ($histories as $history) {
                if ((Hash::check($new_password, $history->password))) {
                    return redirect()->back()->with("error", "This password already used previously");
                }
            }
            if (!$this->passwordPolicyTest($new_password)) {
                $error = 'Failed strong password policy!';
                /*                 * ***********************Audit Trail Start********************************* */
                $auditData = array('action_type' => '1', 'description' => ' MNRE User Test password Policy  ', 'user_type' => '1');
                $this->auditTrail($auditData);
                /*                 * ***********************Audit Trail Start********************************* */
                return redirect()->back()->with("error", $error);
            }

            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($new_password);
            $user->save();
            $passwordLog = new PasswordHistoryLog();
            $passwordLog->user_type = 'sna';
            $passwordLog->user_id = Auth::user()->id;
            $passwordLog->password = Hash::make($new_password);
            $passwordLog->created_by = Auth::user()->id;
            $passwordLog->save();
            /*             * ***********************Audit Trail Start********************************* */
            $auditData = array('action_type' => '2', 'description' => ' SNA User Inserted new password  ', 'user_type' => '1');
            $this->auditTrail($auditData);
            /*             * ***********************Audit Trail Start********************************* */
            return redirect()->back()->with("status", "Password changed successfully !");
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            die;
        }
    }
    public function recievedProgressReport(Request $request){
        if($request->isMethod('post')){
            \DB::enableQueryLog(); // Enable query log
            $validatedData=$request->validate([
                'report_type'=>'required',
                'report_sub_type'=>'required_if:report_type,3',
            ],[  
                'report_sub_type.required_if' => 'Please select category.', 
                // 'park_name.required_without' => 'Please provide atleast date or park name.', 
            ] );
            $reportType=$request->input('report_type');
            $fromdata=$request->input('date');
            $todata=$request->input('date');
            $state=$request->input("state");
            $district=$request->input("district_id");
            $agency_name=$request->input("agency_name");
            $email =$request->input('email');
            // $capacity=$request->input("capacity");
           
            $tenderDetails=array();
            $i=0;
            // progressData
            $query= solarPowerReport::where('sna_id', Auth::id());
            if($fromdata!=''){
                $query->whereBetween('submitted_on', [$fromdata.' 00:00:00' , $fromdata.' 23:59:59']);
            }
            
            if($state!=''){
                $query->Where('state',$state);
            }
            if($district!=''){
                $query->Where('district',$district);
            }
            if($agency_name!=''){
                $query->Where('agency_name', 'like', '%' . $agency_name. '%');
            }
            if($email!=''){
                $query->where('email',$email);
            }
            if($reportType!=''){
                $query->where('report_type',$reportType);
                if($reportType=='3'){
                    $query->where('report_sub_type',$request->report_sub_type);
                }
            }
            $progressData=$query->orderBy("submitted_on",'DESC')->get()->toArray();
            // dd(\DB::getQueryLog()); 
            
            if(count($progressData)==0){
                return redirect(Auth::getDefaultDriver().'/recieved-progress-report'); 
            }
            
            foreach($progressData as $data){$i++;
                $tenderDetails[$i] = $data;
                $tenderDetails[$i]['state_name']='NA';
                $tenderDetails[$i]['district_name']='NA';
                if($data['report_type']==1){
                    $tenderDetails[$i]['redirect_url']='solar-Power-Report';
                    $decodeData=json_decode($data['general'],true);
                    if(!empty($decodeData['state']) && $decodeData['state']>0){
                        $tenderDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                        $tenderDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                    }else{
                        $tenderDetails[$i]['state_name'] ='NA';
                        $tenderDetails[$i]['district_name'] ='NA';
                    }
                    
                    
                }elseif($data['report_type']==2){
                    $tenderDetails[$i]['redirect_url']='solarpower-under-implementation';
                    if($data['state']>0){
                        $tenderDetails[$i]['state_name'] =State::where('code',$data['state'])->first()['name'];
                        $tenderDetails[$i]['district_name'] =District::where('code',$data['district'])->first()['name'];
                    }
                    
                }
                elseif($data['report_type']==3){
                    $tenderDetails[$i]['redirect_url']='solar-Power-commissioning-Report';
                    if($data['report_sub_type'] =='rooftop_report'){
                        $tenderDetails[$i]['redirect_url']='solar-rooftop-Report';
                        $rooftopdata = SolarRooftop::where('id',$data['rooftop_report_id'])->first();
                        $tenderDetails[$i]['rooftopdata']=$rooftopdata;
                        
                    }else{
                        $decodeData=json_decode($data['project_location'],true);
                        if(!empty($decodeData['state']) && $decodeData['state']>0){
                            $tenderDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                            $tenderDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                        }else{
                            $tenderDetails[$i]['state_name'] ='NA';
                            $tenderDetails[$i]['district_name'] ='NA';
                        }
                    }
                    
                }
                //dd('hi');
            }
            //dd($tenderDetails);
            $auditData = array('action_type'=>'1','description'=>'SNA Search Tender Data','user_type'=>'2');
            $this->auditTrail($auditData);
            $states = State::orderby('name')->get();
            // dd($tenderDetails);
            return view('backend.state-implementing-agency.recievedProgressReport',compact('tenderDetails','states'));
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit  Recieved Progress Report Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderDetails=array();
        $states = State::orderby('name')->get();
        return view('backend.state-implementing-agency.recievedProgressReport',compact('tenderDetails','states'));
    }
    public function solarPowerReport(Request $request, $id=NULL){
        if($request->isMethod('post'))
        {
            if($request->type =='general'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'agency_name'=>'required|max:75',
                'state'=>'required',
                'contact_person_name'=>'required',
                'email'=>'required|email',
                'mobile_number'=>'required|max:10|min:10',
                'scheme_type'=>'required',
                'district_id'=>'required',
                'sub_district_id'=>'required',
                'village'=>'required',
                'latitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                'longitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                'bidding_agency'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $generaldata=array();
                
                $generaldata['agency_name']=$request->agency_name;
                $generaldata['state']=$request->state;
                $generaldata['contact_person_name']=$request->contact_person_name;
                $generaldata['email']=$request->email;
                $generaldata['mobile_number']=$request->mobile_number;
                $generaldata['scheme_type']=$request->scheme_type;
                $generaldata['district']=$request->district_id;
                $generaldata['sub_district']=$request->sub_district_id;
                $generaldata['village']=$request->village;
                $generaldata['latitude']=$request->latitude;
                $generaldata['longitude']=$request->longitude;
                $generaldata['bidding_agency']=$request->bidding_agency;
                
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'general'=>$generaldata,
                    'agency_name'=>$request->agency_name,
                    'email'=>$request->email,
                    'state'=>$request->state,
                    'district'=>$request->district_id]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='tender'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'tender_capacity'=>'required',
                    'nit_date'=>'required',
                    'rfs_date'=>'required',
                    'pre_bid_meeting_date'=>'required',
                    'bid_submission_last_date'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $tenderdata=array();
                
                $tenderdata['tender_capacity']=$request->tender_capacity;
                $tenderdata['nit_date']=$request->nit_date;
                $tenderdata['rfs_date']=$request->rfs_date;
                $tenderdata['pre_bid_meeting_date']=$request->pre_bid_meeting_date;
                $tenderdata['bid_submission_last_date']=$request->bid_submission_last_date;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'tender'=>$tenderdata,
                    'capacity'=>$request->tender_capacity,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Tender Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='reverseAuction'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'ra_e_ra_date'=>'required',
                'reverseauction_capacity'=>'required',
                
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $reverseAuctiondata=array();
                
                $reverseAuctiondata['ra_e_ra_date']=$request->ra_e_ra_date;
                $reverseAuctiondata['reverseauction_capacity']=$request->reverseauction_capacity;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'reverse_auction'=>$reverseAuctiondata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Reverse Auction Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='cancelledTenders'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'cancel_tender_date'=>'required',
                'cancel_tender_capacity'=>'required',
                // 'cancelled_tender_remarks'=>'required',
                
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $cancelledTendersdata=array();
                
                $cancelledTendersdata['cancel_tender_date']=$request->cancel_tender_date;
                $cancelledTendersdata['cancel_tender_capacity']=$request->cancel_tender_capacity;
                $cancelledTendersdata['cancelled_tender_remarks']=$request->cancelled_tender_remarks;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'cancelled_tenders'=>$cancelledTendersdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Cancelled Tenders Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='selectedBidders'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'company_name'=>'required',
                    'select_bidders_capacity'=>'required',
                    'loi_loa_date'=>'required',
                    'tariff'=>'required',
                    'ppa_psa_date'=>'required',
                    'ppa_psa_capacity'=>'required',
                    'ppa_psa_state_name'=>'required',
                    'ppa_signed_discom_name'=>'required',
                    'ppa_electricity_unit'=>'required',
                    'ppa_duration'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $selectedBiddersdata=array();
                $selectedBiddersdata['company_name']=$request->company_name;
                $selectedBiddersdata['select_bidders_capacity']=$request->select_bidders_capacity;
                $selectedBiddersdata['loi_loa_date']=$request->loi_loa_date;
                $selectedBiddersdata['tariff']=$request->tariff;
                $selectedBiddersdata['ppa_psa_date']=$request->ppa_psa_date;
                $selectedBiddersdata['ppa_psa_capacity']=$request->ppa_psa_capacity;
                $selectedBiddersdata['ppa_psa_state_name']=$request->ppa_psa_state_name;
                $selectedBiddersdata['ppa_signed_discom_name']=$request->ppa_signed_discom_name;
                $selectedBiddersdata['ppa_electricity_unit']=$request->ppa_electricity_unit;
                $selectedBiddersdata['ppa_duration']=$request->ppa_duration;
                
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'selected_bidders'=>$selectedBiddersdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Select Bidders Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
         
            if($request->type =='commissioning'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'scheduled_date'=>'required',
                    'extended_date'=>'required',
                    'capacity_commissioned_date'=>'required',
                    'date_inprincuple_approval'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $commissioningdata=array();
                $commissioningdata['scheduled_date']=$request->scheduled_date;
                $commissioningdata['extended_date']=$request->extended_date;
                $commissioningdata['capacity_commissioned_date']=$request->capacity_commissioned_date;
                $commissioningdata['date_inprincuple_approval']=$request->date_inprincuple_approval;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'commissioning'=>$commissioningdata,

                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Commissioning Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='additionalInformation'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'additional_information'=>'required',
                ]);
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                        'additional_information'=>$request->additional_information,
                        'final_submission'=>1 ,
                        'submitted_on' => $this->getCurruntDate()
                    ]);
                    $url=urlencode('/state-implementing-agency/recieved-progress-report');
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Additional Information Data','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
                }      
            }
        }
        $auditData = array('action_type'=>'1','description'=>'SNA view all page','user_type'=>'2');
        $this->auditTrail($auditData);
        $generalData=array();
        $data= solarPowerReport::select('*')->where('id',$id)->where('sna_id',Auth::id())->first();
        if($data!=null){
            if($data->final_submission==1){
                return redirect(Auth::getDefaultDriver().'/recieved-progress-report'); 
            }
            $generalData['month']=$data->month;
            $generalData['year']=$data->year;
            $generalData['id']=$data->id;
            $generalData['report_type']=$request->report_type;
            $generalData['general'] = json_decode($data->general, true);
            $generalData['tender'] = json_decode($data->tender, true);
            $generalData['reverseAuction'] = json_decode($data->reverse_auction, true);
            $generalData['cancelledTenders'] = json_decode($data->cancelled_tenders, true);
            $generalData['selectedBidders'] = json_decode($data->selected_bidders, true);
            $generalData['discoveredTariffs'] = json_decode($data->discovered_tariff, true);
            $generalData['signingOfPPAPSA'] = json_decode($data->signing_of_ppa_psa, true);
            $generalData['commissioning'] = json_decode($data->commissioning, true);
            $generalData['additional_information'] = $data->additional_information;
           /****************************** code of json_decode************/
            $states=State::orderby("name")->get();
            
            return view('backend.state-implementing-agency.solar_power.progressReport',compact('states','id','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        } 
       
    }
    public function selectreporttype(Request $request){
        if($request->isMethod('post')){
            // dd($request);
            DB::enableQueryLog();
            $month=$request->month;
            $year=$request->year;
            $existingProgress=solarPowerReport::select('*')->where('sna_id', Auth::id())->where('developer_id',$request->developer)->where('month', $month)
            ->where('year',$year)->where('report_type',$request->report_type);
            if($request->report =='new_report'){
                $existingProgress->where('report_sub_type','new_report');
            }
            if($request->report =='rooftop_report'){
                $existingProgress->where('report_sub_type','rooftop_report');
            }
            $existingProgressData=$existingProgress->first();
            
            if($existingProgressData!=null){
                if($existingProgressData->final_submission==1){
                    return redirect()->back()->with("error",'Report Already Submitted for this Month');
                }
                if($request->report_type=='1'){
                    $auditData = array('action_type'=>'1','description'=>'SNA Update Solar Power Tender Report Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return redirect(Auth::getDefaultDriver().'/solar-Power-Report/'.$existingProgressData->id);
                }elseif($request->report_type=='2'){
                    $auditData = array('action_type'=>'1','description'=>'SNA visit under implementation report Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return redirect('/'.Auth::getDefaultDriver().'/solarpower-under-implementation/'.$existingProgressData->id); 
                }else{
                    if($request->report=='rooftop_report'){
                        $auditData = array('action_type'=>'3','description'=>'SNA visit solar Rooftop Report Details','user_type'=>'2'); $this->auditTrail($auditData);
                        return redirect('/'.Auth::getDefaultDriver().'/solar-rooftop-Report/'.$existingProgressData->id);
                    }
                    $auditData = array('action_type'=>'3','description'=>'SNA visit Solar Power Commissioning Report Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return redirect('/'.Auth::getDefaultDriver().'/solar-Power-commissioning-Report/'.$existingProgressData->id);   
                }
            }
            $newProgressData=new solarPowerReport();                                                                                                                                                    
            $newProgressData->month=$request->month;
            $newProgressData->year=$request->year;
            $newProgressData->developer_id=$request->developer;
            $newProgressData->report_type=$request->report_type;
            $newProgressData->report_sub_type=$request->report;
            $newProgressData->sna_id=Auth::id();
            $newProgressData->save();
            $id=$newProgressData->id;
            if($request->report_type=='1'){
                $auditData = array('action_type'=>'3','description'=>'SNA Update Solar Power Tender Details','user_type'=>'2'); $this->auditTrail($auditData);
                return redirect('/'.Auth::getDefaultDriver().'/solar-Power-Report/'.$id);
            }elseif($request->report_type=='2'){
                $auditData = array('action_type'=>'3','description'=>'SNA Update Solar Power UnderImplementation Details','user_type'=>'2'); $this->auditTrail($auditData);
                return redirect('/'.Auth::getDefaultDriver().'/solarpower-under-implementation/'.$id); 
            }else{
                
                if($request->report=='rooftop_report'){
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Solar Rooftop Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return redirect('/'.Auth::getDefaultDriver().'/solar-rooftop-Report/'.$id);
                }
                $auditData = array('action_type'=>'3','description'=>'SNA Update Solar Power Commissioning Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return redirect('/'.Auth::getDefaultDriver().'/solar-Power-commissioning-Report/'.$id);     
            }
        }
        $developer=Developer::all();
        $auditData = array('action_type'=>'1','description'=>'SNA visit SNA Report Type Page','user_type'=>'2'); $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.reportType',compact('developer'));
    }
    /************************roushan*************** */
    public function developermaster(Request $request, $id=null){
        if($request->isMethod('post')){
            //dd($request);
            $validation = Validator::make($request->all(), [
                'name'=>'required|regex:/^[a-zA-Z ]+$/u',
                'address'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                'email'=>'required|email',
                'contact_no'=>'required|numeric|digits:10',
                'state_id'=>'required',
                'address'=>'required',
                'district_id'=>'required',
                'sub_district_id'=>'required',
                'village'=>'required',
            ]);
            if ($validation->fails()){  
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            try {
                if($request->editId){
                    $developer=Developer::find($request->editId);
                }else{
                    $developer=new Developer();
                }
                $developer->name= $request->input('name');
                $developer->sna_id= Auth::user()->id;
                $developer->address= $request->input('address');
                $developer->contact_no=$request->input('contact_no');
                $developer->email= $request->input('email');
                $developer->state_id=$request->input('state_id');
                $developer->district_id=$request->input('district_id');
                $developer->sub_district_id=$request->input('sub_district_id');
                $developer->village=$request->input('village');
                $developer->save();
                $auditData = array('action_type'=>'3','description'=>'SNA Update Developer Details','user_type'=>'2'); $this->auditTrail($auditData);
                $url=urlencode('/'.Auth::getDefaultDriver().'/developer-list');
                return response()->json(['status' => 'success','message'=>'Developer saved successfuly!','url'=>$url,'redirect'=>'yes']);
                
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }  
        $developerdetails=array();
        if($id){
            $developerdetails=Developer::select('*')->where('id',$id)->first();
        }
        $district_id=District::orderby("name")->get();  
        $states=State::orderby("name")->get();
        
        $userDetail=Developer::where('sna_id',Auth::user()->id)->get();
        $auditData = array('action_type'=>'1','description'=>'SNA View Developer List Details','user_type'=>'2'); $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.masterDeveloper',compact('states', 'district_id','id', 'userDetail','developerdetails'));
    }
    public function developerList(){
        $userDetail=Developer::where('sna_id',Auth::user()->id)->get();
        $auditData = array('action_type'=>'1','description'=>'SNA visit Developer List Page','user_type'=>'2'); $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.developerList',compact('userDetail'));
    }
    public function solarPowerCommissioningReport(Request $request , $id=NULL){
        if($request->isMethod('post'))
        {
            try {
                if($request->type =='general'){
                    $validation = Validator::make($request->all(), [
                        'developer_name'=>'required|max:75',
                        'email'=>'required|email',
                        'ceo_name'=>'required',
                        'office_address'=>'required',
                        'mobile_number'=>'required|max:10|min:10',
                        'office_number'=>'required|max:13|min:6',
                    ]
                    );
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $generalcommdata=array();
                    $generalcommdata['developer_name']=$request->developer_name;
                    $generalcommdata['email']=$request->email;
                    $generalcommdata['ceo_name']=$request->ceo_name;
                    $generalcommdata['office_address']=$request->office_address;
                    $generalcommdata['mobile_number']=$request->mobile_number;
                    $generalcommdata['office_number']=$request->office_number;
    
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'general'=>$generalcommdata,
                        'email'=>$request->email,
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }      
                }

                if($request->type =='projectLocation'){
                    // dd($request);
                    $validation = Validator::make($request->all(), [
                    'state'=>'required',
                    'district_id'=>'required',
                    'sub_district_id'=>'required',
                    'village'=>'required',
                    'latitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                    'longitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                    ]
                    );
                    if ($validation->fails()){ 
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    } 
                    $projectlocationdata=array();
                    $projectlocationdata['state']=$request->state;
                    $projectlocationdata['district']=$request->district_id;
                    $projectlocationdata['sub_district_id']=$request->sub_district_id;
                    $projectlocationdata['village']=$request->village;
                    $projectlocationdata['latitude']=$request->latitude;
                    $projectlocationdata['longitude']=$request->longitude;
                
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                            'project_location'=>$projectlocationdata,
                            'state'=>$request->state,
                            'district'=>$request->district_id
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Project Location Detail','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }      
                }

                if($request->type =='projectSolarPark'){
                   
                    $validation = Validator::make($request->all(), [
                    'solar_park_project'=>'required',
                    
                    ]
                    );
                    if ($validation->fails()){  
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $projectSolarParkdata=array();
                    $projectSolarParkdata['solar_park_project']=$request->solar_park_project;
                    $projectSolarParkdata['solarpark_name']=$request->solarpark_name;
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'project_solar_park'=>$projectSolarParkdata,
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Solar Park Project Data','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                    }      
                }
            
                if($request->type =='projectType'){
                    $validation = Validator::make($request->all(), [
                        // 'project_type_gm' => 'required_without_all: project_type_rt, project_type',
                        // 'project_type_rt' => 'required_without_all: project_type_gm, project_type',
                        // 'project_type' => 'required_without_all: project_type_gm, project_type_rt',
                        'type_of_module'=>'required|in:THIN,POLY,MONO,OTHER',
                        'module_remarks'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                    ],[
                        'project_type_gm.required_without_all'=>'Please select Project Type',
                        'project_type_rt.required_without_all'=>'Please select Project Type',
                        'project_type.required_without_all'=>'Please select Project Type',
                    ]
                    );
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $projectTypedata=array();
                    $projectTypedata['project_type_gm']=$request->project_type_gm;
                    $projectTypedata['project_type_rt']=$request->project_type_rt;
                    $projectTypedata['project_type']=$request->project_type;
                    $projectTypedata['type_of_module']=$request->type_of_module;
                    $projectTypedata['module_remarks']=$request->module_remarks;
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'project_type'=>$projectTypedata,
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Type of Project Data','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                    }      
                }

                if($request->type =='schemeDetails'){
                    $validation = Validator::make($request->all(), [
                    'scheme_from'=>'required|in:CENTRAL,STATE',
                    'select_sale_capacity'=>'required|in:CAPTIVE,PPA,ANOTHER_PARTY',
                    'tenure_ppa'=>'required',
                    'electricity_per_unit_cost'=>'required',
                    ]
                    );
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $selectedshemedata=array();
                    $selectedshemedata['scheme_from']=$request->scheme_from;
                    $selectedshemedata['select_sale_capacity']=$request->select_sale_capacity;
                    $selectedshemedata['tenure_ppa']=$request->tenure_ppa;
                    $selectedshemedata['electricity_per_unit_cost']=$request->electricity_per_unit_cost;
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'scheme_details'=>$selectedshemedata,
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Scheme Details Data','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                    }      
                }

                if($request->type =='projectDetails'){
                    // dd($request);
                    $validation = Validator::make($request->all(), [
                    'discom_name'=>'required',
                    'substation_name'=>'required',
                    'substation_voltage_level'=>'required',
                    'feeder_name'=>'required',
                    'feeder_voltage'=>'required',
                    ]
                    );
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $projectDetailsdata=array();
                    $projectDetailsdata['discom_name']=$request->discom_name;
                    $projectDetailsdata['substation_name']=$request->substation_name;
                    $projectDetailsdata['substation_voltage_level']=$request->substation_voltage_level;
                    $projectDetailsdata['feeder_name']=$request->feeder_name;
                    $projectDetailsdata['feeder_voltage']=$request->feeder_voltage;
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'project_details'=>$projectDetailsdata,
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Project Details Data','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                    }      
                }

                if($request->type =='commissioningDetails'){
                    $validation = Validator::make($request->all(), [
                    'commissioned_ac_capacity'=>'required|min:0',
                    'commissioned_dc_capacity'=>'required|min:0',
                    'commissioning_date'=>'required',
                    ]
                    );
                    if ($validation->fails()){  
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $commissioneddata=array();
                    $commissioneddata['commissioned_ac_capacity']=$request->commissioned_ac_capacity;
                    $commissioneddata['commissioned_dc_capacity']=$request->commissioned_dc_capacity;
                    $commissioneddata['commissioning_date']=$request->commissioning_date;
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'commissioning'=>$commissioneddata,
    
                        ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Commissioning Details','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                    }      
                }

                if($request->type =='additionalInformation'){
                    $validation = Validator::make($request->all(), [
                    'additional_information'=>'required',
                    ]);
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    if($request->editId){
                        solarPowerReport::where('id',$request->editId)->update([
                        'additional_information'=>$request->additional_information,
                        'submitted_on' => $this->getCurruntDate(),
                        'final_submission'=>1 ,
                        ]);
                        $url=urlencode('/state-implementing-agency/recieved-progress-report');
                        $auditData = array('action_type'=>'3','description'=>'SNA Update Additional Information Data','user_type'=>'2'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
                    }      
                }
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
            
        }

        $auditData = array('action_type'=>'1','description'=>'SNA view all page','user_type'=>'2');
        $this->auditTrail($auditData);
        $generalData=array();
        $data= solarPowerReport::select('*')->where('id',$id)->where('sna_id',Auth::id())->first();
        if($data!=null){
            if($data->final_submission==1){
                return redirect(Auth::getDefaultDriver().'/solar-Power-commissioning-Report'); 
            }
            $generalData['month']=$data->month;
            $generalData['year']=$data->year;
            $generalData['id']=$data->id;
            $generalData['general'] = json_decode($data->general, true);
            $generalData['projectLocation'] = json_decode($data->project_location, true);
            $generalData['project_solar_park'] = json_decode($data->project_solar_park, true);
            $generalData['project_type'] = json_decode($data->project_type, true);
            $generalData['scheme_details'] = json_decode($data->scheme_details, true);
            $generalData['project_details'] = json_decode($data->project_details, true);
            $generalData['commissioning'] = json_decode($data->commissioning, true);
            $generalData['additional_information']=$data->additional_information;
            
            $states=State::orderby("name")->get();
            $auditData = array('action_type'=>'1','description'=>'SNA View Commisioning Data','user_type'=>'2'); $this->auditTrail($auditData);
            return view('backend.state-implementing-agency.commisioning.commisioningReport',compact('states','id','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        }
    }
    public function solarPowerunderImplementationReport(Request $request , $id=NULL){
       
        if($request->isMethod('post'))
        {
            
            if($request->type =='general'){
                $validation = Validator::make($request->all(), [
                    'ceo_name'=>'required|max:75',
                    'developer_name'=>'required|max:75',
                    'head_name'=>'required',
                    // 'scheme_name'=>'required',
                    'office_address'=>'required|max:500',
                    'contact_number'=>'required',
                    'mobile_number'=>'required|max:10|min:10',
                    'contact_number'=>'required',
                    'email'=>'required|email',
                    'project_capacity'=>'required|min:0',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $generaldata=array();
                $generaldata['tender']=$request->tender;
                $generaldata['developer_name']=$request->developer_name;
                $generaldata['ceo_name']=$request->ceo_name;
                $generaldata['head_name']=$request->head_name;
                $generaldata['scheme_name']=$request->scheme_name;
                $generaldata['office_address']=$request->office_address;
                $generaldata['office_contact_number']=$request->office_contact_number;
                $generaldata['mobile_number']=$request->mobile_number;
                $generaldata['contact_number']=$request->contact_number;
                $generaldata['email']=$request->email;
                $generaldata['project_capacity']=$request->project_capacity;
                //dd($generaldata);
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'general'=>$generaldata,
                    'email'=>$request->email, ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='projectLocation'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'state'=>'required',
                    'district_id'=>'required',
                    'sub_district_id'=>'required',
                    'village'=>'required',
                    'latitude'=>'required|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                    'longitude'=>'required|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                    'inside_solar_park'=>'required|in:A,B',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $projectLocationdata=array();
                $projectLocationdata['state']=$request->state;
                $projectLocationdata['district_id']=$request->district_id;
                $projectLocationdata['sub_district_id']=$request->sub_district_id;
                $projectLocationdata['village']=$request->village;
                $projectLocationdata['latitude']=$request->latitude;
                $projectLocationdata['longitude']=$request->longitude;
                $projectLocationdata['inside_solar_park']=$request->inside_solar_park;
                // dd($generaldata);
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'project_location'=>$projectLocationdata,
                    'email'=>$request->email,
                    'state'=>$request->state,
                    'district'=>$request->district_id,
                ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='date'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'rfs_date'=>'required',
                    'ra_date'=>'required',
                    'loi_date'=>'required',
                    'ppa_date'=>'required',
                    'scheduled_commisioning_date'=>'required',
                    'extended_commisioning_date'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $datedata=array();
                $datedata['rfs_date']=$request->rfs_date;
                $datedata['ra_date']=$request->ra_date;
                $datedata['loi_date']=$request->loi_date;
                $datedata['ppa_date']=$request->ppa_date;
                $datedata['scheduled_commisioning_date']=$request->scheduled_commisioning_date;
                $datedata['extended_commisioning_date']=$request->extended_commisioning_date;
                // dd($generaldata);
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'date'=>$datedata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='status'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'voltage_level'=>'required|min:0',
                    'stage2_status'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                    'lta_status'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                    'ltoa_date'=>'required',
                    'sub_station_status'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $statusdata=array();
                $statusdata['voltage_level']=$request->voltage_level;
                $statusdata['stage2_status']=$request->stage2_status;
                $statusdata['lta_status']=$request->lta_status;
                $statusdata['ltoa_date']=$request->ltoa_date;
                $statusdata['sub_station_status']=$request->sub_station_status;
                // dd($generaldata);
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'solar_project_status'=>$statusdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='scheduled'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                    'scheduled_transmission_date'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $scheduleddata=array();
                $scheduleddata['scheduled_transmission_date']=$request->scheduled_transmission_date;
                
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'scheduled_transmission_date'=>$scheduleddata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='extendedDate'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'extended_commissioning_date'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $extendeddata=array();
                $extendeddata['extended_commissioning_date']=$request->extended_commissioning_date;
                //    dd($extendeddata);
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'extended_commissioning_date'=>$extendeddata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                }      
            }
            if($request->type =='additionalInformation'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'additional_information'=>'required',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                // $additionaldata=array();
                // $additionaldata['additional_information']=$request->additional_information;
                
                if($request->editId){
                    // dd($request->editId);
                    solarPowerReport::where('id',$request->editId)->update([
                    'additional_information'=>$request->additional_information,
                    'submitted_on' => $this->getCurruntDate(),
                    'final_submission'=>1,
                    ]);
                    $url=urlencode('/state-implementing-agency/recieved-progress-report');
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'2'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>$url,'redirect'=>'yes']); 

                }      
            }
        }
        $auditData = array('action_type'=>'1','description'=>'SNA view all page','user_type'=>'2');
        $this->auditTrail($auditData);
        $generalData=array();
        $data= solarPowerReport::select('*')->where('id',$id)->where('sna_id',Auth::id())->first();
        if($data!=null){
            if($data->final_submission==1){
                return redirect(Auth::getDefaultDriver().'/solar-Power-commissioning-Report'); 
            }
            $generalData['month']=$data->month;
            $generalData['year']=$data->year;
            $generalData['id']=$data->id;
            $generalData['general'] = json_decode($data->general, true);
            $generalData['project_location'] = json_decode($data->project_location, true);
            $generalData['date'] = json_decode($data->date, true);
            $generalData['status'] = json_decode($data->solar_project_status, true);
            $generalData['scheduled'] = json_decode($data->scheduled_transmission_date, true);
            $generalData['extendedDate'] = json_decode($data->extended_commissioning_date, true);
            $generalData['additional_information']=$data->additional_information;
            
            /****************************** code of json_decode************/
            $states=State::orderby("name")->get();
            // $states = State::All();
            $auditData = array('action_type'=>'1','description'=>'SNA Under Implementation Details','user_type'=>'2'); $this->auditTrail($auditData);
            return view('backend.state-implementing-agency.under_implementation.underImplementationReport',compact('states','id','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        }
        
    }
    public function solarRooftopReport(Request $request, $id=NULL){
        if($request->isMethod('post')){
            
            $validation = Validator::make($request->all(), [
                    'financial_year'=>'required',
                    'gm_number'=>'required|min:0',
                    'gm_capacity'=>'required|min:0',
                    'consumer_number'=>'required|min:0',
                    'cunsumer_capacity'=>'required|min:0',
                    'fc_number'=>'required|min:0',
                    'fc_capacity'=>'required|min:0',
                    'ipds_number'=>'required|min:0',
                    'ipds_capacity'=>'required|min:0',
                    'sr_number'=>'required|min:0',
                    'sr_capacity'=>'required|min:0',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }

                $solarRooftop=new SolarRooftop();
                $solarRooftop->financial_year=$request->financial_year;
                $solarRooftop->gm_number=$request->gm_number;
                $solarRooftop->gm_capacity=$request->gm_capacity;
                $solarRooftop->consumer_number=$request->consumer_number;
                $solarRooftop->cunsumer_capacity=$request->cunsumer_capacity;
                $solarRooftop->fc_number=$request->fc_number;
                $solarRooftop->fc_capacity=$request->fc_capacity;
                $solarRooftop->ipds_number=$request->ipds_number;
                $solarRooftop->ipds_capacity=$request->ipds_capacity;
                $solarRooftop->sr_number=$request->sr_number;
                $solarRooftop->sr_capacity=$request->sr_capacity;
                $solarRooftop->sna_id=Auth::id();
                $solarRooftop->save();
                // $id=$solarRooftop->id;
                //echo $id.'----'.$solarRooftop->id;die;
                solarPowerReport::where('id',$request->rf_id)->update([
                    'rooftop_report_id'=>$solarRooftop->id,
                    'final_submission'=>1 ,
                    'submitted_on' => $this->getCurruntDate()
                    ]);
                $url=urlencode('/state-implementing-agency/recieved-progress-report');
                $auditData = array('action_type'=>'3','description'=>'SNA Submitted Solarrooftop Report','user_type'=>'2'); $this->auditTrail($auditData);
                return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
                // return redirect(Auth::getDefaultDriver().'/recieved-progress-report/');
                //return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        return view('backend.state-implementing-agency.commisioning.solarRooftopReport',compact('id'));
    }
    public function previewProgressReport($id){
        $progressDetailspreview=solarPowerReport::where('id',$id)->first();
        $previewData=array();
        $previewData=$progressDetailspreview;

        $previewData['general']=json_decode($progressDetailspreview['general'], true);
        $previewData['tender']=json_decode($progressDetailspreview['tender'], true);
        $previewData['reverse_auction']=json_decode($progressDetailspreview['reverse_auction'], true);
        $previewData['solar_project_status']=json_decode($progressDetailspreview['solar_project_status'], true);
        $previewData['date']=json_decode($progressDetailspreview['date'], true);
        $previewData['cancelled_tenders']=json_decode($progressDetailspreview['cancelled_tenders'], true);
        $previewData['selectedBidders']=json_decode($progressDetailspreview['selected_bidders'], true);
        $previewData['discoveredTariffs']=json_decode($progressDetailspreview['discovered_tariff'], true);
        $previewData['signingOfPPAPSA']=json_decode($progressDetailspreview['signing_of_ppa_psa'], true);
        $previewData['commissioning']=json_decode($progressDetailspreview['commissioning'], true);
        $previewData['additionalInformation']=json_decode($progressDetailspreview['additional_information'], true);
        $previewData['project_location']=json_decode($progressDetailspreview['project_location'], true);
        $previewData['scheme_details']=json_decode($progressDetailspreview['scheme_details'], true);
        $previewData['project_solar_park']=json_decode($progressDetailspreview['project_solar_park'], true);
        $previewData['project_type']=json_decode($progressDetailspreview['project_type'], true);
        $previewData['project_details']=json_decode($progressDetailspreview['project_details'], true);

        $previewData['scheduled_transmission_date']=json_decode($progressDetailspreview['scheduled_transmission_date'], true);
        $previewData['extended_commissioning_date']=json_decode($progressDetailspreview['extended_commissioning_date'], true);

        if($progressDetailspreview->report_sub_type !='rooftop_report'){
            $state=State::select('name')->where('code',$previewData['state'])->first()['name'];
            $district=District::select('name')->where('code',$previewData['district'])->first()['name'];
            if($progressDetailspreview->report_type==1){
                $sub_district=SubDistrict::select('name')->where('code',$previewData['general']['sub_district'])->first()['name'];
                $village=Village::select('name')->where('code',$previewData['general']['village'])->first()['name'];
            }else{
                $sub_district=SubDistrict::select('name')->where('code',$previewData['project_location']['sub_district_id'])->first()['name'];
                $village=Village::select('name')->where('code',$previewData['project_location']['village'])->first()['name'];
            }
            $previewData['state']=$state;
            $previewData['district']=$district;
            $previewData['sub_district']=$sub_district;
            $previewData['village']=$village;
        }else{
            $previewData['rooftopdata']=SolarRooftop::where('id',$previewData['rooftop_report_id'])->first();
        }
        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'2');
        $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.previewProgressReport',compact('progressDetailspreview','previewData','id'));
        // return view('backend.state-implementing-agency.solar_power.previewProgressReport',compact('progressDetailspreview','previewData','id'));
    }
    public function checkedPreviousReport($type,$month,$year,$id){
        if($month==1){
            $month=12;
            $year=($year-1);
        }else{
            $month=$month-1;
        }
        $previousprogressReport=solarPowerReport::select($type)->where('month',$month)->where('year',$year)->where('sna_id',Auth::id())->first();
        if($previousprogressReport==null){
            return response()->json(['status' => 'erroe','message'=>'Details Not Exists!']);
        }
        $auditData = array('action_type'=>'3','description'=>'User Copied Previous Data in Progress Report','user_type'=>'2');
        $this->auditTrail($auditData);
        $data=solarPowerReport::where('id',$id)->update([$type=>$previousprogressReport->$type]);
        return response()->json(['status' => 'success','message'=>'Details save successfuly!']);
        // if($data){  
        // }
        // return response()->json(['status' => 'error','message'=>'error!']);
        // dd($previousprogressReport->$type);
    }
} 