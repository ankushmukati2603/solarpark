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

use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use DB, URL, Auth, Hash, Storage, Validator, Config;
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
            $user->name = $request->name;
            $user->user_code = $request->user_code;
            $user->email = $request->email;
          
             $user->save();
            //dd($user);
            $auditData = array('action_type'=>'7','description'=>' MNRE User Edit User Profile','user_type'=>'1');
            $this->auditTrail($auditData);
            if($isSaved){

                return redirect()->back()->with("status","Profile edited successfully !");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error","Server Error !");
        }
    }
    public function changePassword(Request $request){
        // try {
            if($request->isMethod('get')){
                $submitUrl = URL::to('/mnre/change-password');
                
                $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'1');
                $this->auditTrail($auditData);
               
                return view('backend.mnre.changePassword',compact('submitUrl'));
            }
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                // dd($request->current_password);
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User  Match Password ','user_type'=>'1');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }
            if(!$this->passwordPolicyTest($request->new_password)){
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'1','description'=>' MNRE User Test password Policy  ','user_type'=>'1');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return redirect()->back()->with("error", $error);
            }
            if(strcmp($request->current_password, $request->new_password) == 0){
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User verify condition currunt and new password not same  ','user_type'=>'1');
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
                $auditData = array('action_type'=>'2','description'=>' MNRE User Inserted new password  ','user_type'=>'1');
                $this->auditTrail($auditData);
             /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status","Password changed successfully !");
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with("error","Server Error !");
        // }
    }
    public function progressReport(Request $request){
        if($request->isMethod('post')){

            $validatedData = $request->validate([
                // 'state'=>'required',
                // 'district_id'=>'required',
                // 'date'=>'required',
            ]);
            try {
                //code...
            
                $fromdata=$request->input('date');
                $todata=$request->input('date');
                $state=$request->input("state");
                $district=$request->input("district_id");
                $park_name=$request->input("park_name");
                $capacity=$request->input("capacity");
                $progressDetails=array();
             $i=0;
            // $reportQuery= ProgressReport::whereBetween('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59'])
            //->orWhere('state',$state)->orWhere('district',$district)
            //->orWhere('park_name', 'like', '%' . $park_name. '%')
            //->orwhere('capacity',$capacity)
            // ->where('seci_status',1)->orderBy("submitted_on",'DESC')->toSql();

            $reportQuery=ProgressReport::where('seci_status',1);
            if($request->date !=''){
                $reportQuery->orWhere('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59']);
            }
            if($request->state !=''){
                $reportQuery->orWhere('state',$state);
            }
            if($request->district_id !=''){
                $reportQuery->orWhere('district_id',$district);
            }
            if($request->park_name !=''){
                $reportQuery->orWhere('park_name','like', '%' . $park_name. '%');
            }
            if($request->capacity !=''){
                $reportQuery->orWhere('capacity',$capacity);
            }
            $reportQuery->orderBy("submitted_on",'DESC');
            $progressData=$reportQuery->get();
            // dd(\DB::getQueryLog()); 

            // if($progressData['final_submission']==1){
                foreach($progressData as $data){$i++;
                    if($data['final_submission']==1){

                        $decodeData=json_decode($data['general'],true);
                        $progressDetails[$i] = $data;
                        $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                        $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                    }
                }
                $auditData = array('action_type'=>'1','description'=>'User Search Progress Report Data','user_type'=>'1');
                $this->auditTrail($auditData);
                $states = State::orderby('name')->get();
                return view('backend.mnre.myProgressReport',compact('progressDetails','states'));
            // }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        }
        $auditData = array('action_type'=>'1','description'=>'User Visit Progress Report Page','user_type'=>'1');
        $this->auditTrail($auditData);
        // dd($auditData);
        $progressDetails=array();
        // $i=0;
            // $progressData= ProgressReport::where('final_submission',0)->orderBy("id",'DESC')->get()->toArray();
            // foreach($progressData as $data){$i++;
            //     $decodeData=json_decode($data['general'],true);
            //     $progressDetails[$i] = $data; 
            //     $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
            //     $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
            // }
            $states = State::orderby('name')->get();
        return view('backend.mnre.myProgressReport',compact('progressDetails','states'));
    }
    public function previewProgressReport(Request $request , $id){
        if($request->isMethod('post')){
            
        }
        $progressDetailspreview=ProgressReport::where('id',$id)->first();
        $previewData=array();
        $previewData=$progressDetailspreview;
        $previewData['general']=json_decode($progressDetailspreview['general'], true);
        $previewData['internal_infrastructure']=json_decode($progressDetailspreview['internal_infrastructure'], true);
        $previewData['road']=json_decode($progressDetailspreview['road'], true);
        $previewData['water_facilities']=json_decode($progressDetailspreview['water_facility'], true);
        $previewData['drainage_system']=json_decode($progressDetailspreview['drainage_facility'], true);
        $previewData['fencing_boundary']=json_decode($progressDetailspreview['fencing'], true);
        $previewData['telecommunication_facilities']=json_decode($progressDetailspreview['telecommunication_facility'], true);
        $previewData['internal_transmission_system']=json_decode($progressDetailspreview['internal_transmission_system'], true);
        $previewData['external_transmission_system']=json_decode($progressDetailspreview['external_transmission_system'], true);
        $previewData['solar_projects']=json_decode($progressDetailspreview['solar_projects'], true);
        $previewData['financial_closure']=json_decode($progressDetailspreview['financial_closure'], true);
        $previewData['award_of_work']=json_decode($progressDetailspreview['award_of_work'], true);
        $previewData['solar_park_completion']=json_decode($progressDetailspreview['solarpark_completion'], true);
        $previewData['external_power_evacuation_system']=json_decode($progressDetailspreview['external_power_system'], true);
        $previewData['solar_project_completion']=json_decode($progressDetailspreview['solar_project_completion'], true);
        $previewData['attachments']=json_decode($progressDetailspreview['attachments'], true);
        $previewData['additional_information'] = $progressDetailspreview->additional_information;
        $state=State::select('name')->where('code',$previewData['general']['state'])->first()['name'];
        $district=District::select('name')->where('code',$previewData['general']['district'])->first()['name'];
        $sub_district=SubDistrict::select('name')->where('code',$previewData['general']['sub_district'])->first()['name'];
        $village=Village::select('name')->where('code',$previewData['general']['village'])->first()['name'];
        $previewData['state']=$state;
        $previewData['district']=$district;
        $previewData['sub_district']=$sub_district;
        $previewData['village']=$village;
        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'1');
        $this->auditTrail($auditData);
        // $previousprogressReport=ProgressReport::select($type)->where('month',($month-1))->where('year',$year)->where('user_id',Auth::id())->first();
        return view('backend.mnre.previewProgressReport',compact('progressDetailspreview','previewData','id'));
    }
    public function mnreRemark(Request $request){

        $validation = Validator::make($request->all(), [
        'status'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
        'mnreremarks'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        if($request->editId){
            $data= ProgressReport::where('id',$request->editId)->update([
                'status'=>$request->input('status'),
                'remarks'=>$request->input('mnreremarks'),
            ]);
            $auditData = array('action_type'=>'3','description'=>'MNRE Update Progress Report Status and Remark','user_type'=>'1'); $this->auditTrail($auditData);
            $url = urlencode('/'.Auth::getDefaultDriver().'/progress-report');
            return response()->json(['status' => 'success','message'=>'Remark save successfuly!','url'=>$url,'redirect'=>'yes']);
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
}