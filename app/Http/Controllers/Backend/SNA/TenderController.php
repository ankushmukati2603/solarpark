<?php

namespace App\Http\Controllers\Backend\SNA;
use Illuminate\Http\Request;
use App\Models\State;
use App\Traits\General;
use App\Models\District;
use App\Models\Village;
use App\Models\SubDistrict;
use App\Models\AuditTrail;
use App\Models\Tenders;
use App\Models\Agency;
use App\Models\SPD;
use App\Models\ReverseAuction;
use App\Models\CancelTender;
use App\Models\Bidder;
use App\Models\SelectedBidder;
use App\Models\SelectedBidderProject;
use App\Models\Commissioning;
use App\Models\TenderTimeLine;
use App\Http\Controllers\Controller;
use App\Utils\EmailSmsNotifications;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TenderExport;
use DB, URL, Auth, Hash, Storage, Config, Gate,Validator,PDF;

class TenderController extends Controller
{
    use General;
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function tender(){
        $auditData = array('action_type'=>'1','description'=>'SNA View Tender List','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->paginate(5);
        return view('backend.state-implementing-agency.tenders',compact('tenderList'));
    }
    public function addEditTender(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'nit_no'=>'required',
                'scheme_type'=>'required',
                'tender_title'=>'required',
                'capacity'=>'required',
                'nit_date'=>'required',
                'rfs_date'=>'required',
                'agency_id'=>'required',
                'pre_bid_meeting_date'=>'required|date|after:nit_date',
                'bid_submission_date'=>'required|date|after:pre_bid_meeting_date',
                
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $agency_sub_id=0;
            if(!empty($request->input('agency_sub_id'))){
                $agency_sub_id=$request->input('agency_sub_id');
            }
            $auditMsg="";
            if($request->editId){
                $auditMsg="SAN Update Tender Details successfuly";
                $tender=Tenders::find($request->editId);
            }else{
                $auditMsg="SAN Add Tender Details successfuly";
                $tender=new Tenders();
                $tender->tender_no=$this->generateTenderNo();
                $tender->tender_status=1;
                $tender->entry_date=$this->getCurruntDate();
            }
            $tender->nit_no= $request->input('nit_no');
            $tender->sna_id= Auth::user()->id;
            $tender->scheme_type=$request->input('scheme_type');
            $tender->tender_title=$request->input('tender_title');
            $tender->agency_id=$request->input('agency_id');
            $tender->agency_sub_id=$agency_sub_id;
            $tender->capacity= $request->input('capacity');
            $tender->nit_date=$request->input('nit_date');
            $tender->rfs_date=$request->input('rfs_date');
            $tender->pre_bid_meeting_date=$request->input('pre_bid_meeting_date');
            $tender->bid_submission_date=$request->input('bid_submission_date');
            
            $tender->save();
            $auditData = array('action_type'=>'3','description'=>$auditMsg,'user_type'=>'2'); 
            $this->auditTrail($auditData);
            //Tender Timeline
            $tenderTimeline = array('tender_id'=>$tender->id,'action_description'=>'Tender Published','action_type'=>'tender','action_date'=>$request->input('nit_date'));
            $this->tenderTimeline($tenderTimeline); 

            $url=urlencode('/'.Auth::getDefaultDriver().'/Tenders');
            return response()->json(['status' => 'success','message'=>'Tender Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add Tender Form','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderdetails=array();
        if($id){
            $tenderdetails=Tenders::select('*')->where('id',$id)->where('sna_id',Auth::user()->id)->first();
            // dd($tenderdetails);
        }
        $agencyList=Agency::all();
        return view('backend.state-implementing-agency.tendersAdd',compact('tenderdetails','agencyList'));
    }
    public function generateTenderNo(){
        $snaState = State::where('code',Auth::user()->state_id)->first()['short_name'];
        $tenderCount=Tenders::where('sna_id',Auth::user()->id)->count();
        $tender_no = str_pad(($tenderCount+1), 3, '0', STR_PAD_LEFT);
        return $snaState.date("mY").($tender_no);
    }
    public function agency(){
        $auditData = array('action_type'=>'1','description'=>'SNA View Agency List','user_type'=>'2');
        $this->auditTrail($auditData);
        $agencyList=Agency::getAgencyDetailsById(Auth::user()->id);
        // $agencyList=Agency::where('sna_id',Auth::id())->get();
        return view('backend.state-implementing-agency.agency',compact('agencyList'));
    }
    public function addEditAgency(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'agency_name'=>'required',
                'contact_person_name'=>'required',
                'contact_person_email'=>'required',
                'contact_person_number'=>'required',
                'agency_address'=>'required',
                'state'=>'required',
                'district_id'=>'required',
                
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $auditMsg="";
            if($request->editId){
                $auditMsg="SNA Update Agency Details successfuly";
                $agency=Agency::find($request->editId);
            }else{
                $auditMsg="SNA Add Agency Details successfuly";
                $agency=new Agency();
                $agency->entry_date=$this->getCurruntDate();
            }
            $agency->agency_name= $request->input('agency_name');
            $agency->sna_id= Auth::user()->id;
            $agency->contact_person_name= $request->input('contact_person_name');
            $agency->contact_person_email=$request->input('contact_person_email');
            $agency->contact_person_number= $request->input('contact_person_number');
            $agency->agency_address=$request->input('agency_address');
            $agency->state=$request->input('state');
            $agency->district=$request->input('district_id');
            $agency->save();
            $auditData = array('action_type'=>'3','description'=>$auditMsg,'user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/Agency');
            return response()->json(['status' => 'success','message'=>'Agency Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add Agency Form','user_type'=>'2');
        $this->auditTrail($auditData);
        $agencydetails=array();
        if($id){
            $agencydetails=Agency::select('*')->where('id',$id)->where('sna_id',Auth::user()->id)->first();
        }
        $states=State::orderby("name")->get();
        return view('backend.state-implementing-agency.agencyAdd',compact('agencydetails','states'));
    }
    public function sub_agency(){
        $auditData = array('action_type'=>'1','description'=>'SNA View SPDA List','user_type'=>'2');
        $this->auditTrail($auditData);
        $subAgencyList=SPD::getSPADAAgencyListById(Auth::user()->id);
        return view('backend.state-implementing-agency.spdAgency',compact('subAgencyList'));
    }
    public function addEditSubAgency(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'agency_id'=>'required',
                'agency_name'=>'required',
                'contact_person_name'=>'required',
                'contact_person_email'=>'required',
                'contact_person_number'=>'required',
                'agency_address'=>'required',
                'state'=>'required',
                'district_id'=>'required',
                
            ],[
                'agency_id.required'=>'Please select Agency Name',
                'agency_name.required'=>'Please enter SPD Name'
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $auditMsg="";
            if($request->editId){
                $auditMsg="SNA Update SPD Details successfuly";
                $agency=SPD::find($request->editId);
            }else{
                $auditMsg="SNA Add SPD Details successfuly";
                $agency=new SPD();
                $agency->entry_date=$this->getCurruntDate();
            }
            $agency->agency_name= $request->input('agency_name');
            $agency->agency_id= $request->input('agency_id');
            $agency->contact_person_name= $request->input('contact_person_name');
            $agency->contact_person_email=$request->input('contact_person_email');
            $agency->contact_person_number= $request->input('contact_person_number');
            $agency->agency_address=$request->input('agency_address');
            $agency->state=$request->input('state');
            $agency->district=$request->input('district_id');
            $agency->save();
            $auditData = array('action_type'=>'3','description'=>$auditMsg,'user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/Sub-Agency');
            return response()->json(['status' => 'success','message'=>'SPD Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add SPD Form','user_type'=>'2');
        $this->auditTrail($auditData);
        $agencydetails=array();
        if($id){
           $agencydetails=SPD::select('*')->where('id',$id)->first();
        }
        $agencyList=Agency::getAgencyDetailsById(Auth::user()->id);
        $states=State::orderby("name")->get();
        return view('backend.state-implementing-agency.spdaddagency',compact('agencyList','states','agencydetails'));
    }
    public function bidder(){
        $auditData = array('action_type'=>'1','description'=>'SNA View Biider List','user_type'=>'2');
        $this->auditTrail($auditData);
        $bidderList=Bidder::getBidderDetailsById(Auth::user()->id);
        return view('backend.state-implementing-agency.bidder',compact('bidderList'));
    }
    public function addEditBidder(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'agency_id'=>'required',
                'bidder_name'=>'required',
                'bidder_email'=>'required',
                'bidder_number'=>'required',
                'address'=>'required',
                'state'=>'required',
                'district_id'=>'required',                
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $auditMsg="";
            if($request->editId){
                $auditMsg="SNA Update Bidder Details successfuly";
                $bidder=Bidder::find($request->editId);
            }else{
                $auditMsg="SNA Add Bidder Details successfuly";
                $bidder=new Bidder();
                $bidder->entry_date=$this->getCurruntDate();
            }
            $bidder->agency_sub_id= $request->input('agency_sub_id');
            $bidder->agency_id= $request->input('agency_id');
            $bidder->sna_id= Auth::user()->id;
            $bidder->bidder_name= $request->input('bidder_name');
            $bidder->bidder_email=$request->input('bidder_email');
            $bidder->bidder_number= $request->input('bidder_number');
            $bidder->address=$request->input('address');
            $bidder->state=$request->input('state');
            $bidder->district=$request->input('district_id');
            $bidder->save();
            $auditData = array('action_type'=>'3','description'=>$auditMsg,'user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/Bidder');
            return response()->json(['status' => 'success','message'=>'Bidder Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add Bidder Form','user_type'=>'2');
        $this->auditTrail($auditData);
        $bidderdetails=array();
        if($id){
            $bidderdetails=Bidder::select('*')->where('id',$id)->where('sna_id',Auth::user()->id)->first();
        }
        $states=State::orderby("name")->get();
        $agencyList=Agency::getAgencyDetailsById(Auth::user()->id);
        return view('backend.state-implementing-agency.bidderAdd',compact('bidderdetails','states','agencyList'));
    }

    public function reverseAuction(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'ra_date'=>'required',
                'ra_type'=>'required',
                'capacity_awarded'=>'required_if:ra_type,Partial',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $ra_type=$request->input('ra_type');
            if($ra_type=='Full'){
                $capacity_awarded = 0;
                $ra_capacity = $request->input('cap_awarded_full');
            }else{
                $capacity_awarded = $request->input('cap_awarded_full')-$request->input('capacity_awarded');
                $ra_capacity = $request->input('capacity_awarded');
            }
            $reverseauction=new ReverseAuction();
            $reverseauction->entry_date=$this->getCurruntDate();
            $reverseauction->tender_id = base64_decode($request->input('tender'));
            $reverseauction->ra_date= $request->input('ra_date');
            $reverseauction->capacity_awarded=$capacity_awarded;
            $reverseauction->ra_type= $request->input('ra_type');
            $reverseauction->ra_capacity= $ra_capacity;
            $reverseauction->save();

            //Tender Timeline
            $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Reverse Auction',
            'action_type'=>'ra','action_date'=>$request->input('ra_date'));
            $this->tenderTimeline($tenderTimeline);


            $auditData = array('action_type'=>'3','description'=>'SNA Add Reverse Auction Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);


            $url=urlencode('/'.Auth::getDefaultDriver().'/ReverseAuction');
            return response()->json(['status' => 'success','message'=>'Reverse Auction Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='ra';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Reverse Auction Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->get();
        return view('backend.state-implementing-agency.reverseAuction',compact('tenderList','page'));
    }

    
    public function cancelTender(Request $request, $id=NULL){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'cancel_date'=>'required',
                'cancel_type'=>'required',
                'cancel_capacity'=>'required_if:cancel_type,Partial',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $cancel_type=$request->input('cancel_type');
            if($cancel_type=='Full'){
                $cancel_capacity = 0;
                $capacity =$request->input('cap_awarded_full');
            }else{
                $cancel_capacity = $request->input('cancel_capacity');
                $capacity = $request->input('cap_awarded_full')-$request->input('cancel_capacity');
            }
            $canceltender=new CancelTender();
            $canceltender->entry_date=$this->getCurruntDate();
            $canceltender->tender_id = base64_decode($request->input('tender'));
            $canceltender->cancel_date= $request->input('cancel_date');
            $canceltender->cancel_capacity=$cancel_capacity;
            $canceltender->cancel_type= $request->input('cancel_type');
            $canceltender->capacity= $capacity;
            $canceltender->save();

            Tenders::where('id',base64_decode($request->tender))->first()
                ->update([
                'tender_status' => 4, //Marked as Cancelled
            ]);

            //Tender Timeline
            $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Tender Cancelled',
            'action_type'=>'cancel','action_date'=>$request->input('cancel_date'));
            $this->tenderTimeline($tenderTimeline);
            


            $auditData = array('action_type'=>'3','description'=>'SNA Add Tender Cancellation Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/CancelTender');
            return response()->json(['status' => 'success','message'=>'Tender Cancellation Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='ct';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Cancel Tender Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->get();
        return view('backend.state-implementing-agency.cancelTender',compact('tenderList','page'));
    }
    public function selectedBidder(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'bidder_id.*'=>'required',
                'select_bidders_capacity.*'=>'required',
                // 'bidder_selected_date.*'=>'required'
            ],
            [
                'bidder_id.*.required'=>'This field is required',
                'select_bidders_capacity.*.required'=>'This field is required',
                // 'bidder_selected_date.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            for($i=0;$i<count($request->input('bidder_id'));$i++){
                $selectedBidder=new SelectedBidder();
                $selectedBidder->tender_id = base64_decode($request->input('tender'));
                $selectedBidder->bidder_id = $request->bidder_id[$i];
                $selectedBidder->capacity=$request->select_bidders_capacity[$i];
                $selectedBidder->bidder_selected_date=NULL;
                $selectedBidder->entry_date=$this->getCurruntDate();
                $selectedBidder->save();
                //Tender Timeline
                $get_bidder_selected_date=ReverseAuction::where('tender_id',base64_decode($request->input('tender')))->first()['ra_date'];
                $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Bidders Participated',
                'action_type'=>'bidder','action_date'=>$get_bidder_selected_date);
                $this->tenderTimeline($tenderTimeline);
            }
            
            $auditData = array('action_type'=>'3','description'=>'SNA Add Tender Bidders Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
             

            $url=urlencode('/'.Auth::getDefaultDriver().'/SelectedBidder');
            return response()->json(['status' => 'success','message'=>'Tender Bidders Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='sb';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Selected Bidder Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        $bidderList=Bidder::getBidderListById(Auth::user()->id);
        // dd($bidderList);
        return view('backend.state-implementing-agency.selectedBidder',compact('tenderList','page','bidderList'));
    }
    public function projectLocation(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                    'tender'=>'required',
                    'bidders'=>'required',
                    'state.*'=>'required',
                    'district_id.*'=>'required',
                    'sub_district_id.*'=>'required',
                    'village_id.*'=>'required',
                    'lat.*'=>'required',
                    'lng.*'=>'required',
                    'project_location_date.*'=>'required',
                ],[
                    'state.*.required'=>'This field is required',
                    'district_id.*.required'=>'This field is required',
                    'sub_district_id.*.required'=>'This field is required',
                    'village_id.*.required'=>'This field is required',
                    'lat.*.required'=>'This field is required',
                    'lng.*.required'=>'This field is required',
                    'project_location_date.*.required'=>'This field is required',
                ]
            
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            
            for($i=0;$i<count($request->input('state'));$i++){ $j=0;
                
                $tender_id = str_pad(base64_decode($request->input('tender')), 2, '0', STR_PAD_LEFT);
                $state_code=State::where('code',$request->state[$i])->first()['short_name'];
                $j = $i+1; $j=str_pad($j, 2, '0', STR_PAD_LEFT);

                $SelectedBidderProject=new SelectedBidderProject();
                $SelectedBidderProject->tender_id=$tender_id;
                $SelectedBidderProject->bidder_id = $request->bidders;
                $SelectedBidderProject->project_title = 'Project-'.$tender_id.'-'.$request->bidders.'-'.$state_code.'-'.$j;
                $SelectedBidderProject->state=$request->state[$i];
                $SelectedBidderProject->district_id=$request->district_id[$i];
                $SelectedBidderProject->sub_district_id=$request->sub_district_id[$i];
                $SelectedBidderProject->village_id=$request->village_id[$i];
                $SelectedBidderProject->lat=$request->lat[$i];
                $SelectedBidderProject->lng=$request->lng[$i];
                $SelectedBidderProject->project_location_date=$request->project_location_date[$i];
                $SelectedBidderProject->entry_date=$this->getCurruntDate();
                $SelectedBidderProject->save();
            }

            $auditData = array('action_type'=>'3','description'=>'SNA Add Project Location Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/ProjectLocation');

            $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'LOA/LOI Details Submitted',
                'action_type'=>'loa','action_date'=>$request->project_location_date[0]);
                $this->tenderTimeline($tenderTimeline);

            return response()->json(['status' => 'success','message'=>'Project Location saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='ppa';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add Project Location Details Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        $states=State::orderby("name","ASC")->get();
        return view('backend.state-implementing-agency.projectLocation',compact('tenderList','page','states'));
    }
    public function signingofPSA(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                    'tender'=>'required',
                    'bidders'=>'required',
                    'ppa_psa_date.*'=>'required',
                    'ppa_psa_capacity.*'=>'required',
                    'ppa_psa_signed_state.*'=>'required',
                    'discom_name.*'=>'required',
                    'electricity_per_unit_cost.*'=>'required',
                    'duration_psa.*'=>'required',
                ],[
                    'ppa_psa_date.*.required'=>'This field is required',
                    'ppa_psa_capacity.*.required'=>'This field is required',
                    'ppa_psa_signed_state.*.required'=>'This field is required',
                    'discom_name.*.required'=>'This field is required',
                    'electricity_per_unit_cost.*.required'=>'This field is required',
                    'duration_psa.*.required'=>'This field is required',
                ]
            
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            for($i=0;$i<count($request->input('ppa_psa_date'));$i++){
                $SelectedBidderProject=SelectedBidderProject::findOrFail($request->id[$i]);
                $SelectedBidderProject->ppa_psa_date=$request->ppa_psa_date[$i];
                $SelectedBidderProject->ppa_psa_capacity=$request->ppa_psa_capacity[$i];
                $SelectedBidderProject->ppa_psa_signed_state=$request->ppa_psa_signed_state[$i];
                $SelectedBidderProject->discom_name=$request->discom_name[$i];
                $SelectedBidderProject->electricity_per_unit_cost=$request->electricity_per_unit_cost[$i];
                $SelectedBidderProject->duration_psa=$request->duration_psa[$i];
                $SelectedBidderProject->entry_date=$this->getCurruntDate();
                $SelectedBidderProject->save();
                //Tender Timeline
                $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'PSA Details Submitted',
                'action_type'=>'psa','action_date'=>$request->ppa_psa_date[$i]);
                $this->tenderTimeline($tenderTimeline);
            }
            $auditData = array('action_type'=>'3','description'=>'SNA Add PSA Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/SigningOfPSA');
            return response()->json(['status' => 'success','message'=>'PSA saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='ppa';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit PPA/PSA Details Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        $states=State::orderby("name","ASC")->get();
        return view('backend.state-implementing-agency.signingofppapsa',compact('tenderList','page','states'));
    }
    public function SigningOfPPA(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'ppa_date.*'=>'required',
                'ppa_capacity.*'=>'required',
                'ppa_electricity_per_unit_cost.*'=>'required',
                'duration_ppa.*'=>'required',
            ],[
                'ppa_date.*.required'=>'This field is required',
                'ppa_capacity.*.required'=>'This field is required',
                'ppa_electricity_per_unit_cost.*.required'=>'This field is required',
                'duration_ppa.*.required'=>'This field is required',
            ]
            
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            for($i=0;$i<count($request->input('ppa_date'));$i++){
                $SelectedBidderProject=SelectedBidderProject::findOrFail($request->id[$i]);
                $SelectedBidderProject->ppa_date=$request->ppa_date[$i];
                $SelectedBidderProject->ppa_capacity=$request->ppa_capacity[$i];
                $SelectedBidderProject->ppa_electricity_per_unit_cost=$request->ppa_electricity_per_unit_cost[$i];
                $SelectedBidderProject->duration_ppa=$request->duration_ppa[$i];
                $SelectedBidderProject->entry_date=$this->getCurruntDate();
                $SelectedBidderProject->save();
                //Tender Timeline
                $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'PPA Details Submitted',
                'action_type'=>'ppa','action_date'=>$request->ppa_date[$i]);
                $this->tenderTimeline($tenderTimeline);
            }
            $auditData = array('action_type'=>'3','description'=>'SNA Add PPA Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/SigningOfPPA');
            return response()->json(['status' => 'success','message'=>'PPA saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $page='ppa';
        $auditData = array('action_type'=>'1','description'=>'SNA Visit PPA Details Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        $states=State::orderby("name","ASC")->get();
        return view('backend.state-implementing-agency.signingofppa',compact('tenderList','page','states'));
    }
    
    public function loaLoi(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'loi_loa_date.*'=>'required',
            ],[
                'loi_loa_date.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            for($i=0;$i<count($request->input('loi_loa_date'));$i++){
                $SelectedBidderProject=SelectedBidderProject::findOrFail($request->id[$i]);
                $SelectedBidderProject->loi_loa_date=$request->loi_loa_date[$i];
                $SelectedBidderProject->save();
                //Tender Timeline
                $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'LOA/LOI Details Submitted',
                'action_type'=>'loa','action_date'=>$request->loi_loa_date[$i]);
                $this->tenderTimeline($tenderTimeline);
            }
            

            $auditData = array('action_type'=>'3','description'=>'SNA Add LOA/LOI Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);

            

            $url=urlencode('/'.Auth::getDefaultDriver().'/LOA-LOI');
            return response()->json(['status' => 'success','message'=>'LOA/LOI Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit LOA/LOI Details Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        return view('backend.state-implementing-agency.loaloi',compact('tenderList'));
    }
    public function tenderCommissioning_bk(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'schedule_commissiong_date.*' => 'required', 
                'commissioned_capacity.*' => 'required',
                'actual_commissiong_date.*' => 'required',
                'actual_commissioned_capacity.*' => 'required',
            ],[
                'schedule_commissiong_date.*.required'=>'This field is required',
                'commissioned_capacity.*.required'=>'This field is required',
                'actual_commissiong_date.*.required'=>'This field is required',
                'actual_commissioned_capacity.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            
            for($i=0;$i<count($request->input('schedule_commissiong_date'));$i++){
                $SelectedBidderProject=SelectedBidderProject::findOrFail($request->id[$i]);
                $SelectedBidderProject->schedule_commissiong_date=$request->schedule_commissiong_date[$i];
                $SelectedBidderProject->revised_schedule_commissiong_date=$request->revised_schedule_commissiong_date[$i];
                $SelectedBidderProject->commissioned_capacity=$request->commissioned_capacity[$i];
                $SelectedBidderProject->actual_commissiong_date=$request->actual_commissiong_date[$i];
                $SelectedBidderProject->actual_commissioned_capacity=$request->actual_commissioned_capacity[$i];
                $SelectedBidderProject->save();
                //Tender Timeline
                $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Commissioning Details Submitted',
                'action_type'=>'commissioned','action_date'=>$request->schedule_commissiong_date[$i]);
                $this->tenderTimeline($tenderTimeline);
            }
            $updateTenderStatus=Tenders::where('id', $request->tender_id)->update(['tender_status'=>2]);
            $auditData = array('action_type'=>'3','description'=>'SNA Add Tender Comissioning Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/TenderCommissioning');
            return response()->json(['status' => 'success','message'=>'Tender Comissioning Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Tender Comissioning Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 4)->get();
        return view('backend.state-implementing-agency.tendercommissioning',compact('tenderList'));
    }
    public function tenderCommissioning(Request $request){
        if($request->isMethod('post')){
            // dd($request->all());
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'projects'=>'required',
                'schedule_commissiong_date' => 'required', 
                // 'revised_schedule_commissiong_date'=>'required',
                'commissioned_capacity' => 'required',
                'actual_commissiong_date.*' => 'required',
                'actual_commissioned_capacity.*' => 'required',
            ],[
                'schedule_commissiong_date.required'=>'This field is required',
                'commissioned_capacity.required'=>'This field is required',
                'revised_schedule_commissiong_date.required'=>'This field is required',
                'actual_commissiong_date.*.required'=>'This field is required',
                'actual_commissioned_capacity.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $revised_schedule_commissiong_date=NULL;
            if($request->revised_schedule_commissiong_date!=null){$revised_schedule_commissiong_date=$request->revised_schedule_commissiong_date;}
            $updateProjectData=SelectedBidderProject::findOrFail($request->projects);
            $updateProjectData->schedule_commissiong_date=$request->schedule_commissiong_date;
            $updateProjectData->revised_schedule_commissiong_date=$revised_schedule_commissiong_date;
            $updateProjectData->commissioned_capacity=$request->commissioned_capacity;
            $updateProjectData->save();



            for($i=0;$i<count($request->input('actual_commissiong_date'));$i++){
                $addCommissionedData=new Commissioning();
                $addCommissionedData->actual_commissiong_date=$request->actual_commissiong_date[$i];
                $addCommissionedData->actual_commissioned_capacity=$request->actual_commissioned_capacity[$i];
                $addCommissionedData->project_id =$request->projects;
                $addCommissionedData->entry_date =$this->getCurruntDate();
                $addCommissionedData->save();
                
            }
            Tenders::where('id',base64_decode($request->tender))->update(['tender_status' => 2]);
            //Tender Timeline
            $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Commissioning Details Submitted',
            'action_type'=>'commissioned','action_date'=>$request->schedule_commissiong_date);
            $this->tenderTimeline($tenderTimeline);

            
            $auditData = array('action_type'=>'3','description'=>'SNA Add Tender Comissioning Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/TenderCommissioning');
            return response()->json(['status' => 'success','message'=>'Tender Comissioning Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Tender Comissioning Page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        return view('backend.state-implementing-agency.tendercommissioning',compact('tenderList'));
    }
    public function tenderPreview($tender_id){
        $tender=Tenders::getTenderDetailsById(base64_decode($tender_id));
        $bidderProjectLocationData=SelectedBidderProject::getSelectedBidderProjectDetails(base64_decode($tender_id));
        $commissioningData=Commissioning::getCommissionedDataByTenderId(base64_decode($tender_id));
        $selectedBidderData=SelectedBidder::getSelectedBidderDetails(base64_decode($tender_id));
        // dd($selectedBidderData);
        return view('backend.state-implementing-agency.previewTender',compact('tender','selectedBidderData','bidderProjectLocationData','commissioningData'));
    }
    public function getTenderDetailById($page,$id){
        $tender=Tenders::where('id',base64_decode($id))->first();
        $reverseauction='';
        if($tender){
            try {
                //code...
                $result='<table class="table table-bordered" style="background-color: darkcyan;border-color: cadetblue;color: #fff;">
                            <tr class="bg-light text-dark">
                                <th colspan="5"><h3>Tender Details</h3></th>
                            </tr>
                            <tr>
                                <th width="20%">Tender No</th>
                                <td width="30%">'.$tender->tender_no.'</td>
                                <th width="20%">NIT No.</th>
                                <td width="30%">'.$tender->nit_no.'</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>'.$tender->tender_title.'</td>
                                <th>Capacity(MW)</th>
                                <td id="tender_capacity">'.$tender->capacity.'</td>
                                <input type="hidden" id="tender_capacity" value="'.$tender->capacity.'" />
                            </tr>
                            <tr>
                                <th>NIT Date</th>
                                <td>'.date("d M Y",strtotime($tender->nit_date)).'</td>
                                <th>RFS Date</th>
                                <td>'.date("d M Y",strtotime($tender->rfs_date)).'</td>
                            </tr>
                            <tr>
                                <th>Pre Bid Meeting</th>
                                <td>'.date("d M Y",strtotime($tender->pre_bid_meeting_date)).'</td>
                                <th>Last Date of Bid Submission</th>
                                <td>'.date("d M Y",strtotime($tender->bid_submission_date)).'</td>
                            </tr>';
                            if($page=='ra'){ //Reverse Auctionb
                                $dataDetails=$this->getReverseAuctionDetailByTender($id);
                                $result.=$dataDetails;
                            }
                            if($page=='ct'){ // Cancel Tender
                                $dataDetails=$this->getCancelDetailOfTender($id);
                                $result.=$dataDetails;
                            }
                            if($page=='sb'){ // Selected Bidder
                                $dataDetails=$this->getBidderDetailOfTender($id);
                                $result.=$dataDetails;
                            }
                            if($page=='ppa'){ // PPA/PSA
                                $dataDetails=$this->getBidderDetailOfTender($id);
                                $result.=$dataDetails;
                            }
                    $result.='</table>';
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            return response()->json(['status' => 'success','result'=>$result,'tenderData'=>$dataDetails]);
        }
        return response()->json(['status' => 'error','message'=>'Tender Not Found!']);
    }
    public function getTenderBidderById($id){
        $selectedBidderDetails = SelectedBidder::getSelectedBidderDetails(base64_decode($id));
        if(!$selectedBidderDetails->isEmpty()){
            $result='<option value="">Choose Bidder</option>';
            foreach($selectedBidderDetails as $bidder){
                $result.='<option value="'.$bidder->bidder_id.'">'.$bidder->bidder_name.'</option>';
            }
           
            return response()->json(['status' => 'success','result'=>$result]);
        }
        return response()->json(['status' => 'error','result'=>'Bidder Not Found!']);
    }
    public function getSelectedBidderProjectData($id,$tender_id){
        $selectedBidderProjectDetails=SelectedBidderProject::getSelectedBidderProjectLocationData($id,$tender_id);
        if($selectedBidderProjectDetails->isNotEmpty()){
            $result='<table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="8">
                            <h4>Project Location Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project</th>
                        <th>State </th>
                        <th>Districts </th>
                        <th>Tehsil </th>
                        <th>Village</th>
                        <th>Latitude </th>
                        <th>Longitude  </th>
                        <th>Project Location Date  </th>
                    </tr>';
                foreach($selectedBidderProjectDetails as $data){
                    $result.='<tr>
                    <td class="row-index">'.$data->project_title.'</td>
                    <td>'.$data->state.'</td>
                    <td>'.$data->district_id.'</td>
                    <td>'.$data->sub_district_id.'</td>
                    <td>'.$data->village_id.'</td>
                    <td>'.$data->lat.'</td>
                    <td>'.$data->lng.'</td>
                    <td>'.date("d M Y",strtotime($data->project_location_date)).'</td>
                    </tr>';
                }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }
        return response()->json(['status' => 'error','result'=>0]);

    }
    public function getSelectedBidderPSAData($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        $result='';
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $states=State::orderby("name","ASC")->get();
            $result='<table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="7">
                            <h4>PSA Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project Name</th>
                        <th>Date of PSA <span class="text-danger">*</span></th>
                        <th>Capacity (MW) <span class="text-danger">*</span></th>
                        <th>Name of State in PSA Signed <span class="text-danger">*</span></th>
                        <th>Name of DISCOM who have signed PSA <span class="text-danger">*</span>
                        </th>
                        <th>Per Unit cost of electricity as per said PSA <span class="text-danger">*</span></th>
                        <th>Duration of PSA(In Years) <span class="text-danger">*</span></th>
                        
                    </tr>';
                foreach($selectedBidderProjectData as $data){$i++;
                    if($data->ppa_psa_capacity==''){
                    $result.='<tr id="">
                        <td class="row-index">'.$data->project_title.'</td>
                            <td class="row-index">
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="ppa_psa_date" placeholder="MM-DD-YYYY" name="ppa_psa_date[]"
                                    value="">
                                <span name="ppa_psa_date.0"></span>
                                <input type="hidden" name="id[]" value="'.$data->id.'" />
                            </td>

                            <td> <input type="text" placeholder="Enter Capacity(MW)"
                                    name="ppa_psa_capacity[]" id="ppa_psa_capacity" class="form-control "
                                    value="">
                                <span name="ppa_psa_capacity.'.($i-1).'"></span>
                            </td>
                            <td> <select name="ppa_psa_signed_state[]" id="ppa_psa_signed_state"
                                    class="form-control ">
                                    <option value="">Choose State</option>';
                                    foreach($states as $state){
                                    $result.='<option value="'.$state->code.'">'.$state->name.'</option>';
                                    }
                                    $result.='</select>
                                <span name="ppa_psa_signed_state.'.($i-1).'"></span>
                            </td>
                            <td> <input type="text" placeholder="Enter DISCOM Name" name="discom_name[]"
                                    id="discom_name" class="form-control " value="">
                                <span name="discom_name.'.($i-1).'"></span>
                            </td>
                            <td> <input type="number" step="any" placeholder="Enter per Unit Cost"
                                    name="electricity_per_unit_cost[]" id="electricity_per_unit_cost"
                                    class="form-control " value="">
                                <span name="electricity_per_unit_cost.'.($i-1).'"></span>
                            </td>
                            <td> <input type="number" step="any" placeholder="Enter Duration of PPA(In Months)"
                                    name="duration_psa[]" id="duration_psa" class="form-control" value="">
                                <span name="duration_psa.'.($i-1).'"></span>
                            </td>
                            
                        </tr>';
                        if($i==count($selectedBidderProjectData)){
                            $result.='<tr>
                                <td colspan="7">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                </td>
                            </tr>';
                        }
                    }else{
                        $result.='<tr>
                        <td class="row-index">'.$data->project_title.'</td>
                        <td>'.date("d M Y",strtotime($data->ppa_psa_date)).'</td>
                        <td>'.$data->ppa_psa_capacity.'</td>
                        <td>'.$data->ppa_psa_signed_state.'</td>
                        <td>'.$data->discom_name.'</td>
                        <td>'.$data->electricity_per_unit_cost.'</td>
                        <td>'.$data->duration_psa.'</td>
                        </tr>';
                    }
                }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        
        return response()->json(['status' => 'success','result'=>$result]);

    }
    public function getSelectedBidderPPAData($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        $result='';
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $states=State::orderby("name","ASC")->get();
            $result='<table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="5">
                            <h4>PPA Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th width="20%">Project Name</th>
                        <th width="20%">Effective Date of PPA <span class="text-danger">*</span></th>
                        <th width="20%">Capacity (MW) <span class="text-danger">*</span></th>
                        <th width="20%">Per Unit cost of electricity as per said PPA <span class="text-danger">*</span></th>
                        <th width="20%">Duration of PPA(In Years) <span class="text-danger">*</span></th>
                        
                    </tr>';
                foreach($selectedBidderProjectData as $data){$i++;
                    if($data->ppa_capacity==''){
                    $result.='<tr id="">
                        <td class="row-index">'.$data->project_title.'</td>
                            <td class="row-index">
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="ppa_date" placeholder="MM-DD-YYYY" name="ppa_date[]"
                                    value="">
                                <span name="ppa_date.0"></span>
                                <input type="hidden" name="id[]" value="'.$data->id.'" />
                            </td>

                            <td> <input type="text" placeholder="Enter Capacity(MW)"
                                    name="ppa_capacity[]" id="ppa_capacity" class="form-control "
                                    value="">
                                <span name="ppa_capacity.'.($i-1).'"></span>
                            </td>
                            
                            <td> <input type="number" step="any" placeholder="Enter per Unit Cost"
                                    name="ppa_electricity_per_unit_cost[]" id="ppa_electricity_per_unit_cost"
                                    class="form-control " value="">
                                <span name="ppa_electricity_per_unit_cost.'.($i-1).'"></span>
                            </td>
                            <td> <input type="number" step="any" placeholder="Enter Duration of PPA(In Months)"
                                    name="duration_ppa[]" id="duration_ppa" class="form-control" value="">
                                <span name="duration_ppa.'.($i-1).'"></span>
                            </td>
                            
                        </tr>';
                        if($i==count($selectedBidderProjectData)){
                            $result.='<tr>
                                <td colspan="5">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                </td>
                            </tr>';
                        }
                    }else{
                        $result.='<tr>
                        <td class="row-index">'.$data->project_title.'</td>
                        <td>'.date("d M Y",strtotime($data->ppa_date)).'</td>
                        <td>'.$data->ppa_capacity.'</td>
                        <td>'.$data->ppa_electricity_per_unit_cost.'</td>
                        <td>'.$data->duration_ppa.'</td>
                        </tr>';
                    }
                }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        
        return response()->json(['status' => 'success','result'=>$result]);

    }
    public function getReverseAuctionDetailByTender($id){
        $reverseauction = ReverseAuction::where('tender_id',base64_decode($id))->first(); 
        $result=null;
        if($reverseauction!=null){
            $full=$partial='';
            if($reverseauction->ra_type=="Full"){ $full="selected"; }
            if($reverseauction->ra_type=="Partial") { $partial="selected"; }
            $result='
            <tr class="bg-light text-dark">
                <th colspan="4"><h3>Reverse Auction Details <a href="javascript" data-bs-toggle="modal" class="hide" data-bs-target="#exampleModal">
                    <i class="fa fa-edit"></i> </a></h3>
                </th>
            </tr>
            <tr>
                <th>Reverse Auction Date</th>
                <td>'.date("d M Y",strtotime($reverseauction->ra_date)).'</td>
                <th>RA Type</th>
                <td>'.$reverseauction->ra_type.'</td> 
            </tr>
            <tr>
                <th>Capacity Awarded(MW)</th>
                <td>'.$reverseauction->capacity_awarded.'</td>
                <th>RA Capacity(MW)</th>
                <td>'.$reverseauction->ra_capacity.'</td> 
            </tr>
            <tr>
                <th>Submitted On</th>
                <td>'.date("d M Y",strtotime($reverseauction->entry_date)).'</td> 
            </tr>
            ';
        }
        return $result;
    }
    public function getCancelDetailOfTender($id){
        $canceldetails = CancelTender::where('tender_id',base64_decode($id))->first(); 
        $result=null;
        if($canceldetails!=null){
            $result='
            <tr class="bg-light text-dark">
                <th colspan="4"><h3>Cancel Tender Details</h3></th>
            </tr>
            <tr>
                <th>Cancelled Date</th>
                <td>'.date("d M Y",strtotime($canceldetails->cancel_date)).'</td>
                <th>RA Type</th>
                <td>'.$canceldetails->cancel_type.'</td> 
            </tr>
            <tr>
                <th>Capacity Cancel(MW)</th>
                <td>'.$canceldetails->cancel_capacity.'</td>
                <th>Active/Remaining Capacity(MW)</th>
                <td>'.$canceldetails->capacity.'</td> 
            </tr>
            <tr>
                <th>Submitted On</th>
                <td>'.date("d M Y",strtotime($canceldetails->entry_date)).'</td> 
            </tr>';
        }
        return $result;
    }
    public function getBidderDetailOfTender($id){
        $selectedBidderDetails = SelectedBidder::getSelectedBidderDetails(base64_decode($id));
        $result=null;
        if(!$selectedBidderDetails->isEmpty()){
            $result='
            <tr class="bg-light text-dark">
                <th colspan="4"><h3>Selected Bidders Details</h3></th>
            </tr>
            <tr>
                <th width="30%" colspan="2">Bidder Name</th>
                <th>Capacity(MW)</th>
                <th width="30%">Submitted On</th>
            </tr>
            ';
            $i=0;
            foreach($selectedBidderDetails as $bidder){$i++;
                $result.='
                    <tr>
                        <th colspan="2"  width="30%" >'.$i.') '.$bidder->bidder_name.'</th>
                        <td width="20%">'.$bidder->capacity.'</td>
                        <td  width="30%">'.$bidder->entry_date.'</td> 
                    </tr>';
            }
            
        }
        return $result;
    }
    public function getSelectedLoaBidderData_bk($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        $result='';
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $states=State::orderby("name","ASC")->get();
            $result='<table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="3">
                            <h4>PPA/PSA Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project Name</th>
                        <th>Date of LOA/LOI <span class="text-danger">*</span></th>
                        
                    </tr>';
                foreach($selectedBidderProjectData as $data){$i++;
                    if($data->loi_loa_date==''){
                        $result.='<tr id="">
                            <td class="row-index">'.$data->project_title.'</td>
                                <td class="row-index">
                                    <input type="date" class="form-control pull-right alldatepicker "
                                        id="loi_loa_date" placeholder="MM-DD-YYYY" name="loi_loa_date[]"
                                        value="">
                                    <span name="loi_loa_date.'.($i-1).'"></span>
                                    <input type="hidden" name="id[]" value="'.$data->id.'" />
                                </td>
                                
                            </tr>';
                            if($i==count($selectedBidderProjectData)){
                                $result.='<tr>
                                    <td colspan="3">
                                        <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                    </td>
                                </tr>'; }
                        }else{
                            $result.='<tr>
                            <td class="row-index">'.$data->project_title.'</td>
                            <td>'.date("d M Y",strtotime($data->loi_loa_date)).'</td>
                            </tr>';
                        }
                }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
    }
    public function getSelectedLoaBidderData($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        $result='';
        // dd($selectedBidderProjectData);
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $states=State::orderby("name","ASC")->get();
            $result='<table class="table table-bordered" id="ppaTbale">
                        <tr class="bg-primary text-light">
                            <th colspan="3">
                                <h4>LOA/LOI Details</h4>
                            </th>
                        </tr>
                        <tr class="bg-success text-light">
                            <th>Project Name</th>
                            <th>Date of LOA/LOI <span class="text-danger">*</span></th>
                            
                        </tr>';
                foreach($selectedBidderProjectData as $data){$i++;
                    $result.='<tr>
                        <td class="row-index">'.$data->project_title.'</td>
                        <td>'.date("d M Y",strtotime($data->project_location_date)).'</td>
                        </tr>';
                    }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
    }
    public function getTenderComissioningData($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        $result='';
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $states=State::orderby("name","ASC")->get();
            $result='<table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="8">
                            <h4>Tender Commissioning Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project Name</th>
                        <th>Schedule Commissiong Date (As Per PPA) <span class="text-danger">*</span></th>
                        <th>Schedule Commissiong Date (Revised/Extended Date) </th>
                        <th>Commissioned Capacity(MW)  <span class="text-danger">*</span></th>
                        <th>Actual Commissiong Date <span class="text-danger">*</span></th>
                        <th>Actual Commissioned Capacity(MW)  <span class="text-danger">*</span></th>
                        
                    </tr>';
                foreach($selectedBidderProjectData as $data){$i++;
                    $revised_schedule_commissiong_date='NA';
                    if($data->revised_schedule_commissiong_date!=NULL){
                        $revised_schedule_commissiong_date = date("d M Y",strtotime($data->revised_schedule_commissiong_date));
                    }
                    if($data->schedule_commissiong_date==''){
                    $result.='<tr>
                            <td class="row-index">'.$data->project_title.'
                            <input type="hidden" name="id[]" value="'.$data->id.'" />
                            </td>
                            <td>
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="schedule_commissiong_date" placeholder="MM-DD-YYYY" name="schedule_commissiong_date[]"
                                    value="">
                                    <span name="schedule_commissiong_date.'.($i-1).'"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="revised_schedule_commissiong_date" placeholder="MM-DD-YYYY" name="revised_schedule_commissiong_date[]"
                                    value="">
                                    <span name="revised_schedule_commissiong_date.'.($i-1).'"></span>
                            </td>
                            <td>
                                <input type="number" step="any" class="form-control" id="commissioned_capacity"
                                    placeholder="Enter Commissioned Capacity(MW)" name="commissioned_capacity[]" value="">
                                    <span name="commissioned_capacity.'.($i-1).'"></span>
                            </td>
                            <td>
                                <input type="date" class="form-control pull-right alldatepicker "
                                    id="actual_commissiong_date" placeholder="MM-DD-YYYY" name="actual_commissiong_date[]"
                                    value="">
                                    <span name="actual_commissiong_date.'.($i-1).'"></span>
                            </td>
                            <td>
                                <input type="number" step="any" class="form-control" id="actual_commissioned_capacity"
                                    placeholder="Enter Actual Commissioned Capacity(MW)" name="actual_commissioned_capacity[]"
                                    value="">
                                    <span name="actual_commissioned_capacity.'.($i-1).'"></span>
                            </td>
                        </tr>';
                        if($i==count($selectedBidderProjectData)){
                            $result.='<tr>
                                <td colspan="6">
                                    <input type="submit" name="submit" id="submit" value="Save" class="btn btn-success">
                                </td>
                            </tr>';
                        }
                    }else{
                        $result.='<tr>
                        <td class="row-index">'.$data->project_title.'</td>
                        <td>'.date("d M Y",strtotime($data->schedule_commissiong_date)).'</td>
                        <td>'.$revised_schedule_commissiong_date.'</td>
                        <td>'.$data->commissioned_capacity.'</td>
                        <td>'.date("d M Y",strtotime($data->actual_commissiong_date)).'</td>
                        <td>'.$data->actual_commissioned_capacity.'</td>
                        </tr>';
                    }
                }
                $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
    }
    public function getReportData($id,$tender_id){
        $reportData=array();
        $timelinedata=TenderTimeLine::where('id','<=',$id)->where('tender_id',$tender_id)->orderby('id','asc')->get()->toArray();$i=0;
        // dd($timelinedata);
        foreach($timelinedata as $data){
            if($data['action_type']=='tender'){
                $reportData['tender']=Tenders::getTenderById($data['tender_id']);
                $reportData['tender_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='tender';
            }
            if($data['action_type']=='bidder'){
                $reportData['bidder']=SelectedBidderProject::getSelectedBidderDetails($data['tender_id']);
                $reportData['bidder_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='bidder';
            }
            if($data['action_type']=='ppa'){
                $reportData['ppa']=SelectedBidderProject::getSelectedBidderDetails($data['tender_id']);
                $reportData['ppa_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='ppa';
            }
            if($data['action_type']=='psa'){
                $reportData['psa']=SelectedBidderProject::getSelectedBidderDetails($data['tender_id']);
                $reportData['psa_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='psa';
            }
            if($data['action_type']=='loa'){
                $reportData['loa']=SelectedBidderProject::getSelectedBidderDetails($data['tender_id']);
                $reportData['loa_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='loa';
            }
            if($data['action_type']=='ra'){
                $reportData['ra']=ReverseAuction::where('tender_id',$data['tender_id'])->first()->toArray();
                $reportData['ra_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='ra';
            }
            if($data['action_type']=='cancel'){
                $reportData['cancel']=CancelTender::where('tender_id',$data['tender_id'])->first()->toArray();
                $reportData['cancel_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='cancel';
            }
            if($data['action_type']=='commissioned'){
                $reportData['commissioned']=Commissioning::getCommissionedDataByTenderId($data['tender_id']);
                $reportData['commissioned_submitted_on']=$data['action_date'];
                $reportData['timeline'][$i]='commissioned';
            }
            $i++;
        }
        // dd($reportData);
        return $reportData;
    }
    public function getSearchFilters(){
        return array(
            'tenders'=>Tenders::select('id','tender_no')->where('sna_id',Auth::id())->get()->toArray(),
            'states'=>State::select('code','name')->orderby('name')->get()->toArray(),
            'agencies'=>Agency::select('id','agency_name')->orderby('agency_name')->get()->toArray(),
            // 'bidders'=>Bidder::select('id','bidder_name')->orderby('bidder_name')->get()->toArray()
        );

    }
    public function tenderReport(Request $request){
       
        if($request->isMethod('post')){
            $reportData=array();
            $reportData=TenderTimeLine::getTenderTimeLineByFilter($request->state_id,$request->agency_id,$request->tender_id,$request->fromdate,$request->todate);
            $searchFilters=$this->getSearchFilters();
            return view('backend.state-implementing-agency.reportTenders',compact('reportData','searchFilters'));
        }
        $reportData=array();
        $reportData=TenderTimeLine::getTenderTimeLine();
        // dd($reportData);
        $searchFilters=$this->getSearchFilters();
        return view('backend.state-implementing-agency.reportTenders',compact('reportData','searchFilters'));
    }
    public function reportView($id,$tender_id){
        $tender_id=base64_decode($tender_id); $id=base64_decode($id);
        $reportData=$this->getReportData($id,$tender_id);
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Tender Report View Page','user_type'=>'2');

        $this->auditTrail($auditData);
        return view('backend.state-implementing-agency.reportView',compact('reportData'));

    }
    public function downloadPdf($id,$tender_id){
        try {
            //code...
            $tender_id=base64_decode($tender_id); $id=base64_decode($id);
            $auditData = array('action_type'=>'1','description'=>'SNA Download Report ','user_type'=>'2');
            $this->auditTrail($auditData);
            $reportData=array('reportData'=>$this->getReportData($id,$tender_id));
            // dd($data);
            $pdf = PDF::loadView('backend.state-implementing-agency.reportViewPdf', $reportData);
            return $pdf->download('Report_'.date("ymdhis").'.pdf');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
    


    // if($i==1){
    //     $result.='<tr>
    //         <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$getProjectData["data"]["project_title"].'</td>
    //         <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$this->dateFormat($getProjectData["data"]["schedule_commissiong_date"]).'</td>
    //         <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$revised_schedule_commissiong_date.'</td>
    //         <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$getProjectData["data"]["actual_commissioned_capacity"].'</td>
    //         <td>'.$this->dateFormat($gpData["actual_commissiong_date"]).'</td>
    //         <td>'.$gpData["actual_commissioned_capacity"].'</td>
    //     </tr>';
    // }else{
    //     $result.='<tr>
    //         <td>'.$this->dateFormat($gpData["actual_commissiong_date"]).'</td>
    //         <td>'.$gpData["actual_commissioned_capacity"].'</td>
    //     </tr>';
    // }





    public function downloadExcel(){
        try {
            $tenderArray=array();
            $tenderdata=Tenders::getAllTendersSNAWise(Auth::id());
            // dd($tenderdata);
            $userdata=Auth::user();
            $i=0;
            foreach($tenderdata as $data){
                $bidders=SelectedBidder::getSelectedBidderDetailsByTenders($data['tid']);
                // dd($bidders);
                $tenderArray[$i] = $data;
                $tenderArray[$i]['projectCount']=SelectedBidderProject::where('tender_id',$data['tid'])->count();
                $tenderArray[$i]['bidders']=$bidders;
                // dd($tenderArray[$i]['projectCount']);
                
                $projectCount=0; $j=0;
                $avgCostPPA=$countCostPPA=0;$costArrayPPA=array(0);
                $avgCostPSA=$countCostPSA=0;$costArrayPSA=array(0);
                

                foreach($bidders as $bid){
                    $m=0;
                    $projects=SelectedBidderProject::getProjectDetailForTender($bid['tender_id'],$bid['bidder_id']);
                    
                    $tenderArray[$i]['bidders'][$j]['bidderCount']=SelectedBidderProject::where('tender_id',$data['tid'])->where('bidder_id',$bid['bidder_id'])->count();
                    
                    foreach($projects as $pr){
                        
                        $tenderArray[$i]['bidders'][$j]['projects']=$projects;
                        $tenderArray[$i]['bidders'][$j]['village_id']=$projects[$m]['village_id'];
                        $tenderArray[$i]['bidders'][$j]['sub_district_id']=$projects[$m]['sub_district_id'];
                        $tenderArray[$i]['bidders'][$j]['district_id']=$projects[$m]['district_id'];
                        $tenderArray[$i]['bidders'][$j]['lat']=$projects[$m]['lat'];
                        $tenderArray[$i]['bidders'][$j]['lng']=$projects[$m]['lng'];
                        $tenderArray[$i]['bidders'][$j]['loa_date']=$projects[$m]['loi_loa_date'];
                        
                        
                        $tenderArray[$i]['bidders'][$j]['state']=$projects[$m]['state'];
                        
                        
                        $tenderArray[$i]['bidders'][$j]['schedule_commissiong_date']=$projects[$m]['schedule_commissiong_date'];
                        $tenderArray[$i]['bidders'][$j]['revised_schedule_commissiong_date']=$projects[$m]['revised_schedule_commissiong_date'];
                        $tenderArray[$i]['bidders'][$j]['commissioned_capacity']=$projects[$m]['commissioned_capacity'];
                        
                        $tenderArray[$i]['bidders'][$j]['actual_commissiong_date']=Commissioning::select('actual_commissiong_date')->where('project_id',$pr['id'])->get();
                        // $projects[$m]['actual_commissiong_date'];
                        $tenderArray[$i]['bidders'][$j]['actual_commissioned_capacity']=Commissioning::select('actual_commissioned_capacity')->where('project_id',$pr['id'])->get();
                        // $projects[$m]['actual_commissioned_capacity'];

                        // PSA
                        $tenderArray[$i]['bidders'][$j]['ppa_psa_date']=$projects[$m]['ppa_psa_date'];
                        $tenderArray[$i]['bidders'][$j]['ppa_psa_capacity']=$projects[$m]['ppa_psa_capacity'];
                        $tenderArray[$i]['bidders'][$j]['ppa_psa_signed_state']=$projects[$m]['ppa_psa_signed_state'];
                        $tenderArray[$i]['bidders'][$j]['discom_name']=$projects[$m]['discom_name'];
                        $tenderArray[$i]['bidders'][$j]['electricity_per_unit_cost']=$projects[$m]['electricity_per_unit_cost'];
                        $tenderArray[$i]['bidders'][$j]['duration_ppa']=$projects[$m]['duration_ppa'];
                        

                        // PPA
                        $tenderArray[$i]['bidders'][$j]['ppa_date']=$projects[$m]['ppa_date'];
                        $tenderArray[$i]['bidders'][$j]['ppa_capacity']=$projects[$m]['ppa_capacity'];
                        $tenderArray[$i]['bidders'][$j]['ppa_electricity_per_unit_cost']=$projects[$m]['ppa_electricity_per_unit_cost'];
                        $tenderArray[$i]['bidders'][$j]['duration_psa']=$projects[$m]['duration_psa'];
                        
                        
                        // Commissioned Details

                        $tenderArray[$i]['bidders'][$j]['commissioned_details']=json_decode($projects[$m]['commissioned_details'],true);
                        

                        
                        if($pr['electricity_per_unit_cost']!=null){ //PSA
                            $avgCostPSA+=$pr['electricity_per_unit_cost'];
                            $countCostPSA+=1;
                            $costArrayPSA[]=$pr['electricity_per_unit_cost'];
                        }

                        if($pr['ppa_electricity_per_unit_cost']!=null){
                            $avgCostPPA+=$pr['ppa_electricity_per_unit_cost'];
                            $countCostPPA+=1;
                            $costArrayPPA[]=$pr['ppa_electricity_per_unit_cost'];
                        }
                    }
                    
                    
                    $tenderArray[$i]['costMinPSA']=min($costArrayPSA);
                    $tenderArray[$i]['costMaxPSA']=max($costArrayPSA);
                    $tenderArray[$i]['costMinPPA']=min($costArrayPPA);
                    $tenderArray[$i]['costMaxPPA']=max($costArrayPPA);
                    
                $j++;
                }
            //    dd($tenderArray[$i]['costMinPSA'].'--'.$avgCostPPA.'---'.$countCostPPA);
               
               
               $tenderArray[$i]['avgCostPPA']=0;
               $tenderArray[$i]['avgCostPSA']=0;
               if($countCostPPA>0){
                $tenderArray[$i]['avgCostPPA']=$avgCostPPA/$countCostPPA;
               }
               if($countCostPSA>0){
                $tenderArray[$i]['avgCostPSA']=$countCostPSA/$countCostPSA;
               }
                
                

                $tenderArray[$i]['village_id']=$tenderArray[$i]['bidders'][0]['projects'][0]['village_id'];
                $tenderArray[$i]['sub_district_id']=$tenderArray[$i]['bidders'][0]['projects'][0]['sub_district_id'];
                $tenderArray[$i]['district_id']=$tenderArray[$i]['bidders'][0]['projects'][0]['district_id'];
                $tenderArray[$i]['lat']=$tenderArray[$i]['bidders'][0]['projects'][0]['lat'];
                $tenderArray[$i]['lng']=$tenderArray[$i]['bidders'][0]['projects'][0]['lng'];
                $tenderArray[$i]['bidder_name']=$tenderArray[$i]['bidders'][0]['bidder_name'];
                $tenderArray[$i]['bidder_capacity']=$tenderArray[$i]['bidders'][0]['capacity'];
                $tenderArray[$i]['loa_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['loi_loa_date'];
                
                $tenderArray[$i]['state']=$tenderArray[$i]['bidders'][0]['projects'][0]['state'];
                
                $tenderArray[$i]['schedule_commissiong_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['schedule_commissiong_date'];
                $tenderArray[$i]['revised_schedule_commissiong_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['revised_schedule_commissiong_date'];
                $tenderArray[$i]['commissioned_capacity']=$tenderArray[$i]['bidders'][0]['projects'][0]['commissioned_capacity'];
                
                // $tenderArray[$i]['actual_commissiong_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['actual_commissiong_date'];
                // $tenderArray[$i]['actual_commissioned_capacity']=$tenderArray[$i]['bidders'][0]['projects'][0]['actual_commissioned_capacity'];
                $tenderArray[$i]['actual_commissiong_date']=Commissioning::select('actual_commissiong_date')->where('project_id',$tenderArray[$i]['bidders'][0]['projects'][0]['id'])->get();
                $tenderArray[$i]['actual_commissioned_capacity']=Commissioning::select('actual_commissioned_capacity')->where('project_id',$tenderArray[$i]['bidders'][0]['projects'][0]['id'])->get();

                // PSA
                $tenderArray[$i]['ppa_psa_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_psa_date'];
                $tenderArray[$i]['ppa_psa_capacity']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_psa_capacity'];
                $tenderArray[$i]['discom_name']=$tenderArray[$i]['bidders'][0]['projects'][0]['discom_name'];
                $tenderArray[$i]['electricity_per_unit_cost']=$tenderArray[$i]['bidders'][0]['projects'][0]['electricity_per_unit_cost'];
                $tenderArray[$i]['duration_ppa']=$tenderArray[$i]['bidders'][0]['projects'][0]['duration_ppa'];
                $tenderArray[$i]['ppa_psa_signed_state']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_psa_signed_state'];

                // PPA
                $tenderArray[$i]['ppa_date']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_date'];
                $tenderArray[$i]['ppa_capacity']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_capacity'];
                $tenderArray[$i]['ppa_electricity_per_unit_cost']=$tenderArray[$i]['bidders'][0]['projects'][0]['ppa_electricity_per_unit_cost'];
                $tenderArray[$i]['duration_ppa']=$tenderArray[$i]['bidders'][0]['projects'][0]['duration_ppa'];

                // Commissioned Details
                $tenderArray[$i]['commissioned_details']=json_decode($tenderArray[$i]['bidders'][0]['projects'][0]['commissioned_details'],true);

                $tenderArray[$i]['project_count']=SelectedBidderProject::where('tender_id',$data['tid'])->where('bidder_id',$tenderArray[$i]['bidders'][0]['bidder_id'])->count();
                
                $tenderArray[$i]['project_count_data']=array();
                if($tenderArray[$i]['project_count']>1){
                    $tenderArray[$i]['project_count_data']=SelectedBidderProject::getProjectDetailForTender($tenderArray[$i]['bidders'][0]['tender_id'],$tenderArray[$i]['bidders'][0]['bidder_id']);
                    // dd($tenderArray[$i]['project_count_data']);
                }
                $i++;
            }
            // dd($tenderArray);
            $returnHTML = view('backend.state-implementing-agency._excelCommissionedReport',compact('tenderArray','userdata'))->render();
            return response()->json(['status' => 'success','result'=>$returnHTML]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function getSPDByAgencyData($id,$spd_id){
        $spdData=SPD::where('agency_id',$id)->get();
        if (!$spdData->isEmpty()) {
            try {
                
                $result='<select name="agency_sub_id" id="agency_sub_id" class="form-control">';
                foreach($spdData as $spd){
                    $sl_vaue='';
                    if($spd_id>0 && $spd_id==$spd->id){
                        $sl_vaue='selected';
                    }
                    $result.='<option value="'.$spd->id.'" '.$sl_vaue.'>'.$spd->agency_name.'</option>';
                }
                $result.='</select>';
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            return response()->json(['status' => 'success','result'=>$result]);
        }
        return response()->json(['status' => 'error','message'=>'SPD Not Found!']);
    }

    public function getProjectListData($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderProjectData($id,$tender_id);
        
        $result='';
        if($selectedBidderProjectData->isNotEmpty()){
            $i=0;
            $result='<option value="">Choose Project</option>';
            foreach($selectedBidderProjectData as $data){$i++;
                $result.='<option value="'.$data->id.'">'.$data->project_title.'</option>';
            }
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            $result.='<h3 class="text-danger">Please add Project Location Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
    }
    public function getCommissionDetails($project_id){
        $getProjectData=Commissioning::getProjectDataById($project_id);
        // dd($getProjectData);
        $result='';$i=0;
        if($getProjectData['commissioned_data_count']>0){
            $result.='<table class="table table-bordered" id="ppaTbale">
                <thead>
                <tr class="bg-primary text-light">
                    <th colspan="6">
                        <h4>Tender Commissioning Details</h4>
                    </th>
                    </tr>
                    </thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Scheduled commissioning Date (as per PPA)</th>
                        <th>Scheduled commissioning Date (Revised/ extended)</th>
                        <th>Commissioned Capacity (MW)</th>
                        <th>Actual Commissioning Date</th>
                        <th>Actual commissioned Capacity (MW)</th>
                    </tr>
                    
                    <tbody class="text-center">
                    ';
                    foreach($getProjectData['commissioned_data'] as $gpData){$i++;
                        $revised_schedule_commissiong_date='NA';
                        if(!empty($getProjectData["data"]["revised_schedule_commissiong_date"])){
                            $revised_schedule_commissiong_date=$this->dateFormat($getProjectData["data"]["revised_schedule_commissiong_date"]);
                        }
                        if($i==1){
                            $result.='<tr>
                                <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$getProjectData["data"]["project_title"].'</td>
                                <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$this->dateFormat($getProjectData["data"]["schedule_commissiong_date"]).'</td>
                                <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$revised_schedule_commissiong_date.'</td>
                                <td rowspan="'.$getProjectData['commissioned_data_count'].'">'.$getProjectData["data"]["commissioned_capacity"].'</td>
                                <td>'.$this->dateFormat($gpData["actual_commissiong_date"]).'</td>
                                <td>'.$gpData["actual_commissioned_capacity"].'</td>
                            </tr>';
                        }else{
                            $result.='<tr>
                                <td>'.$this->dateFormat($gpData["actual_commissiong_date"]).'</td>
                                <td>'.$gpData["actual_commissioned_capacity"].'</td>
                            </tr>';
                        }
                    }
                    $result.='</tbody></table>
                    ';
            return response()->json(['status' => 'success','result'=>$result]);
        }else{
            return response()->json(['status' => 'error']);
        }
    }
}   