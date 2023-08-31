<?php

namespace App\Http\Controllers\Backend\Gecdeveloper;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Traits\General;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\ManageSolarPark;
use App\Models\Village;
use App\Utils\Dashboard;
use App\Models\Consumer;
use App\Models\AuditTrail;
use App\Models\ProgressReport;
use App\Models\GecReport;
use App\Models\mediumBiogasPlantBelow10KW;
use App\Models\mediumBiogasPlantAbove10KW;
use Illuminate\Http\Request;
use Auth , Storage ,Validator,DB,PDF,URL,Hash;

class MainController extends Controller
{
    //
    use General;
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function index(){
        
        $dashboard=new Dashboard();
        // $data=$dashboard->getBeneficiaryDashboardData();
        $data="";
        $auditData = array('action_type'=>'1','description'=>'User Visit Dashboard Page','user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.gecdeveloper.dashboard',compact('data'));
    }
    public function previewDocs($folder,$subfolder, $file, $maintenanceRegistryCode = NULL) {
        $filePath = 'systems/'.$folder.'/'.$subfolder.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }
    public function application(Request $request, $id=NULL){

        if($request->isMethod('post'))
        {
            
            if($request->type == 'general'){
                $validation = Validator::make($request->all(), [
                'park_name'=>'required|max:75',
                'ceo_mail'=>'required',
                'ceo_contact_number'=>'required',
                'state'=>'required',
                'district_id'=>'required',
                'sub_district_id'=>'required',
                'village'=>'required',
                'latitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                'longitude'=>'required|max:22|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{1,5})?$/',
                'capacity'=>'required|min:0',
                // 'date'=>'required',
                'address'=>'required|max:255',
                'park_developer_name'=>'required|max:200',
                'office_contact_number'=>'required|max:10|min:10',
                'concerned_person_name'=>'required|max:75',
                'email'=>'required|email',
                'telephone_number'=>'required|max:11',
                'mobile_number'=>'required|max:10|min:10',
                'dpr_status'=>'required',
                ],
                [
                'state.required'=>'Please select State',
                'district_id.required'=>'Please select District',
                'sub_district_id.required'=>'Please select Sub-District', 
                'village.required'=>'Please select Village' ,
                'address.max'=>'The Address may not be greater than 255 characters.',
                'latitude.between'=>'Latitude value appears to be incorrect format.',
                 'longitude'=>'longitude value appears to be incorrect format.',
                ]);
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'error','data'=>$validation->errors()]);
                }
                $generaldata=array();
                $generaldata['park_name']=$request->park_name;
                $generaldata['ceo_mail']=$request->ceo_mail;
                $generaldata['ceo_contact_number']=$request->ceo_contact_number;
                $generaldata['state']=$request->state;
                $generaldata['district']=$request->district_id;
                $generaldata['sub_district']=$request->sub_district_id;
                $generaldata['village']=$request->village;
                $generaldata['latitude']=$request->latitude;
                $generaldata['longitude']=$request->longitude;
                $generaldata['capacity']=$request->capacity;
                $generaldata['date']=$request->date;
                $generaldata['park_developer_name']=$request->park_developer_name;
                $generaldata['address']=$request->address;
                $generaldata['office_contact_number']=$request->office_contact_number;
                $generaldata['concerned_person_name']=$request->concerned_person_name;
                $generaldata['email']=$request->email;
                $generaldata['telephone_number']=$request->telephone_number;
                $generaldata['mobile_number']=$request->mobile_number;
                $generaldata['dpr_status']=$request->dpr_status;

                if($request->editId){
                    ProgressReport::where('id',$request->editId)->update([
                    'general'=>$generaldata,
                    'park_name'=>$request->park_name,
                    'capacity'=>$request->capacity,
                    'state'=>$request->state,
                    'district'=>$request->district_id]);
                    $auditData = array('action_type'=>'3','description'=>'User Update General Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
          
            if($request->type == 'final_submission'){
                //dd($request);
                $validation = Validator::make($request->all(), [
                    'undertaking'=>'required|mimes:pdf|max:1024',
                    'authorize' =>  'required'
                ],
                [
                    'undertaking.required'=>'This fields are required',
                    'undertaking.mimes'=>'Upload Only PDF Format',
                    'undertaking.max'=>'File should be less then 1MB',
                ]);
                if ($validation->fails())   //check all validations are fine, if not then redirect and show error messages
                {
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    if($request->editId){
                        $url = urlencode('/beneficiary/my-progress-report');
                        ProgressReport::where('id',$request->editId)->update(['undertaking'=>$undertaking, 'authorize'=>$request->authorize,'final_submission'=>1,'submitted_on'=>$this->getCurruntDate()]);     
                        $auditData = array('action_type'=>'3','description'=>'User Final Submitted Data','user_type'=>'0');
                        $this->auditTrail($auditData);   
                        //Notification 
                        $actionNotification = array('to_id'=>env('MNRE_ID'),'notification_description'=>'Beneficiary Final Submitted Data','to_user_type'=>'mnre');
                        $this->actionNotification($actionNotification); 
                        return response()->json(['status' => 'success','message'=>'Report submitted successfully!','url'=>$url]);  
                        //return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$request->editId);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                    return response()->json(['status' => 'error','message'=>$th->getMessage()]);  
                }
            }
        }
        $auditData = array('action_type'=>'1','description'=>'User view all Data','user_type'=>'0');
        $this->auditTrail($auditData);
        $generalData=array();

        $data= GecReport::where('id',$id)->where('user_id',Auth::id())->first();
        // dd($data);
        if($data!=null){
            // $previousData= GecReport::select('general')->where('user_id',Auth::id())->orderBy("id",'DESC')->skip(1)->take(1)->first();
            $generalData['id']=$data->id;
            $generalData['month']=$data->month;
            $generalData['year']=$data->year;
            $generalData['package_no']=$data->package_no;
            $generalData['package_name']=$data->package_name;
            $generalData['project_under_package'] =$data->project_under_package;
            $generalData['project_type'] =$data->project_type;
            $generalData['project_type_others']=$data->project_type_others;
            $generalData['mnre_sanction_date']=$data->mnre_sanction_date!='0000-00-00'?date('d/m/y',strtotime($data->mnre_sanction_date)):'';
            $generalData['tender_notice_date']=$data->tender_notice_date!='0000-00-00'?date('d/m/y',strtotime($data->tender_notice_date)):'';
            $generalData['last_submission_date']=$data->last_submission_date!='0000-00-00'?date('d/m/y',strtotime($data->last_submission_date)):'';
            $generalData['technical_bid_opening_date']=$data->technical_bid_opening_date!='0000-00-00'?date('d/m/y',strtotime($data->technical_bid_opening_date)):'';
            $generalData['financial_bid_opening_date']=$data->financial_bid_opening_date!='0000-00-00'?date('d/m/y',strtotime($data->financial_bid_opening_date)):'';
            $generalData['award_package_date']=$data->award_package_date!='0000-00-00'?date('d/m/y',strtotime($data->award_package_date)):'';
            $generalData['comm_date_award_letter'] =$data->comm_date_award_letter!='0000-00-00'?date('d/m/y',strtotime($data->comm_date_award_letter)):'';
            $generalData['dpr_cost'] =$data->dpr_cost;
            $generalData['awarded_cost'] =$data->awarded_cost;
            $generalData['physical_progess'] =$data->physical_progess;
            $generalData['package_expenditure'] =$data->package_expenditure;
            $generalData['financial_progress'] =$data->financial_progress;
            $generalData['land_detail'] =$data->land_detail;
            $generalData['forest_clearance_details'] =$data->forest_clearance_details;
            $generalData['remark'] =$data->remark;
            $generalData['additional_information'] = $data->additional_information;
            //dd($generalData);
           $solarPark_name=ManageSolarPark::where('user_id',Auth::id())->get();
            return view('backend.gecdeveloper.progress_report.progressReport' , compact('solarPark_name','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        }   
    }
    public function newProgressReport(Request $request){

        if($request->isMethod('post')){ 
                
            $month=$request->month;
            $year=$request->year;
            $package_no=$request->package_no;
            $package_name=$request->package_name;
            $existingGecData=GecReport::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->where('package_no',$package_no)->first();
            if($existingGecData!=null){
                return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$existingGecData->id);
                return response()->json(['error' => 'error','message'=>'Gec Report Existing for the Month!']);
                // return redirect()->back()->with("error",'Progress Report Existing for the Month');
            }
            $newGecData=new GecReport();
            $newGecData->month=$month;
            $newGecData->year=$year;
            $newGecData->package_name=$request->package_name;
            $newGecData->package_no=$package_no;
            $newGecData->user_id=Auth::id();
            // dd($newProgressData);
            $newGecData->save();
            $id=$newGecData->id;
        //     if('final_submission == 0'){
        //         return redirect(Auth::getDefaultDriver().'/application/progress_report/');
        //    } 
           return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        
        $solarPark_name=ManageSolarPark::where('user_id',Auth::id())->get();
        return view('backend.gecdeveloper.progress_report.newProgressReport',compact('solarPark_name'));
    }
    public function myProgressReport(Request $request){        
        if($request->isMethod('post')){
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
            ->orwhere('capacity',$capacity)->where('user_id',Auth::id())->orderBy("submitted_on",'DESC')->get()->toArray();
            foreach($progressData as $data){$i++;
                $decodeData=json_decode($data['general'],true);
                $progressDetails[$i] = $data;
                $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
            }
            $auditData = array('action_type'=>'1','description'=>'User Search Progress Report Data','user_type'=>'0');
            $this->auditTrail($auditData);
            $states = State::orderby('name')->get();
            return view('backend.beneficiary.progress_report.myProgressReport',compact('progressDetails','states'));
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
        return view('backend.gecdeveloper.progress_report.myProgressReport',compact('progressDetails','states'));
    }
    public function previewProgressReport($id){
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
        return view('backend.beneficiary.progress_report.previewProgressReport',compact('progressDetailspreview','previewData','id'));
    }
    public function pdfpreviewProgressReport($id){
        try {
            //code...
            $auditData = array('action_type'=>'6','description'=>'User Download For Final Submission ','user_type'=>'0');
            $this->auditTrail($auditData);
            $data=ProgressReport::select('*')->where('id',$id)->first();
            // dd($data);
            $aryData=array('data'=>$data,'id'=>$id);
            // dd($aryData);
            $pdf = PDF::loadView('backend/beneficiary/progress_report/pdfpreviewProgressReport', $aryData);
            return $pdf->download('Application_'.date("ymdhis").'.pdf');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
    public function editProfile(Request $request){
        try {
            $user = Auth::user();
            $states = State::orderby('name')->get();
            if($request->isMethod('get')){
                return view('backend.beneficiary.editProfile', compact('user','states'));
            }
            $user->name = $request->name;
            $user->name_of_solar_park = $request->name_of_solar_park;
            $user->contact_no = $request->contact_no;
            $user->state_id = $request->state;
            $user->district_id = $request->district_id;
            $user->sub_district_id = $request->sub_district_id;
            $user->village = $request->village;
            $isSaved = $user->save();
            $auditData = array('action_type'=>'7','description'=>' MNRE User Edit User Profile','user_type'=>'0');
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
                $submitUrl = URL::to('/beneficiary/change-password');
                
                $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'0');
                $this->auditTrail($auditData);
               
                return view('backend.beneficiary.changePassword',compact('submitUrl'));
            }
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                // dd($request->current_password);
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User  Match Password ','user_type'=>'0');
                 $this->auditTrail($auditData);
                 /*************************Audit Trail Start**********************************/
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }
            if(!$this->passwordPolicyTest($request->new_password)){
                $error = 'Failed strong password policy!';
                /*************************Audit Trail Start**********************************/
                $auditData = array('action_type'=>'1','description'=>' MNRE User Test password Policy  ','user_type'=>'0');
                $this->auditTrail($auditData);
                /*************************Audit Trail Start**********************************/
                return redirect()->back()->with("error", $error);
            }
            if(strcmp($request->current_password, $request->new_password) == 0){
                 /*************************Audit Trail Start**********************************/
                 $auditData = array('action_type'=>'1','description'=>' MNRE User verify condition currunt and new password not same  ','user_type'=>'0');
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
                $auditData = array('action_type'=>'2','description'=>' MNRE User Inserted new password  ','user_type'=>'0');
                $this->auditTrail($auditData);
             /*************************Audit Trail Start**********************************/
            return redirect()->back()->with("status","Password changed successfully !");
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with("error","Server Error !");
        // }
    }
    public function consolidateReport(Request $request){
        $progressDetails=array();
        if($request->isMethod('post')){
            $fromdata=$request->input('fromdata');
            $todata=$request->input('todata');
            $status=$request->input("status");
            //->where('status','!=',0)

            $progressData= ProgressReport::whereBetween('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59'])->where('status',$status)->where('user_id',Auth::id())->orderBy("submitted_on",'DESC')->limit(200)->get()->toArray();
            //  dd($progressData);
            if($status==1){
                $progressData= ProgressReport::whereBetween('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59'])->where('user_id',Auth::id())->orderBy("submitted_on",'DESC')->limit(200)->get()->toArray();
            }
            $i=0;
            foreach($progressData as $data){$i++;
                $decodeData=json_decode($data['general'],true);
                $progressDetails[$i] = $data;
                $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                $progressDetails[$i]['sub_district_name'] =SubDistrict::where('code',$decodeData['sub_district'])->first()['name'];
            }
            // dd($progressDetails);
            $auditData = array('action_type'=>'1','description'=>'User Search Consolidate Report Data','user_type'=>'0');
            $this->auditTrail($auditData);
            return view('backend.beneficiary.consolidate_report.consolidateReport',compact('progressDetails'));
            // return redirect()->back()->with("status","Profile edited successfully !");
            }
             return view('backend.beneficiary.consolidate_report.consolidateReport',compact('progressDetails'));
    }
    public function previewconsolidateReport($id){
        $consolidateDetailspreview=ProgressReport::where('id',$id)->first();
        $previewData=array();
        //foreach($consolidateDetailspreview as $pdata){
        $previewData=$consolidateDetailspreview;
        $previewData['general']=json_decode($consolidateDetailspreview['general'], true);
        $previewData['internal_infrastructure']=json_decode($consolidateDetailspreview['internal_infrastructure'], true);
        $previewData['road']=json_decode($consolidateDetailspreview['road'], true);
        $previewData['water_facilities']=json_decode($consolidateDetailspreview['water_facility'], true);
        $previewData['drainage_system']=json_decode($consolidateDetailspreview['drainage_facility'], true);
        $previewData['fencing_boundary']=json_decode($consolidateDetailspreview['fencing'], true);
        $previewData['telecommunication_facilities']=json_decode($consolidateDetailspreview['telecommunication_facility'], true);
        $previewData['internal_transmission_system']=json_decode($consolidateDetailspreview['internal_transmission_system'], true);
        $previewData['external_transmission_system']=json_decode($consolidateDetailspreview['external_transmission_system'], true);
        $previewData['solar_projects']=json_decode($consolidateDetailspreview['solar_projects'], true);
        $previewData['financial_closure']=json_decode($consolidateDetailspreview['financial_closure'], true);
        $previewData['award_of_work']=json_decode($consolidateDetailspreview['award_of_work'], true);
        $previewData['solar_park_completion']=json_decode($consolidateDetailspreview['solarpark_completion'], true);
        $previewData['external_power_evacuation_system']=json_decode($consolidateDetailspreview['external_power_system'], true);
        $previewData['solar_project_completion']=json_decode($consolidateDetailspreview['solar_project_completion'], true);
        $previewData['attachments']=json_decode($consolidateDetailspreview['attachments'], true);
        $previewData['additional_information'] = $consolidateDetailspreview->additional_information;
    
        
        $state=State::select('name')->where('code',$previewData['general']['state'])->first()['name'];
        $district=District::select('name')->where('code',$previewData['general']['district'])->first()['name'];
        $sub_district=SubDistrict::select('name')->where('code',$previewData['general']['sub_district'])->first()['name'];
        $village=Village::select('name')->where('code',$previewData['general']['village'])->first()['name'];
        $previewData['state']=$state;
        $previewData['district']=$district;
        $previewData['sub_district']=$sub_district;
        $previewData['village']=$village;
            //dd($previewData);
        //}
        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.beneficiary.consolidate_report.previewConsolidateReport',compact('consolidateDetailspreview','previewData','id'));
    }
    public function checkedPreviousReport($type,$month,$year,$id){
        if($month==1){
            $month=12;
            $year=($year-1);
        }else{
            $month=$month-1;
        }
        $previousprogressReport=ProgressReport::select($type)->where('month',$month)->where('year',$year)->where('user_id',Auth::id())->first();
        $auditData = array('action_type'=>'3','description'=>'User Copied Previous Data in Progress Report','user_type'=>'0');
        $this->auditTrail($auditData);
        $data=ProgressReport::where('id',$id)->update([$type=>$previousprogressReport->$type]);
        return response()->json(['status' => 'success','message'=>'Details save successfuly!']);
    }


    public function addSolarPark(Request $request ,$id=NULL){

        // dd($request);
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'park_name'=>'required',
                'developer_name'=>'required',
                'pan_no'=>'required',
                'contact_no'=>'required',
                'address'=>'required',
                'email'=>'required',
                'state_id'=>'required',
                'district_id'=>'required',
                'sub_district_id'=>'required',
                'village'=>'required',
            ]);
            if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }

            if($request->editId){
                $newSPData=ManageSolarPark::find($request->editId);
            }else{
                $newSPData=new ManageSolarPark();
            }


           
            $newSPData->solar_park_name= $request->input('park_name');
            $newSPData->developer_name= $request->input('developer_name');
            $newSPData->pan_no= $request->input('pan_no');
            $newSPData->mobile_number=$request->input('contact_no');
            $newSPData->address= $request->input('address');
            $newSPData->email=$request->input('email');
            $newSPData->state=$request->input('state_id');
            $newSPData->district=$request->input('district_id');
            $newSPData->sub_district=$request->input('sub_district_id');
            $newSPData->village=$request->input('village');
            $newSPData->user_id=Auth::id();
            $newSPData->save();
            $url=urlencode('/'.Auth::getDefaultDriver().'/solar-park-list');
            return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
            // return response()->json(['status' => 'success','message'=>'Details save successfuly!']); 
            // return redirect()->back()->with("status","New Data Added Successfully !");
        }
        $editedSPData=array();
        if($id){
            $editedSPData=ManageSolarPark::select('*')->where('id',$id)->first();
        }
        $states = State::orderby('name')->get();
        return view('backend.beneficiary.add_solar_park',compact('states','editedSPData','id'));
    }
    public function solarParkList(Request $request){
        // dd($request);


        $mnreuserDetail=ManageSolarPark::getSolarParkDevDetails(Auth::user()->id);
        return view('backend.beneficiary.solarParkList',compact('mnreuserDetail'));
    }

