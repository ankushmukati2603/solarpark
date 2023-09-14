<?php

namespace App\Http\Controllers\Backend\REIA;

use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Traits\General;
use App\Models\SubDistrict;
use App\Models\District;
use App\Utils\Dashboard;
use App\Models\AuditTrail;
use App\Models\Reia;
use App\Models\ReiaReport;
use App\Models\Scheme;
use App\Models\Bidder;
use Illuminate\Http\Request;
use Auth,Storage, Validator,DB,PDF,URL,Hash;
use App\Models\Feedback;


class MainController extends Controller {

    use General;

    public function __construct() {
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    public function index() {

        $dashboard = new Dashboard();
        // $data=$dashboard->getBeneficiaryDashboardData();
        $data = "";
        $auditData = array('action_type' => '1', 'description' => 'User Visit Dashboard Page', 'user_type' => '7');
        $this->auditTrail($auditData);
        return view('backend.reia.dashboard', compact('data'));
    }
       
    public function changePassword(Request $request){
        // try {
            if($request->isMethod('get')){

                $submitUrl = URL::to('/reia/change-password');
                
                $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'0');
                $this->auditTrail($auditData);
               
                return view('backend.reia.changePassword',compact('submitUrl'));
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

    public function ProgressReport(Request $request) { 
    //dd($request);
        $from_date = NULL; $to_date = NULL;$state_id = NULL;$district_id = NULL;$tender_date = NULL;$scheme_name = NULL;$filters=[];
        if ($request->isMethod('post')) {
            if(!empty($request->filter['from_date'])) $from_date = $request->filter['from_date'];
            if(!empty($request->filter['to_date'])) $to_date = $request->filter['to_date'];
            if(!empty($request->filter['state_id'])) $state_id = $request->filter['state_id'];
            if(!empty($request->filter['district_id'])) $district_id = $request->filter['district_id'];
            if(!empty($request->filter['tender_date'])) $tender_date = $request->filter['tender_date'];
            if(!empty($request->filter['scheme_name'])) $scheme_name = $request->filter['scheme_name'];
            //$filters = $request->filter;

            $query = ReiaReport::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name')
            ->where('user_id',Auth::id());

            if ($request->filter['from_date']) {
                $query->where('reia_report.created_date', '>', $from_date);
            }
            if ($request->filter['to_date']){
                $query->where('reia_report.created_date', '<', $to_date);
            }
            if ($request->filter['state_id']) {
                $query->where('reia_report.state_id',  $state_id);
                // $query->leftjoin('states','states.code',$state_id)
            }
            if ($request->filter['district_id']) {
                $query->where('reia_report.district_id',  $district_id);
            }
            if ($request->filter['tender_date']) {
                $query->where('reia_report.tender_date', $tender_date);
            }
            if ($request->filter['scheme_name']){
                $query->where('reia_report.scheme_id',$scheme_name);
            }
            $query->leftjoin('states','states.code','reia_report.state_id')
            ->leftjoin('districts','districts.code','reia_report.district_id')
             ->leftjoin('schemes','schemes.id','reia_report.scheme_id');
            $progressDetails=$query->get();
            $states = State::orderby('name')->get();
            $schemes = DB::table('schemes')->where('status', 1)->get();
            return view('backend.reia.progress_report.myProgressReport', compact('progressDetails', 'states','schemes'));
            // dd($progressData);
        }
        $progressDetails = ReiaReport::getReiaReport(Auth::id());
        $auditData = array('action_type' => '1', 'description' =>'REIA User Visit Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);
        $states = State::orderby('name')->get();
        $schemes = DB::table('schemes')->where('status', 1)->get();
        return view('backend.reia.progress_report.myProgressReport', compact('progressDetails', 'states','filters','schemes'));
    }

    public function newProgressReport(Request $request, $id = NULL) {
        $id=base64_decode($id);
        if ($request->isMethod('post')) {

            $validation = Validator::make($request->all(), [
                        'scheme_id' => 'required',
                        'state_id' => 'required',
                        'district_id' => 'required',
                        'project_type' => 'required',
                        'tender_capacity' => 'required',
                        'tender_date' => 'required',
                        'loa_date' => 'required',
                        'bidder_id' => 'required',
                        'bidder_capacity.*' => 'required',
                        'ppa_date.*' => 'required',
                        'ppa_capacity.*' => 'required',
                         'scod' => 'required',
                        ],
                        [
                        'detail.required'=>'This fields is required',
                        'scheme_id.required'=> 'This fields is required',
                        'state_id.required'=> 'This fields is required',
                        'district_id.required'=> 'This fields is required',
                        'project_type.required'=> 'This fields is required',
                        'tender_capacity.required'=> 'This fields is required',
                        'tender_date.required'=>'This fields is required',
                        'loa_date.required'=> 'This fields is required',
                        'bidder_id.required'=> 'This fields is required',
                        'bidder_capacity.required'=> 'This fields is required',
                        'ppa_date.required'=> 'This fields is required',
                        'ppa_capacity.required'=> 'This fields is required',
                        'scod.required'=> 'This fields is required',
                        ]);
                        if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                            return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
                        }
//            $existingGecData=Reia::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->where('package_no',$package_no)->first();
//            if($existingGecData!=null && $existingGecData->final_submission==1){
//                return response()->json(['status' => 'error','message'=>'Gec Report Existing for this Month!','url'=>'']);
//            }

            $final_submission = 1;
            if($request->final==0){
                $final_submission = 0;
            }
            // dd( $final_submission);
            // $final_submission = 1;
            // if ($request->has('name') && $request->input('save') === 'Save as draft') {
            //     $final_submission = 0;
            // }

            $reia=array();
            $reia = ReiaReport::find($request->editId);
            $reia->scheme_id = $request->scheme_id;
            $reia->state_id = $request->state_id;
            $reia->district_id = $request->district_id;
            $reia->project_type = $request->project_type;
            $reia->tender_capacity = $request->tender_capacity;
            $reia->tender_date = $request->tender_date;
            $reia->loa_date = $request->loa_date;
            $reia->scod = $request->scod;
            $reia->bidder_id=json_encode($request->input('bidder_id'));
            $reia->select_bidders_capacity=json_encode($request->input('select_bidders_capacity'));
            $reia->ppa_date=json_encode($request->input('ppa_date'));
            $reia->ppa_capacity=json_encode($request->input('ppa_capacity'));
            $reia->remark = $request->remark;
            $reia->final_submission = $final_submission;
            $reia->reia_id = Auth::id();
            //dd($reia);
            $reia->save();

            // $application_id = '/'.($reia->id).'/'.date('Y');
            // ReiaReport::where('id',$reia->id)->update(['id'=>$application_id]);
             
            if($request->editId){
                ReiaReport::where('id',$request->editId)->update([
                    'bidder_id'=>$request->bidder_id,
                    'select_bidders_capacity'=>$request->select_bidders_capacity,
                    'ppa_date'=>$request->ppa_date,
                    'ppa_capacity'=>$request->ppa_capacity,
                ]);
            $auditData = array('action_type' => '2', 'description' => 'GEC User Insert New Progress Report Data', 'user_type' => '7');
            $this->auditTrail($auditData);

            $url = urlencode('/'.Auth::getDefaultDriver().'/progress-report/');
            return response()->json(['status' => 'success', 'message' => "Please wait...", 'url' => $url, 'redirect' => 'yes']);
        }
    } 
        $reia=array();
        // dd( $reia); 
        $schemes = DB::table('schemes')->where('status', 1)->get();
        $states = State::orderby('name')->get();
        $bidders = DB::table('tbl_master_bidder')->where('status', 1)->get();
        $reia=array();
        if($id){
            $reia=ReiaReport::select('*')->where('id', $id)->first();
            // dd( $reia);
            if($reia){
               
                $reia=$reia;
                $reia['bidder_id'] = json_decode($reia->bidder_id, true);
                $reia['select_bidders_capacity']=json_decode($reia->select_bidders_capacity,true);
                $reia['ppa_date']=json_decode($reia->ppa_date,true);
                $reia['ppa_capacity']=json_decode($reia->ppa_capacity,true);
                // dd( $reia); 
            }
        }
        $auditData = array('action_type' => '1', 'description' => 'REIA visit New Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);
        return view('backend.reia.progress_report.progressReport', compact('schemes', 'states','bidders', 'reia', 'id',));
    }

    public function addProgressReport(Request $request,$id=null){
        if($request->isMethod('post')){

            $validation = Validator::make($request->all(), [
                'month'=>'required',
                'year'=>'required',
                // 'project_name'=>'required',
            ]);
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $month=$request->month;
            $year=$request->year;
            // $existingProgressData=ReiaReport::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->first();
            // dd($existingProgressData);
            // if($existingProgressData!=null){
            //     if($existingProgressData->final_submission==0){
            //         $auditData = array('action_type'=>'1','description'=>'visit Progress Report Page','user_type'=>'0');
            //         $this->auditTrail($auditData);
            //         $url=urlencode('/'.Auth::getDefaultDriver().'/new-reia-progress-report/' .$existingProgressData->id);
            //         return response()->json(['status' => 'success','message'=>"Please wait...",'url'=>$url,'redirect'=>'yes']);
            //     }else{
            //         return response()->json(['status' => 'error','message'=>'Progress Report Existing for the Month!','url'=>'']);
            //     }
            //     return redirect(Auth::getDefaultDriver().'/progress-report/' .$existingProgressData->id);
            //     return response()->json(['error' => 'error','message'=>'Progress Report Existing for the Month!']);
            //     return redirect()->back()->with("error",'Progress Report Existing for the Month');
            // }

            $newProgressData=new ReiaReport();
            $newProgressData->month=$request->month;
            $newProgressData->year=$request->year;
            // $newProgressData->id=$request->project_name;
            $newProgressData->user_id=Auth::id();
            $newProgressData->save();
            $id=$newProgressData->id;
            // dd($id);
            $url=urlencode('/'.Auth::getDefaultDriver().'/new-reia-progress-report/'.base64_encode($id));
            return response()->json(['status' => 'success','message'=>"Please wait...",'url'=>$url,'redirect'=>'yes']); 
        //    return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        //$stuproject_name=ManageStuProject::where('user_id',Auth::id())->get();
        $auditData = array('action_type'=>'1','description'=>'visit New Progress Report Page','user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.reia.progress_report.newProgressReport');
    } 


    public function editReiaProgressReport(Request $request,$id){
     
        $schemes = DB::table('schemes')->get();
        $states = State::orderby('name')->get();
        $bidders = DB::table('tbl_master_bidder')->get();
        $id =  base64_decode($id);
        $reia=ReiaReport::where('id',$id)->first();
        $auditData = array('action_type' => '1', 'description' => 'REIA visit edit Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);

        return view('backend.reia.progress_report.progressReport', compact('schemes', 'states','bidders','reia'));
    }

    function schemes(Request $request)
    {
           $schemes = DB::table('schemes')->get();
         return view('backend.reia.scheme-list', compact('schemes'));
    }
     public function addScheme(Request $request, $id = NULL) {
        
           
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                        'scheme_name' => 'required',
            ]);
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            }
            $editId=$request->editId;
            $existingSchemeData=Scheme::where('scheme_name', $request->scheme_name)->where('id','!=',$editId)->first();
            if($existingSchemeData!=null){
                return response()->json(['status' => 'error','message'=>'Scheme Name Exist in table!','url'=>'']);
            }
              if($editId!='')
                 {
               $reia =Scheme::find($editId);
              }else{
            $reia = new Scheme();
              }
            $reia->scheme_name = $request->scheme_name;
            $reia->save();
            $auditData = array('action_type' => '2', 'description' => 'Inserted Scheme by REIA', 'user_type' => '7');
            $this->auditTrail($auditData);
            $url = urlencode('/' . Auth::getDefaultDriver() . '/schemes/');
            return response()->json(['status' => 'success', 'message' => "Please wait...", 'url' => $url, 'redirect' => 'yes']);
        }
        $auditData = array('action_type' => '1', 'description' => 'Scheme list show', 'user_type' => '7');
        $this->auditTrail($auditData);
        $SchemeData=array();
        if($id!=NULL)
        {
             $SchemeData=Scheme::where('id', $id)->first();
        }
        return view('backend.reia.addScheme',compact('SchemeData'));
    }
    public function Changeschemesstatus(Request $request)
        {

            $user = Scheme::find($request->id);
            $user->status = $request->status;

            $user->save();
            return response()->json(['success'=>'Status change successfully.']);
        }
    
    public function feedback(Request $request) {
        
        $url='/'.Auth::getDefaultDriver().'/feedback';
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                        'message' => 'required',
            ],
            [
                'message.required'=>'Feedback field is required'
            ]
            );
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            } 
            try {
                //code...
                $data = New Feedback();
                $data->user_id = Auth::user()->id;
                $data->name = Auth::user()->name;
                $data->contact_no = Auth::user()->phone;
                $data->email = Auth::user()->email;
                $data->scheme_type=1; //1- Solar Park,
                $data->subject="Feedback From REIA";
                $data->feedback_type=1; //1-Feedback,
                $data->message = $request->input('message');
                $data->user_type = 'reia';
                $data->save();
                
                $auditData = array('action_type' => '2', 'description' => 'Feedback sent successfuly', 'user_type' => '2');
                $this->auditTrail($auditData);
                return response()->json(['status' => 'success', 'message' => 'Feedback sent successfuly!', 'url' => $url,'redirect' => 'yes']);
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            
        }
        $getFeedback=Feedback::select('message')->where('user_id',Auth::user()->id)->where('user_type','developer')->first();
        return view('backend.reia.feedback', compact('url','getFeedback'));
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
        return view('backend.reia.editProfile', compact('user', 'states','url'));
    }

        function vieweditProfile(Request $request)
        {
            $Bidder = DB::table('tbl_master_bidder')->get();
            return view('backend.reia.viewProfile', compact(''));
        }



    function bidder(Request $request)
    {
        $Bidder = DB::table('tbl_master_bidder')->get();
        return view('backend.reia.bidder-list', compact('Bidder'));
    }

    public function addBidder(Request $request, $id = NULL) {
        
        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                        'bidder_name' => 'required',
            ]);
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            }
            $editId=$request->editId;
            $existingBidderData=Bidder::where('bidder_name', $request->bidder_name)->where('id','!=',$editId)->first();
            if($existingBidderData!=null){
                return response()->json(['status' => 'error','message'=>'Bidder Name Exist in table!','url'=>'']);
            }
              if($editId!='')
                 {
              $reias =Bidder::find($editId);
              }else{
              $reias = new Bidder();
              }
            $reias->bidder_name = $request->bidder_name;
            $reias->save();
            $auditData = array('action_type' => '2', 'description' => 'Inserted Bidder by REIA', 'user_type' => '7');
            $this->auditTrail($auditData);
            $url = urlencode('/' . Auth::getDefaultDriver() . '/bidder/');
            return response()->json(['status' => 'success', 'message' => "Please wait...", 'url' => $url, 'redirect' => 'yes']);
        }
        $auditData = array('action_type' => '1', 'description' => 'Bidder list show', 'user_type' => '7');
        $this->auditTrail($auditData);
         $BidderData=array();
        if($id!=NULL)
        {
             $BidderData=Bidder::where('id', $id)->first();
        }
        return view('backend.reia.addBidder',compact('BidderData'));
    }
  
    public function Changebidderstatus(Request $request)
        {
            $user = Bidder::find($request->id);
            $user->status = $request->status;

            $user->save();
            return response()->json(['success'=>'Status change successfully.']);
        }

    public function progressreportpreview(Request $request,$id)
    {
        $id =  base64_decode($id);
        $Reiadata=ReiaReport::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name')
        ->join('states','states.code','reia_report.state_id')
        ->join('districts','districts.code','reia_report.district_id')
         ->join('schemes','schemes.id','reia_report.scheme_id')
        //  ->join('tbl_master_bidder','tbl_master_bidder.id','reia_report.bidder_id')
        ->where('reia_report.id',$id)
        ->first();
        $data = array(); 
        if ($Reiadata) {
            $data=$Reiadata;
            $data['bidder_id'] = json_decode($Reiadata->bidder_id, true);
            $data['select_bidders_capacity'] = json_decode($Reiadata->select_bidders_capacity, true);
            $data['ppa_date'] = json_decode($Reiadata->ppa_date, true);
            $data['ppa_capacity'] = json_decode($Reiadata->ppa_capacity, true);
        }
        // dd($data);
        return view('backend.reia.progress_report.PreviewProgressReport',compact('data'));
    }
}