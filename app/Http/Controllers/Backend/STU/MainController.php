<?php

namespace App\Http\Controllers\Backend\STU;
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
use App\Models\Gecd;
use App\Models\StuReport;
use App\Models\ManageStuProject;

use App\Models\mediumBiogasPlantBelow10KW;
use App\Models\mediumBiogasPlantAbove10KW;
use Illuminate\Http\Request;
use Auth , Storage ,Validator,DB,PDF,URL,Hash;


class MainController extends Controller
{
     use General;
       public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function index(){
        $dashboard=new Dashboard();
        // $data=$dashboard->getBeneficiaryDashboardData();
        $data="";
        $auditData = array('action_type'=>'1','description'=>'User Visit Dashboard Page','user_type'=>'7');
        $this->auditTrail($auditData);
        return view('backend.stu.dashboard',compact('data'));
    }
    public function ProgressReport(Request $request){ 

        $from_date = NULL; $to_date = NULL;$state_id = NULL;$district_id = NULL;$developer_name = NULL;$filters=[];
        if ($request->isMethod('post')) {
            if(!empty($request->filter['from_date'])) $from_date = $request->filter['from_date'];
            if(!empty($request->filter['to_date'])) $to_date = $request->filter['to_date'];
            if(!empty($request->filter['state_id'])) $state_id = $request->filter['state_id'];
            if(!empty($request->filter['district_id'])) $district_id = $request->filter['district_id'];
            if(!empty($request->filter['developer_name'])) $developer_name = $request->filter['developer_name'];
            // if(!empty($request->filter['scheme_name'])) $scheme_name = $request->filter['scheme_name'];
            //$filters = $request->filter;

            $query = StuReport::select('stu_report.*','states.name as state_name','districts.name as district_name')
            ->where('user_id',Auth::id());

            if ($request->filter['from_date']) {
                $query->where('stu_report.created_date', '>', $from_date);
            }
            if ($request->filter['to_date']){
                $query->where('stu_report.created_date', '<', $to_date);
            }
            if ($request->filter['state_id']) {
                $query->where('stu_report.state_id',  $state_id);
                // $query->leftjoin('states','states.code',$state_id)
            }
            if ($request->filter['district_id']) {
                $query->where('stu_report.district_id',  $district_id);
            }
            if ($request->filter['developer_name']) {
                $query->where('stu_report.developer_name', $developer_name);
            }
            // if ($request->filter['scheme_name']){
            //     $query->where('gec_report.scheme_id',$scheme_name);
            // }
            $query->leftjoin('states','states.code','stu_report.state_id')
            ->leftjoin('districts','districts.code','stu_report.district_id');
            //  ->leftjoin('schemes','schemes.id','gec_report.scheme_id');
            $progressDetails=$query->get();
            $states = State::orderby('name')->get();
            // $schemes = DB::table('schemes')->where('status', 1)->get();
            return view('backend.stu.progress_report.myProgressReport', compact('progressDetails', 'states'));
          
        }
        $auditData = array('action_type'=>'1','description'=>'GEC User Visit Progress Report Page','user_type'=>'7');
        $this->auditTrail($auditData);
        $states = State::orderby('name')->get();

        // $progressDetails=array();
        $progressDetails=StuReport::getMnreUsers(Auth::id());

           
        return view('backend.stu.progress_report.myProgressReport',compact('progressDetails','states'));
    }

