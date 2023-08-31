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
// use App\Models\Installer;
use App\Models\SubDistrict;
use App\Models\Village;
// use App\Models\Installation;
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
use App\Models\SmallBiogasPlant;
use App\Models\mediumBiogasPlantBelow10KW;
use App\Models\mediumBiogasPlantAbove10KW;
use App\Imports\InspectorImport;
use App\Imports\InstallerImport;
use App\Imports\LocalbodyImport;
use App\Imports\StateImplementingAgencyImport;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;
use DB, URL, Auth, Hash, Storage, Validator, Config;
class MainController extends Controller
{
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        //dd(Auth::user());
    }
    public function index()
    {
        $dashboard = new Dashboard();//App-utils-Dashboard
        $data = $dashboard->getMNREDashboardData();//Dashboard.php (getMNREDashboardData)
        $auditData = array('action_type'=>'1','description'=>'User viewed MNRE Dashboard','user_type'=>'1');
        $this->auditTrail($auditData);
        return view('backend.mnre.dashboard', compact('data'));
    }
    public function previewDocs($folder,$subfolder, $file, $maintenanceRegistryCode = NULL) {
        $filePath = 'systems/'.$folder.'/'.$subfolder.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }
    public function mnreUsers(Request $request)
    {
        $users = Mnre::where('admin', 0)->get();//data fatch kiya
         /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'1','description'=>'User viewed MNRE User List','user_type'=>'1');
        $this->auditTrail($auditData);
         /*************************Audit Trail Start**********************************/
        return view('backend.mnre.mnreUserList', compact('users'));
    }
 
    public function editProfile(Request $request)
    {
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

            // $validatedData = $request->validate([
            //     'state'=>'required',
            //     'district_id'=>'required',
            //     'date'=>'required',
            // ]);
            $fromdata=$request->input('date');
            $todata=$request->input('date');
            $state=$request->input("state");
            $district=$request->input("district_id");
            $park_name=$request->input("park_name");
            $capacity=$request->input("capacity");
            $progressDetails=array();
            $i=0;
            $progressData= ProgressReport::whereBetween('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59'])
            ->orWhere('state',$state)->orWhere('district',$district)
            ->orWhere('park_name', 'like', '%' . $park_name. '%')
            ->orwhere('capacity',$capacity)->orderBy("submitted_on",'DESC')->get()->toArray();
            // dd($progressData);
            // if($progressData['final_submission']==1){
                foreach($progressData as $data){$i++;
                    if($data['final_submission']==1){
                        $decodeData=json_decode($data['general'],true);
                        $progressDetails[$i] = $data;
                        $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                        $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                    }
                }
                $auditData = array('action_type'=>'1','description'=>'User Search Progress Report Data','user_type'=>'0');
                $this->auditTrail($auditData);
                $states = State::orderby('name')->get();
                return view('backend.mnre.myProgressReport',compact('progressDetails','states'));
            // }
        }
        $auditData = array('action_type'=>'1','description'=>'User Visit Progress Report Page','user_type'=>'0');
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
        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'0');
        $this->auditTrail($auditData);
        // $previousprogressReport=ProgressReport::select($type)->where('month',($month-1))->where('year',$year)->where('user_id',Auth::id())->first();
        return view('backend.mnre.previewProgressReport',compact('progressDetailspreview','previewData','id'));
    }
    public function mnreRemark(Request $request){

        $validation = Validator::make($request->all(), [
        'status'=>'required',
        'mnreremarks'=>'required',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
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

    }



    //Created By Raushan
    public function mnredeveloper(Request $request){
        if($request->isMethod('post')){
            //dd($request);
            $validation = Validator::make($request->all(), [
            'name'=>'required|max:75',
            'mobile_number'=>'required|max:10|min:10',
            'email'=>'required',
            'solar_park_name'=>'required|max:500',
            'state_id'=>'required',
            'district_id'=>'required',
            'sub_district_id'=>'required',
            'village'=>'required',
            'user_type'=>'required',
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
        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
           $states = State::orderby('name')->get();
           return view('backend.mnre.mnredeveloper',compact('states')); 
    }
    

    public function mnreagency(Request $request){

        if($request->isMethod('post')){
            //dd($request);
            $validation = Validator::make($request->all(), [
            'agency_name'=>'required|max:75',
            'agency_type'=>'required',
            'email'=>'required',
            'phone'=>'required|max:500',
            'office_addess'=>'required',
            'zipcode'=>'required',
            'state_id'=>'required',
            'district_id'=>'required',
            'sub_district_id'=>'required',
            'village'=>'required',
            
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $mnreagencydata=new StateImplementingAgencyUser();
            //$mnredeveloperdata=array();
            $mnreagencydata['agency_name']=$request->agency_name;
            $mnreagencydata['agency_type']=$request->agency_type;
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
            $url = urlencode(Auth::getDefaultDriver().'/agency-mnre/'.$id);

            return response()->json(['status' => 'success','message'=>'Details save successfuly','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
        } 
        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
           $states = State::orderby('name')->get();
        return view('backend.mnre.mnreagency',compact('states'));
    }

    public function mnreform(Request $request){
        if($request->isMethod('post')){
             $validation = Validator::make($request->all(), [
                'name'=>'required',
                'email_id'=>'required',
                'mobile_number'=>'required',
                'user_type'=>'required',
                'designation_name'=>'required',
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
   
   

    public function mnredeveloperList(){
        //$developerDetail=MnreDeveloperList::where('id',$id)->first();
    
        $developerDetail=Beneficiary::getMnreUsers();
        //dd( $developerDetail);
        //$developerDetail=Beneficiary::All();
        return view('backend.mnre.developerList',compact('developerDetail'));
    }
  
    public function agencyList(){
        //$agencyDetail=StateImplementingAgencyUser::All();
        $agencyDetail=StateImplementingAgencyUser::getMnreagencyUsers();
        //$userDetail=ManageUser::where('id',Auth::user()->id)->get();
        return view('backend.mnre.agencyList',compact('agencyDetail'));
    }

    public function mnreList(){
        $mnreuserDetail=Mnre::All();
        //$mnreuserDetail=Mnre::where('id',Auth::user()->id)->get();
        return view('backend.mnre.mnreList',compact('mnreuserDetail'));
    }
}