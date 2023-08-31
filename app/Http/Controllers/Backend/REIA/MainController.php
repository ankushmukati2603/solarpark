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

    public function ProgressReport(Request $request) { 
     $from_date = NULL; $to_date = NULL;$state_id = NULL;$district_id = NULL;$tender_date = NULL;$filters=[];
        if ($request->isMethod('post')) {
            if(!empty($request->filter['from_date'])) $from_date = $request->filter['from_date'];
            if(!empty($request->filter['to_date'])) $to_date = $request->filter['to_date'];
            if(!empty($request->filter['state_id'])) $state_id = $request->filter['state_id'];
            if(!empty($request->filter['district_id'])) $district_id = $request->filter['district_id'];
            if(!empty($request->filter['tender_date'])) $tender_date = $request->filter['tender_date'];
            $filters = $request->filter;
          
//            $progressDetails = array();
//            $auditData = array('action_type' => '1', 'description' => 'GEC User Search Progress Report Data', 'user_type' => '7');
//            $this->auditTrail($auditData);
            $states = State::orderby('name')->get();
          
        }
        
//        $state = NULL; $filters=[];
//        if($request->isMethod('post') && $request->filter['state'] != 'All'){
//            if(!empty($request->filter['state'])) $state = $request->filter['state'];
//            $filters = $request->filter;
//        }
//       
//        $states = State::All();
//        $targets=ManageTarget::getManageTargetData($filters);
         $progressDetails = ReiaReport::getReiaReport();
        $auditData = array('action_type' => '1', 'description' =>'REIA User Visit Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);
        $states = State::orderby('name')->get();
       
        return view('backend.reia.progress_report.myProgressReport', compact('progressDetails', 'states','filters'));
    }

    public function newProgressReport(Request $request, $id = NULL) {
        
        if ($request->isMethod('post')) {
            // dd($request);
            $validation = Validator::make($request->all(), [
                        'scheme_id' => 'required',
                        'state_id' => 'required',
                        'district_id' => 'required',
                        'project_type' => 'required',
                        'tender_capacity' => 'required',
                        'tender_date' => 'required',
                        'loa_date' => 'required',
                        'bidder_id' => 'required',
                        'bidder_capacity' => 'required',
                        'ppa_date' => 'required',
                        'ppa_capacity' => 'required',
                        'scod' => 'required',
            ]);
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            }
//            $existingGecData=Reia::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->where('package_no',$package_no)->first();
//            if($existingGecData!=null && $existingGecData->final_submission==1){
//                return response()->json(['status' => 'error','message'=>'Gec Report Existing for this Month!','url'=>'']);
//            }
            $final_submission = 1;
            if(isset($request->save) && $request->save=='Save as draft'){
                $final_submission = 0;
            }

            $reia = new ReiaReport();
            $reia->scheme_id = $request->scheme_id;
            $reia->state_id = $request->state_id;
            $reia->district_id = $request->district_id;
            $reia->project_type = $request->project_type;
            $reia->tender_capacity = $request->tender_capacity;
            $reia->tender_date = $request->tender_date;
            $reia->loa_date = $request->loa_date;
            $reia->bidder_id = $request->bidder_id;
            $reia->bidder_capacity = $request->bidder_capacity;
            $reia->ppa_date = $request->ppa_date;
            $reia->ppa_capacity = $request->ppa_capacity;
            $reia->scod = $request->scod;
            $reia->status = $request->status;
            $reia->final_submission = $request->final_submission;
            $reia->reia_id = Auth::id();
            $reia->save();
         
            $auditData = array('action_type' => '2', 'description' => 'GEC User Insert New Progress Report Data', 'user_type' => '7');
            $this->auditTrail($auditData);
            $url = urlencode('/' . Auth::getDefaultDriver() . '/progress-report/');
            return response()->json(['status' => 'success', 'message' => "Please wait...", 'url' => $url, 'redirect' => 'yes']);
        }
        $schemes = DB::table('schemes')->get();
        $states = State::orderby('name')->get();
        $bidders = DB::table('tbl_master_bidder')->get();
       
        $auditData = array('action_type' => '1', 'description' => 'REIA visit New Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);

        return view('backend.reia.progress_report.progressReport', compact('schemes', 'states','bidders'));
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
                ]
            );
            if ($validation->fails()) {  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status' => 'verror', 'data' => $validation->errors()]);
            } 
            $auditMsg = "Feedback sent successfuly";
            $data = New Feedback();
            $data->message = $request->input('message');
            $data->user_id = Auth::user()->id;
            $data->user_type = 'reia';
            $data->save();
            $auditData = array('action_type' => '2', 'description' => $auditMsg, 'user_type' => '2');
            $this->auditTrail($auditData);
            return response()->json(['status' => 'success', 'message' => 'Feedback sent successfuly!', 'url' => $url,'user','redirect' => 'yes']);
        }
        return view('backend.reia.feedback', compact('url'));
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
       
        $progressDetails=ReiaReport::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name','tbl_master_bidder.bidder_name')
        ->join('states','states.code','reia_report.state_id')
        ->join('districts','districts.code','reia_report.district_id')
         ->join('schemes','schemes.id','reia_report.scheme_id')
         ->join('tbl_master_bidder','tbl_master_bidder.id','reia_report.bidder_id')
         ->where('reia_report.id',$id)
        ->first();
        
        return view('backend.reia.progress_report.PreviewProgressReport',compact('progressDetails'));
    }

}