    public function addProgressReport(Request $request){
        if($request->isMethod('post')){

            $validation = Validator::make($request->all(), [
                'month'=>'required',
                'year'=>'required',
            ]);
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $month=$request->month;
            $year=$request->year;

            $newProgressData=new StuReport();
            $newProgressData->month=$request->month;
            $newProgressData->year=$request->year;
            $newProgressData->user_id=Auth::id();
            $newProgressData->save();
            $id=$newProgressData->id;
            
            $url=urlencode('/'.Auth::getDefaultDriver().'/new-stu-progress_report/'.$id);
            return response()->json(['status' => 'success','message'=>"Please wait...",'url'=>$url,'redirect'=>'yes']); 
        //    return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        // $stuproject_name=ManageStuProject::where('user_id', Auth::id())->get();
        $auditData = array('action_type'=>'1','description'=>'visit New Progress Report Page','user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.stu.progress_report.StuProjectReportMonthYear');
    } 

    public function newStuProgressReport(Request $request,$id=NULL){
        //dd("yes");   
       
        if($request->isMethod('post')){
            // dd($request); 
            $this->validate($request,[
                'tender_bidding_agency' => 'required',
                'developer_name' =>'required|regex:/^[a-zA-Z ]+$/u',
                'capacity_connectivity' => 'required|gt:0',
                'sub_station' =>'required',
                'state_id' => 'required',
                'district_id' => 'required',
                'sub_district_id' => 'required',
                'connectivity_basis' => 'required',
                'lta_operationalization_date' => 'required',
                'capacity_commissioned' =>'required|gt:0',
                'cumulative_capacity' => 'required|gt:0',
                'cumulative_capacity_date' => 'required',
                'remark' => 'required',
             ]);
            // if ($validation->fails()){  
            //     return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            // }
            $final_submission = 1;
            if($request->save == "Save as draft"){
                $final_submission=0;
            }

            $newGecData=array();
            $newGecData = StuReport::find($request->editId);
            // $newGecData=new GecReport();
             //dd($newGecData);
            $newGecData->state_id = $request->state_id;
            $newGecData->district_id = $request->district_id;
            $newGecData->sub_district_id = $request->sub_district_id;
            $newGecData->sub_station = $request->sub_station;
            $newGecData->tender_bidding_agency = $request->tender_bidding_agency;
            $newGecData->developer_name = $request->developer_name;
            $newGecData->capacity_connectivity = $request->capacity_connectivity;
            $newGecData->connectivity_basis = $request->connectivity_basis;
            $newGecData->lta_operationalization_date = $request->lta_operationalization_date;
            $newGecData->capacity_commissioned = $request->capacity_commissioned;
            $newGecData->cumulative_capacity = $request->cumulative_capacity;
            $newGecData->cumulative_capacity_date = $request->cumulative_capacity_date;
            $newGecData->remark = $request->remark;
            $newGecData->user_id=Auth::id();
            $newGecData->final_submission = $final_submission;
            $newGecData->save();
            
            // dd( $newGecData);
            $id=$newGecData->id;
            if($request->editId){
                StuReport::where('id',$request->editId)->update([
                    'state_id' => $request->state_id,
                    'district_id' => $request->district_id,
                ]);
            $auditData = array('action_type'=>'2','description'=>'GEC User Insert New Progress Report Data','user_type'=>'7');
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/progress-report/');
            // return response()->json(['status' => 'success','message'=>"Please wait...",'url'=>$url,'redirect'=>'yes']); 
            return redirect(Auth::getDefaultDriver().'/progress-report/');
            }
        }
        $states = State::orderby('name')->get();

        $editProgressData=array();
        if($id){
            $editProgressData=StuReport::select('*')->where('id',$id)->first();
        }
        
        $auditData = array('action_type'=>'1','description'=>'GEC visit New Progress Report Page','user_type'=>'7');
        $this->auditTrail($auditData);
        return view('backend.stu.progress_report.progressReport',compact('states','id', 'editProgressData'));
    }

    public function editStuProgressReport(Request $request,$id){
     
       
        $states = State::orderby('name')->get();
       
        $editProgressData=StuReport::where('id',$id)->first();
        $auditData = array('action_type' => '1', 'description' => 'REIA visit edit Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);

        return view('backend.reia.progress_report.progressReport', compact( 'states','editProgressData', 'id'));
    }


    public function addstuproject(Request $request ,$id=NULL){
        if($request->isMethod('post')){
    
            $validation = Validator::make($request->all(), [
                'project_name'=>'required',
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
                $newStuData=ManageStuProject::find($request->editId);
                $auditData = array('action_type'=>'3','description'=>'User Update Stu data','user_type'=>'0');
                $this->auditTrail($auditData);
            }else{
                $newStuData=new ManageStuProject();
                $auditData = array('action_type'=>'2','description'=>'User Insert Stu data','user_type'=>'0');
                $this->auditTrail($auditData);
            }

            $newStuData=new ManageStuProject();
            $newStuData->project_name= $request->input('project_name');
            $newStuData->developer_name= $request->input('developer_name');
            $newStuData->pan_no= $request->input('pan_no');
            $newStuData->mobile_number=$request->input('contact_no');
            $newStuData->address= $request->input('address');
            $newStuData->email=$request->input('email');
            $newStuData->state=$request->input('state_id');
            $newStuData->district=$request->input('district_id');
            $newStuData->sub_district=$request->input('sub_district_id');
            $newStuData->village=$request->input('village');
            $newStuData->user_id=Auth::id();
            $newStuData->save();
            $url=urlencode('/stu-users/stu-project-list/');
            return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
            // return response()->json(['status' => 'success','message'=>'Details save successfuly!']); 
            // return redirect()->back()->with("status","New Data Added Successfully !");
        }
        $editedStuData=array();
        if($id){
            $editedStuData=ManageStuProject::select('*')->where('id',$id)->first();
        }
        $states = State::orderby('name')->get();
        return view('backend.stu.add_stu_project',compact('states','editedStuData','id'));
    }
      
    public function stuProjectList(Request $request){
        //   dd($request);
        $stuProjectDetails=ManageStuProject::getStuProjectDetails(Auth::user()->id);
        // $mnreuserDetail=ManageSolarPark::where('user_id',Auth::user()->user_id)->get();

        return view('backend.stu.stuProjectList',compact('stuProjectDetails'));
    }

    public function progressreportpreview(Request $request,$id)
    {
        $studata=StuReport::select('stu_report.*','states.name as state_name','districts.name as district_name')
        ->join('states','states.code','stu_report.state_id')
        ->join('districts','districts.code','stu_report.district_id')
        ->orderBy('stu_report.entry_date', 'desc')
        ->where('stu_report.id', $id)
        ->first();
        $data = array(); 
        if ($studata) {
            $data=$studata;
        }
        //dd($GecReportdata);
        // dd($data);
        return view('backend.stu.progress_report.PreviewProgressReport',compact('data'));
    }

    public function editProfile(Request $request) {
        $url='/'.Auth::getDefaultDriver().'/edit-profile';
        $user = Auth::user()->where('id', Auth::user()->id)->first();
        $states = State::orderby("name")->get();
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                        'name' => 'required',
                        'contact_person' => 'required',
                        'state' => 'required',
                        'phone' => 'required',
                        'address' => 'required',
                            ]
            );
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            }
            $auditMsg = "SNA update profile successfuly";
          
            $data = Auth::user();
            $data->name = $request->input('name');
            $data->contact_person = $request->input('contact_person');
            $data->state_id = $request->input('state');
            $data->phone = $request->input('phone');
            $data->address = $request->input('address');
            $data->save();
            $auditData = array('action_type' => '3', 'description' => $auditMsg, 'user_type' => '2');
            $this->auditTrail($auditData);
            return response()->json(['status' => 'success', 'message' => 'REIA update profile Successfully!', 'url' => $url,'user', 'states','redirect' => 'yes']);
        }
        $auditData = array('action_type' => '1', 'description' => 'REIA View Profile', 'user_type' => '2');
        $this->auditTrail($auditData);
        $agencydetails = array();
        //        if($id){
        //            $agencydetails=Agency::select('*')->where('id',$id)->where('sna_id',Auth::user()->id)->first();
        //        }
        $states = State::orderby("name")->get();
        return view('backend.stu.editProfile', compact('user', 'states','url'));
    }

    public function vieweditProfile(Request $request)
        {
            $Bidder = DB::table('tbl_master_bidder')->get();
            return view('backend.stu.viewProfile', compact(''));
        }
    
        public function changePassword(Request $request){
            // try {
                if($request->isMethod('get')){
    
                    $submitUrl = URL::to('/stu-users/change-password');
                    
                    $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'0');
                    $this->auditTrail($auditData);
                   
                    return view('backend.stu.changePassword',compact('submitUrl'));
                } 
                if($request->isMethod('post')){
                $validation = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'new_password' => 'required',
                    'new_password_confirmation' => 'required',
                    ],
                    [
                    'current_password.required'=>'This fields is required',
                    'new_password.required'=> 'This fields is required',
                    'new_password_confirmation.required'=> 'This fields is required',
                    ]);
                    if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                        return redirect()->back()->with("error","Please Enter Valid details.");
                    }
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

        public function feedback(Request $request) {
        
            $url='/'.Auth::getDefaultDriver().'/feedback';
            if ($request->isMethod('post')) {
                $validation = Validator::make($request->all(), [
                            'message' => 'required',
                    ]
                );
                if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
                } 
                $auditMsg = "Feedback sent successfuly";
                $data = New Feedback();
                $data->message = $request->input('message');
                $data->user_id = Auth::user()->id;
                $data->user_type = 'stu-users';
                $data->save();
                $auditData = array('action_type' => '2', 'description' => $auditMsg, 'user_type' => '2');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'success', 'message' => 'Feedback sent successfuly!', 'url' => $url,'user','redirect' => 'yes']);
            }
            return view('backend.stu.feedback', compact('url'));
        }

	 
}