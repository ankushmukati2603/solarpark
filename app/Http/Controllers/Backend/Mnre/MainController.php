<?php

namespace App\Http\Controllers\Backend\Mnre;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Mnre;
use App\Models\Program;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Beneficiary;
use App\Models\SNAArchiveReport;
use App\Models\RooftopArchiveReport;
use App\Models\DeveloperArchiveReport;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\StateImplementingAgencyUser;
use App\Models\MaintenanceRequest;
use App\Models\LocalbodyUser;
use App\Models\MaintenanceRegistry;
use App\Models\InstallationReviewLog;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\Inspection;
use App\Models\ProgressReport;
use App\Models\AuditTrail;
use App\Models\StuUser;
use App\Models\PasswordHistoryLog;
use App\Models\ManageSolarPark;
use App\Models\Tenders;
use App\Models\CancelTender;

use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use DB, URL, Auth, Hash, Storage, Validator, Config, Session;
class MainController extends Controller
{
    use General;
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function index(){
        $dashboard = new Dashboard();//App-utils-Dashboard
        $data = $dashboard->getMNREDashboardData();//Dashboard.php (getMNREDashboardData)
        $auditData = array('action_type'=>'1','description'=>'MNRE viewed Dashboard','user_type'=>'1');
        $this->auditTrail($auditData);
        return view('backend.mnre.dashboard', compact('data'));
    }
    public function previewDocs($folder,$subfolder, $file, $maintenanceRegistryCode = NULL){
        $filePath = 'systems/'.$folder.'/'.$subfolder.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }

    // SNA List
    public function snaList(){
        $snaDetail=StateImplementingAgencyUser::getSnaUsers();
        $auditData = array('action_type'=>'3','description'=>'MNRE View Agency/Solar Power User List','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.snaList',compact('snaDetail'));
    }
    public function snaApproveReject(Request $request){
        $validation = Validator::make($request->all(), [
            'isApproved'=>'required',
            'remarks'=>'required',
        ],[
            'isApproved.required'=>'This field is required',
            'remarks.required'=>'This field is required',
        ]
        );                                                        
        if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        $status="Rejected";
        if($request->isApproved==1){
            $status="Approved";
            // Email will shoot for Password
        }
        $id=$this->decodeid($request->id);
        $snaData=StateImplementingAgencyUser::find($id);
        $snaData->isApproved = $request->isApproved;
        $snaData->remarks = $request->remarks;
        $snaData->save();
        $auditData = array('action_type'=>'3','description'=>'SNA Status Updated','user_type'=>'2'); $this->auditTrail($auditData);
        $url=urlencode('/'.Auth::getDefaultDriver().'/sna-list');
        return response()->json(['status' => 'success','message'=>'SNA '.$status.' successfuly!','url'=>$url,'redirect'=>'yes']);
    }

    // STU List
    public function stuList(){
        $stuDetail=StuUser::getStuUsers();
        $auditData = array('action_type'=>'3','description'=>'MNRE View Stu User List','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.stuList',compact('stuDetail'));
    }
    public function StuApproveReject(Request $request){
        $validation = Validator::make($request->all(), [
            'isApproved'=>'required',
            'remarks'=>'required',
        ],[
            'isApproved.required'=>'This field is required',
            'remarks.required'=>'This field is required',
        ]
        );                                                        
        if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        $status="Rejected";
        if($request->isApproved==1){
            $status="Approved";
        }
        $id=$this->decodeid($request->id);
        $snaData=StuUser::find($id);
        $snaData->isApproved = $request->isApproved;
        $snaData->remarks = $request->remarks;
        $snaData->save();
        $auditData = array('action_type'=>'3','description'=>'STU Status Updated','user_type'=>'2'); $this->auditTrail($auditData);
        $url=urlencode('/'.Auth::getDefaultDriver().'/stu-list');
        return response()->json(['status' => 'success','message'=>'STU '.$status.' successfuly!','url'=>$url,'redirect'=>'yes']);
    }

    public function sppdList(){
        $sppdList=Beneficiary::getMnreUsers();
        $auditData = array('action_type'=>'1','description'=>'MNRE View Developer List','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.sppdList',compact('sppdList'));
    }
    