// public function addSolarPark(Request $request ,$id=NULL){
//         // dd($request);
//         if($request->isMethod('post')){
//             $validation = Validator::make($request->all(), [
//                 'park_name'=>'required',
//                 'developer_name'=>'required',
//                 'pan_no'=>'required',
//                 'contact_no'=>'required',
//                 'address'=>'required',
//                 'email'=>'required',
//                 'state_id'=>'required',
//                 'district_id'=>'required',
//                 'sub_district_id'=>'required',
//                 'village'=>'required',
//             ]);
//             if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
//                 return response()->json(['status'=>'verror','data'=>$validation->errors()]);
//             }

//             if($request->editId){
//                 $newSPData=ManageSolarPark::find($request->editId);
//             }else{
//                 $newSPData=new ManageSolarPark();
//             }


           
//             $newSPData->solar_park_name= $request->input('park_name');
//             $newSPData->developer_name= $request->input('developer_name');
//             $newSPData->pan_no= $request->input('pan_no');
//             $newSPData->mobile_number=$request->input('contact_no');
//             $newSPData->address= $request->input('address');
//             $newSPData->email=$request->input('email');
//             $newSPData->state=$request->input('state_id');
//             $newSPData->district=$request->input('district_id');
//             $newSPData->sub_district=$request->input('sub_district_id');
//             $newSPData->village=$request->input('village');
//             $newSPData->user_id=Auth::id();
//             $newSPData->save();
//             $url=urlencode('/'.Auth::getDefaultDriver().'/solar-park-list');
//             return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
//             // return response()->json(['status' => 'success','message'=>'Details save successfuly!']); 
//             // return redirect()->back()->with("status","New Data Added Successfully !");
//         }
//         $editedSPData=array();
//         if($id){
//             $editedSPData=ManageSolarPark::select('*')->where('id',$id)->first();
//         }
//         $states = State::orderby('name')->get();
//         return view('backend.beneficiary.add_solar_park',compact('states','editedSPData','id'));
//     }

   
}


            