    public function sppdApproveReject(Request $request){
        $validation = Validator::make($request->all(), [
            'isApproved'=>'required',
            'remarks'=>'required',
        ],[
            'isApproved.required'=>'This field is required',
            'remarks.required'=>'This field is required',
        ]
        );                                                        
        if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        $status="Rejected";
        if($request->isApproved==1){
            $status="Approved";
            // Email will shoot for Password
        }
        $id=$this->decodeid($request->id);
        $snaData=Beneficiary::find($id);
        $snaData->isApproved = $request->isApproved;
        $snaData->remarks = $request->remarks;
        $snaData->save();
        $auditData = array('action_type'=>'3','description'=>'SPPD Status Updated','user_type'=>'2'); $this->auditTrail($auditData);
        $url=urlencode('/'.Auth::getDefaultDriver().'/sppd-list');
        return response()->json(['status' => 'success','message'=>'SPPD '.$status.' successfuly!','url'=>$url,'redirect'=>'yes']);
    }



    public function mnreUsers(Request $request){
        $users = Mnre::where('admin', 0)->get();//data fatch kiya
         /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'1','description'=>'MNRE viewed  User List','user_type'=>'1');
        $this->auditTrail($auditData);
         /*************************Audit Trail Start**********************************/
        return view('backend.mnre.mnreUserList', compact('users'));
    }
    public function editProfile(Request $request){
        try { 
            $user = Auth::user();
            $states = State::orderby('name')->get();
            if($request->isMethod('get')){
                return view('backend.mnre.editProfile', compact('user','states'));
            }
            $validation = Validator::make($request->all(), [
                'email'=>'required',
                'name'=>'required',
                'contact_no'=>'required',
                'state'=>'required',
                'district_id'=>'required',
            ],[
                'district_id.required'=>'This field is required',
                'state.required'=>'This field is required',
                'contact_no.required'=>'This field is required',
            ]
            );                                                        
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_no = $request->contact_no;
            $user->state = $request->state;
            $user->district_id = $request->district_id;
            $isSaved=$user->save();
            //dd($user);
            $auditData = array('action_type'=>'7','description'=>' MNRE User updte Profile','user_type'=>'1');
            $this->auditTrail($auditData);
            if($isSaved){
                $url=urlencode('/'.Auth::getDefaultDriver().'/edit-profile');
                return response()->json(['status' => 'success','message'=>'Profile updated successfuly!','url'=>$url,'redirect'=>'yes']);
               
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server Error !");
        }
    }
    public function changePassword(Request $request){
        try {
            if ($request->isMethod('get')) {
                $submitUrl = URL::to(Auth::getDefaultDriver().'/change-password');
                $auditData = array('action_type' => '3', 'description' => ' MNRE User  Change Password ', 'user_type' => '2');
                $this->auditTrail($auditData);
                return view('backend.mnre.changePassword', compact('submitUrl'));
            }
            $validation = Validator::make($request->all(), [
            'current_password'=>'required',
            'new_password'=>'required',
            'new_password_confirmation'=>'required',
            
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return redirect()->back()->with("error", "Please filled all details. Please try again.");
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
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
                // return response()->json(['status' => 'error','message'=>'Your current password does not matches with the password you provided. Please try again.']);
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
            }

            if ($new_password != $new_password_confirmation) {
                $error = 'New Password and Confirm Password not match';
                /*                 * ***********************Audit Trail Start********************************* */
                $auditData = array('action_type' => '1', 'description' => 'New Password and Confirm Password not match', 'user_type' => '1');
                $this->auditTrail($auditData);
                /*                 * ***********************Audit Trail Start********************************* */
                // return response()->json(['status' => 'error','message'=>'New Password and Confirm Password not match']);
                return redirect()->back()->with("error", $error);
            }
            if ((strpos($new_password, Auth::user()->name) !== false)) {
                // return response()->json(['status' => 'error','message'=>'Password not match as well as name']);
                return redirect()->back()->with("error", "Password not match as well as name");
            }
            $user_type = Auth::getDefaultDriver();
            $user_id = Auth::user()->id;

            $histories = PasswordHistoryLog::select('password')->where('user_id', $user_id)->where('user_type', 'sna')->get();
            foreach ($histories as $history) {
                if ((Hash::check($new_password, $history->password))) {
                    // return response()->json(['status' => 'error','message'=>'This password already used previously']);
                    return redirect()->back()->with("error", "This password already used previously");
                }
            }
            if (!$this->passwordPolicyTest($new_password)) {
                $error = 'Failed strong password policy!';
                /*                 * ***********************Audit Trail Start********************************* */
                $auditData = array('action_type' => '1', 'description' => ' MNRE User Test password Policy  ', 'user_type' => '1');
                $this->auditTrail($auditData);
                /*                 * ***********************Audit Trail Start********************************* */
                // return response()->json(['status' => 'error','message'=>$error]);
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
            /*************************Audit Trail Start********************************* */
            $auditData = array('action_type' => '2', 'description' => ' SNA User Inserted new password  ', 'user_type' => '1');
            $this->auditTrail($auditData);
            $url = urlencode('/'.Auth::getDefaultDriver().'/change-password');
            /*************************Audit Trail Start********************************* */
            // return response()->json(['status' => 'success','message'=>'Password changed successfully !','url'=>$url,'redirect'=>'yes']);
            return redirect()->back()->with("status", "Password changed successfully !");
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            die;
        }
    }
    
    //Created By Raushan
    public function mnredeveloper(Request $request){
        if($request->isMethod('post')){
            //dd($request);
            $validation = Validator::make($request->all(), [
            'name'=>'required|max:75|regex:/^[a-zA-Z ]+$/u',
            'mobile_number'=>'required|max:10|min:10',
            'email'=>'required|email',
            'solar_park_name'=>'required|max:500|regex:/^[a-zA-Z ]+$/u',
            'state_id'=>'required',
            'district_id'=>'required',
            'sub_district_id'=>'required',
            'village'=>'required',
            'user_type'=>'required|gte:0|lte:2',
            ]
            );
                                                                          
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $mnredeveloperdata=new Beneficiary();
            // $mnredeveloperdata=array();
            $mnredeveloperdata['name']=$request->name;
            $mnredeveloperdata['contact_no']=$request->mobile_number;
            $mnredeveloperdata['email']=$request->email;
            $mnredeveloperdata['password']=Hash::make($request->password);
            $mnredeveloperdata['solar_park_name']=$request->solar_park_name;
            $mnredeveloperdata['state_id']=$request->state_id;
            $mnredeveloperdata['district_id']=$request->district_id;
            $mnredeveloperdata['sub_district_id']=$request->sub_district_id;
            $mnredeveloperdata['village']=$request->village;
            $mnredeveloperdata['user_type']=$request->user_type;
            $mnredeveloperdata->save();
            $id=$mnredeveloperdata->id;
              
            $url = urlencode(Auth::getDefaultDriver().'/developer-mnre/'.$id);
            return response()->json(['status' => 'success','message'=>'Details save successfuly','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
        } 
        $auditData = array('action_type'=>'2','description'=>'MNRE Insert General Details for Developer','user_type'=>'1'); $this->auditTrail($auditData);
           $states = State::orderby('name')->get();
           return view('backend.mnre.mnredeveloper',compact('states')); 
    }
    public function mnreagency(Request $request ,$id=NULL){

        if($request->isMethod('post')){
            //dd($request);
            $validation = Validator::make($request->all(), [
            'agency_name'=>'required|max:75|regex:/^[a-zA-Z ]+$/u',
            'agency_type'=>'required',
            'sna_type'=>'required|gte:0|lte:1',
            'email'=>'required|unique:state_implementing_agency_users',
            'phone'=>'required|max:10|unique:state_implementing_agency_users',
            'office_addess'=>'required|max:300|regex:/^[a-zA-Z.,_ ]+$/u',
            'zipcode'=>'required|max:6',
            'state_id'=>'required',
            'district_id'=>'required',
            'sub_district_id'=>'required',
            'village'=>'required',
            
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            if($id==NULL){
                $mnreagencydata=new StateImplementingAgencyUser();
            }else{
                $mnreagencydata=StateImplementingAgencyUser();
            }
           
            //$mnredeveloperdata=array();
            $mnreagencydata['agency_name']=$request->agency_name;
            $mnreagencydata['name']=$request->agency_name;
            $mnreagencydata['agency_type']=$request->agency_type;
            $mnreagencydata['sna_type']=$request->sna_type;
            $mnreagencydata['email']=$request->email;
            $mnreagencydata['phone']=$request->phone ;
            $mnreagencydata['office_addess']=$request->office_addess;
            $mnreagencydata['zipcode']=$request->zipcode;
            $mnreagencydata['state_id']=$request->state_id;
            $mnreagencydata['district_id']=$request->district_id;
            $mnreagencydata['sub_district_id']=$request->sub_district_id;
            $mnreagencydata['village']=$request->village;
           
            $mnreagencydata->save();
            $id=$mnreagencydata->id;
            $url = urlencode('/'.Auth::getDefaultDriver().'/agency-mnre');

            return response()->json(['status' => 'success','message'=>'Details save successfuly','url'=>$url,'redirect'=>'yes']);
        } 
        $auditData = array('action_type'=>'2','description'=>'MNRE Insert General Details for Agency/Solar power User','user_type'=>'1'); $this->auditTrail($auditData);
           $states = State::orderby('name')->get();
           $agencyData=array();
           if($id!=NULL){
            $agencyData=StateImplementingAgencyUser::where('id',$id)->first();
            // dd($agencyData);
           }
        return view('backend.mnre.mnreagency',compact('states','agencyData'));
    }
    public function mnreform(Request $request){
        if($request->isMethod('post')){
             $validation = Validator::make($request->all(), [
                'name'=>'required|regex:/^[a-zA-Z ]+$/u',
                'email_id'=>'required|email',
                'mobile_number'=>'required|numeric|digits:10',
                'user_type'=>'required|gte:1|lte:2',
                'designation_name'=>'required|regex:/^[a-zA-Z ]+$/u',
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $mnreformdata=new Mnre();
            //$mnredeveloperdata=array();
            $mnreformdata['name']=$request->name;
            $mnreformdata['email']=$request->email_id;
            $mnreformdata['password']=Hash::make($request->password);
            $mnreformdata['mobile_number']=$request->mobile_number;
            $mnreformdata['user_code']=$request->user_type;
            $mnreformdata['designation_name']=$request->designation_name;
            $mnreformdata->save();
            $id=$mnreformdata->id;
            $url = urlencode(Auth::getDefaultDriver().'/mnre-form/'.$id);
            return response()->json(['status' => 'success','message'=>'Details save successfuly','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
        } 
        if($request->editId){
            $data= ProgressReport::where('id',$request->editId)->update([
                'status'=>$request->input('status'),
                'remarks'=>$request->input('mnreremarks'),
            ]);
            $auditData = array('action_type'=>'3','description'=>'MNRE Update Progress Report Status','user_type'=>'1'); $this->auditTrail($auditData);
            $url = urlencode('/'.Auth::getDefaultDriver().'/progress-report');
            return response()->json(['status' => 'success','message'=>'Remark save successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        return view('backend.mnre.mnreform');
    }
    
    
    public function mnreList(){
        $mnreuserDetail=Mnre::All();
        $auditData = array('action_type'=>'3','description'=>'MNRE(admin) View MNRE User List','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.mnreList',compact('mnreuserDetail'));
    }
    public function agencyarchiveReport(Request $request){
        if($request->isMethod('post')){
            $file = $request->file('upload_file');
            if ($file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
                $tempPath = $file->getRealPath();
                $fileSize = $file->getSize(); //Get size of uploaded file in bytes
                //Check for file extension and size
                $this->checkUploadedFileProperties($extension, $fileSize);
                //$dir_path = 'systems\\legaluserfiles\\';
                //Storage::disk('filestore')->makeDirectory($dir_path);
                //$result = $this->uploadFile($file, $dir_path);
                //$filepath = storage_path('documents/'.$dir_path . "/" . $result['name']);
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/archiveReport/';
                //echo  $filename."<br>";
                $file->move($destinationPath, $filename);
                //Maintaining History
                // Reading file
                // $file = fopen($filepath, "r");
                $file = fopen($destinationPath.$filename, "r");

                $importData_arr = array(); 
                $i = 0;
                
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);
                    if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                    $i++;
                }
                fclose($file); 
                $j = 0;$row='';$msg='';
                // dd($importData_arr);
                try {
                    //code...
                    foreach ($importData_arr as $importData) {
                        $j++;
                        if($request->report_type == 1){
                            $newProgressData=new SNAArchiveReport();
                            $newProgressData->year=$request->select_year;
                            $newProgressData->sna_name=$request->sna_name;
                            $newProgressData->report_type=$request->report_type;
                            $newProgressData->developer_name=$importData[1];
                            $newProgressData->ceo_name=$importData[2];
                            $newProgressData->address=$importData[3];
                            $newProgressData->office_contact_number=$importData[4];
                            $newProgressData->mobile_number=$importData[5];
                            $newProgressData->email=$importData[6];
                            $newProgressData->project_capacity=$importData[7];
                            $newProgressData->project_location=$importData[8];
                            $newProgressData->project_tehsil_taluka=$importData[9];
                            $newProgressData->project_district=$importData[10];
                            $newProgressData->project_longitude=$importData[11];
                            $newProgressData->project_latitude=$importData[12];
                            $newProgressData->project_solarpark=$importData[13];
                            $newProgressData->solar_park_name=$importData[14];
                            $newProgressData->project_type=$importData[15];
                            $newProgressData->module_type=$importData[16];
                            $newProgressData->make_module=$importData[17];
                            $newProgressData->scheme_from=$importData[18];
                            $newProgressData->mode_of_sale_power=$importData[19];
                            $newProgressData->ppa_tenure=$importData[20];
                            $newProgressData->substation_name=$importData[21];
                            $newProgressData->substation_voltage_level=$importData[22];
                            $newProgressData->feeder_name=$importData[23];
                            $newProgressData->feeder_voltage=$importData[24];
                            $newProgressData->commi_ac_capacity=$importData[23];
                            $newProgressData->commi_dc_capacity=$importData[26];
                            $newProgressData->commissioning_date=$importData[27];
                            $newProgressData->remarks=$importData[28];
                            $newProgressData->financial_year=$importData[29];
                            $newProgressData->save();
                        }else{
                            $newProgressData=new RooftopArchiveReport(); 
                            $newProgressData->sna_id=$request->sna_name;
                            $newProgressData->entry_date=$this->getCurruntDate();
                            $newProgressData->upto_date=$request->select_year;
                            $newProgressData->financial_year=$importData[0];
                            $newProgressData->gm_number=$importData[1];
                            $newProgressData->gm_capacity=$importData[2];
                            $newProgressData->rooftop_number=$importData[3];
                            $newProgressData->rooftop_capacity=$importData[4];
                            // $newProgressData->total=$importData[5];
                            $newProgressData->save();
                        }
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    //dd($j);
                    dd($th->getMessage());
                }
                if($row!=''){$msg="Lines Ignored : ".$row." Please check the data and reupload file";}
                $auditData = array('action_type'=>'3','description'=>'Issue in file'.$msg ,'user_type'=>'8');
                $this->auditTrail($auditData);
                return redirect(Auth::getDefaultDriver().'/view-agency-archive-report')->with('message', 'Data updated successfuly.');
            } else {
            //no file was uploaded
                return redirect(Auth::getDefaultDriver().'/agency-archive-report')->with('error', 'No file was uploaded');   
                throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
            }
            $auditData = array('action_type'=>'3','description'=>'MNRE(admin) Save SNA Archive Report Data','user_type'=>'1'); $this->auditTrail($auditData);
            return redirect()->back()->with("status","Archive report saved successfully !");
        }
        $agencyusersDetail=StateImplementingAgencyUser::select('name','id','sna_type')->get();
        
        $auditData = array('action_type'=>'1','description'=>'MNRE(admin) View SNA Archive Report Data','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.agencyarchiveReport',compact('agencyusersDetail'));
    }
    public function checkUploadedFileProperties($extension, $fileSize){
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {
            } else {
                return redirect(Auth::getDefaultDriver().'/case-details')->with('error', 'File exceeds the maximum limit.');   
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
            }
        } else {
            return redirect(Auth::getDefaultDriver().'/case-details')->with('error', 'Invalid file extension');   
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }
    public function viewAgencyarchiveReport(Request $request){
        $report_type=0;
        $snaagencyReport=$solarrooftopReport=array();
        $agencyReport=StateImplementingAgencyUser::select('name','id','sna_type')->get();
        if($request->isMethod('post')){
                if($request->report_type==1){
                    $report_type=1;
                    $snaagencyReport=SNAArchiveReport::where('sna_name',$request->sna_name)->get();
                    // dd($snaagencyReport);
                }else{
                    $report_type=2;
                    $solarrooftopReport=RooftopArchiveReport::where('sna_id',$request->sna_name)->get();
                    // dd($solarrooftopReport);
                }
            // dd($snaagencyReport);
            $auditData = array('action_type'=>'1','description'=>'MNRE(admin) View SNA Archive Report','user_type'=>'1'); $this->auditTrail($auditData);
            return view('backend.mnre.viewArchiveReport',compact('agencyReport','snaagencyReport','solarrooftopReport','report_type'));
        }
        $auditData = array('action_type'=>'1','description'=>'MNRE(admin) View SNA Archive Report','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.viewArchiveReport',compact('agencyReport','snaagencyReport','solarrooftopReport','report_type'));
    }
    public function previewArchiveSNAReport(Request $request , $id){
    
        $Archivepreview=SNAArchiveReport::where('id',$id)->first();
        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'1');
        $this->auditTrail($auditData);
        return view('backend.mnre.previewSNAArchiveReport',compact('Archivepreview','id'));
    }
    public function developerArchiveReport(Request $request){
        
        if($request->isMethod('post')){
            // dd($request);
            DB::enableQueryLog();
            
            $newProgressData=new SNAArchiveReport();                                                                                                                                                    
            $newProgressData->month=$request->month;
            $newProgressData->year=$request->year;
            $newProgressData->developer_name=$request->developer_name;

            $newProgressData->solar_park_name=$request->solar_park_name;
            // $newProgressData->report_sub_type=$request->report;
            // $newProgressData->sna_id=Auth::id();
            $newProgressData->save();
            $id=$newProgressData->id;
            $dir_path = 'systems\\'.Auth::id().'\\'.$request->editId.'\\';
            Storage::disk('filestore')->makeDirectory($dir_path);
            if($request->hasFile('upload_file')){
                $rd=rand(6,778798);
                $file= $this->uploadFile($request->file('upload_file'), $dir_path,'UPLOAD_FILE_'.$rd.'_');
                $other_documents=$file['upload_file'];
            }
            return redirect()->back()->with("status","Archive report saved successfully !");
        }
        $developerDetail=DeveloperArchiveReport::select('developer_name','id')->get();
        $developerparkDetail=DeveloperArchiveReport::select('solar_park_name','id')->get();
        $auditData = array('action_type'=>'3','description'=>'MNRE(admin) View MNRE User List','user_type'=>'1'); $this->auditTrail($auditData);
        return view('backend.mnre.developerArchiveReport',compact('developerDetail','developerparkDetail'));
    }

    public function solarPark(){
        try {
            //code...
            $solarparkList=ManageSolarPark::getAllSolarPrk();
            $auditData = array('action_type'=>'3','description'=>'MNRE(admin) View Solar park List','user_type'=>'1'); $this->auditTrail($auditData);
            return view('backend.mnre.solarparkList',compact('solarparkList'));
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        
    }
    public function tenderList(){
        $tenderList=Tenders::getCapacityTenderedList();
        $auditData = array('action_type'=>'1','description'=>'MNRE View capacity Tendered List','user_type'=>'2');
        $this->auditTrail($auditData);
        return view('backend.mnre.capacitytenders',compact('tenderList'));
    }
    public function cancelledtenderList(){
        $cancelledtenderList=CancelTender::getAllCancelTenderList();
        $auditData = array('action_type'=>'1','description'=>'MNRE View Cancelled Tender List','user_type'=>'2');
        $this->auditTrail($auditData);
        return view('backend.mnre.cancelledtender',compact('cancelledtenderList'));
    }
}