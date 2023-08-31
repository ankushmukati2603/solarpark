<?php

namespace App\Http\Controllers\Backend\SNA;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Program;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\District;
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
use App\Http\Controllers\Controller;
use App\Utils\Dictionary;
use App\Utils\Dashboard;
use App\Utils\FormValidator;
use App\Utils\EmailSmsNotifications;
use DB, URL, Auth, Hash, Storage, Config, Gate,Validator;

class MainController extends Controller
{
    use General;

    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    public function index()
    {
        $dashboard = new Dashboard();
        $data = $dashboard->getSIADashboardData();
        /*************************Audit Trail Start**********************************/
        $auditData = array('action_type'=>'1','description'=>'SNA viewed Dashboard  ','user_type'=>'2');
        $this->auditTrail($auditData);
        /*************************Audit Trail Start**********************************/
        return view('backend.state-implementing-agency.dashboard', compact('data'));
    }
    public function recievedProgressReport(Request $request){
        if($request->isMethod('post')){
            $fromdata=$request->input('date');
            $todata=$request->input('date');
            $state=$request->input("state");
            $district=$request->input("district_id");
            $agency_name=$request->input("agency_name");
            // $capacity=$request->input("capacity");
            $solarPowerprogressDetails=array();
            $i=0;
            $progressData= solarPowerReport::whereBetween('submitted_on', [$fromdata.' 00:00:00' , $todata.' 23:59:59'])
            ->orWhere('state',$state)->orWhere('district',$district)
            ->orWhere('agency_name', 'like', '%' . $agency_name. '%')
            ->orWhere('email', $request->input('email'))
            ->orderBy("submitted_on",'DESC')->get()->toArray();
                foreach($progressData as $data){$i++;
                    if($data['final_submission']==1){
                        $decodeData=json_decode($data['general'],true);
                        $solarPowerprogressDetails[$i] = $data;
                        $solarPowerprogressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                        $solarPowerprogressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                    }
                }
                $auditData = array('action_type'=>'1','description'=>'SNA Search Progress Report Data','user_type'=>'0');
                $this->auditTrail($auditData);
                $states = State::orderby('name')->get();
                // dd($solarPowerprogressDetails);
                return view('backend.state-implementing-agency.recievedProgressReport',compact('solarPowerprogressDetails','states'));
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit  Recieved Progress Report Page','user_type'=>'0');
        $this->auditTrail($auditData);
        $solarPowerprogressDetails=array();
            $states = State::orderby('name')->get();
        return view('backend.state-implementing-agency.recievedProgressReport',compact('solarPowerprogressDetails','states'));
    }
    public function solarPowerReport(Request $request, $id=NULL){
        
        if($request->isMethod('post'))
        {
            //dd($request);
            if($request->type =='general'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'agency_name'=>'required|max:75',
                'state'=>'required',
                'contact_person_name'=>'required',
                'email'=>'required',
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
                    $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Tender Data','user_type'=>'0'); $this->auditTrail($auditData);
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
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Reverse Auction Data','user_type'=>'0'); $this->auditTrail($auditData);
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
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Cancelled Tenders Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='selectedBidders'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'company_name'=>'required',
                'select_bidders_capacity'=>'required',
                'loi_loa_date'=>'required',
                
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $selectedBiddersdata=array();
                $selectedBiddersdata['company_name']=$request->company_name;
                $selectedBiddersdata['select_bidders_capacity']=$request->select_bidders_capacity;
                $selectedBiddersdata['loi_loa_date']=$request->loi_loa_date;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'selected_bidders'=>$selectedBiddersdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Select Bidders Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='discoveredTariffs'){
                // dd($request);
                $validation = Validator::make($request->all(), [
                'highest_tariff'=>'required',
                'lowest_tariff'=>'required',
                'weighted_average'=>'required',
                
                ]
                );
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $discoveredTariffsdata=array();
                $discoveredTariffsdata['highest_tariff']=$request->highest_tariff;
                $discoveredTariffsdata['lowest_tariff']=$request->lowest_tariff;
                $discoveredTariffsdata['weighted_average']=$request->weighted_average;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'discovered_tariff'=>$discoveredTariffsdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Discovered Tariffs Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
                }      
            }
            if($request->type =='signingOfPPAPSA'){
                // dd($request);
                $validation = Validator::make($request->all(), [
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
                $signingOfPPAPSAdata=array();
                $signingOfPPAPSAdata['ppa_psa_date']=$request->ppa_psa_date;
                $signingOfPPAPSAdata['ppa_psa_capacity']=$request->ppa_psa_capacity;
                $signingOfPPAPSAdata['ppa_psa_state_name']=$request->ppa_psa_state_name;
                $signingOfPPAPSAdata['ppa_signed_discom_name']=$request->ppa_signed_discom_name;
                $signingOfPPAPSAdata['ppa_electricity_unit']=$request->ppa_electricity_unit;
                $signingOfPPAPSAdata['ppa_duration']=$request->ppa_duration;
                if($request->editId){
                    solarPowerReport::where('id',$request->editId)->update([
                    'signing_of_ppa_psa'=>$signingOfPPAPSAdata,
                    ]);
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Signing of PPA/PSA Data','user_type'=>'0'); $this->auditTrail($auditData);
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
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Commissioning Data','user_type'=>'0'); $this->auditTrail($auditData);
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
                    ]);
                    $url=urlencode('/solarpark/state-implementing-agency/recieved-progress-report');
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Additional Information Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
                }      
            }
        }
        $auditData = array('action_type'=>'1','description'=>'SNA view all page','user_type'=>'0');
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
            // $states = State::All();
            return view('backend.state-implementing-agency.solar_power.progressReport',compact('states','id','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        } 
        // $states = State::All();
        // return view('backend.state-implementing-agency.solar_power.progressReport',compact('states','id'));
    }
        public function selectreporttype(Request $request){
            if($request->isMethod('post')){
                // dd($request);
                $month=$request->month;
                $year=$request->year;
                $existingProgressData=solarPowerReport::select('*')->where('sna_id', Auth::id())->where('developer_id',$request->developer)->where('month', $month)
                ->where('year',$year)->where('report_type',$request->report_type)->first();
                if($existingProgressData!=null){
                    if($existingProgressData->final_submission==1){
                        return redirect()->back()->with("error",'Report Already Submitted for this Month');
                    }
                    if($request->report_type=='1'){
                    return redirect(Auth::getDefaultDriver().'/solar-Power-Report/'.$existingProgressData->id);
                    }elseif($request->report_type=='2'){
                        return redirect('/'.Auth::getDefaultDriver().'/solarpower-under-implementation/'.$existingProgressData->id); 
                    }else{
                        if($request->report=='rooftop_report'){
                            return redirect('/'.Auth::getDefaultDriver().'/solar-rooftop-Report/'.$existingProgressData->id);
                        }
                        return redirect('/'.Auth::getDefaultDriver().'/solar-Power-commissioning-Report/'.$existingProgressData->id);   
                    }
                }
                $newProgressData=new solarPowerReport();
                $newProgressData->month=$request->month;
                $newProgressData->year=$request->year;
                $newProgressData->developer_id=$request->developer;
                $newProgressData->report_type=$request->report_type;
                $newProgressData->sna_id=Auth::id();
                $newProgressData->save();
                $id=$newProgressData->id;
                if($request->report_type=='1'){
                    return redirect('/'.Auth::getDefaultDriver().'/solar-Power-Report/'.$id);
                }elseif($request->report_type=='2'){
                    return redirect('/'.Auth::getDefaultDriver().'/solarpower-under-implementation/'.$id); 
                }else{
                    // dd($request->report);
                    if($request->report=='rooftop_report'){
                        return redirect('/'.Auth::getDefaultDriver().'/solar-rooftop-Report/'.$id);
                    }
                        return redirect('/'.Auth::getDefaultDriver().'/solar-Power-commissioning-Report/'.$id);
                    
                       
                }
            }
            $developer=Developer::all();
            return view('backend.state-implementing-agency.reportType',compact('developer'));
        }

        /************************roushan*************** */
        public function developermaster(Request $request, $id=null){
            if($request->isMethod('post')){
                //dd($request);
                $validation = Validator::make($request->all(), [
                    'name'=>'required',
                    'address'=>'required',
                    'email'=>'required',
                    'contact_no'=>'required',
                    'state_id'=>'required',
                    'address'=>'required',
                    'district_id'=>'required',
                    'sub_district_id'=>'required',
                    'village'=>'required',
                ]);
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
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
                    $url=urlencode('/solarpark'.'/'.Auth::getDefaultDriver().'/developer-list');
                    return response()->json(['status' => 'success','message'=>'Developer saved successfuly!','url'=>$url,'redirect'=>'yes']);
                   
                } catch (\Throwable $th) {
                        //throw $th;
                        dd($th->getMessage());
                }
            }  
            $developerdetails=array();
            if($id){
                $developerdetails=Developer::select('*')->where('id',$id)->first();
            }
            $district_id=District::orderby("name")->get();  
            $states=State::orderby("name")->get();
            // $states = State::All();
            $userDetail=Developer::where('sna_id',Auth::user()->id)->get();
         
            return view('backend.state-implementing-agency.masterDeveloper',compact('states', 'district_id','id', 'userDetail','developerdetails'));
        }
        public function developerList(){
            $userDetail=Developer::where('sna_id',Auth::user()->id)->get();
            return view('backend.state-implementing-agency.developerList',compact('userDetail'));
        }
        public function solarPowerCommissioningReport(){
            // $states = State::all();
            $states=State::orderby("name")->get();
            return view('backend.state-implementing-agency.commisioning.commisioningReport',compact('states'));
        }
        public function solarPowerunderImplementationReport(Request $request , $id=NULL){
            // dd($request);
            if($request->isMethod('post'))
            {
               
                if($request->type =='general'){
                    // dd($request);
                    $validation = Validator::make($request->all(), [
                    'developer_name'=>'required|max:75',
                    'head_name'=>'required',
                    'ceo_name'=>'required',
                    'office_address'=>'required|max:500',
                    'contact_number'=>'required',
                    'mobile_number'=>'required|max:10|min:10',
                    'email'=>'required',
                    'project_capacity'=>'required',
                    'inside_solar_park'=>'required',
                    ]
                    );
                    if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                        return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                    }
                    $generaldata=array();
                    $generaldata['developer_name']=$request->developer_name;
                    $generaldata['head_name']=$request->head_name;
                    $generaldata['ceo_name']=$request->ceo_name;
                    $generaldata['office_address']=$request->office_address;
                    $generaldata['contact_number']=$request->contact_number;
                    $generaldata['mobile_number']=$request->mobile_number;
                    $generaldata['email']=$request->email;
                    $generaldata['project_capacity']=$request->project_capacity;
                    $generaldata['inside_solar_park']=$request->inside_solar_park;
                    // dd($generaldata);
                    if($request->editId){
                        // dd($request->editId);
                        solarPowerReport::where('id',$request->editId)->update([
                        'general'=>$generaldata,
                        'email'=>$request->email, ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                    'latitude'=>'required',
                    'longitude'=>'required',
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
                    // dd($generaldata);
                    if($request->editId){
                        // dd($request->editId);
                        solarPowerReport::where('id',$request->editId)->update([
                        'project_location'=>$projectLocationdata,
                        'email'=>$request->email,
                        'state'=>$request->state,
                        'district'=>$request->district_id ]);
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 

                    }      
                }
                if($request->type =='status'){
                    // dd($request);
                    $validation = Validator::make($request->all(), [
                    'voltage_level'=>'required',
                    'stage2_status'=>'required',
                    'lta_status'=>'required',
                    'ltoa_date'=>'required',
                    'sub_station_status'=>'required',
                   
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
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
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
                        'final_submission'=>1,
                        ]);
                        $url=urlencode('/solarpark/state-implementing-agency/recieved-progress-report');
                        $auditData = array('action_type'=>'3','description'=>'SNA Update General Details','user_type'=>'0'); $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>$url,'redirect'=>'yes']); 

                    }      
                }
            }
            $auditData = array('action_type'=>'1','description'=>'SNA view all page','user_type'=>'0');
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
                $generalData['date'] = json_decode($data->date, true);
                $generalData['status'] = json_decode($data->solar_project_status, true);
                $generalData['scheduled'] = json_decode($data->scheduled_transmission_date, true);
                $generalData['extendedDate'] = json_decode($data->extended_commissioning_date, true);
                $generalData['additional_information']=$data->additional_information;
                
               /****************************** code of json_decode************/
                $states=State::orderby("name")->get();
                // $states = State::All();
                return view('backend.state-implementing-agency.under_implementation.underImplementationReport',compact('states','id','generalData'));
            }else{
                return redirect()->back()->with("error",'Invalid Request');
            }
           
        }
        public function solarRooftopReport(Request $request, $id=NULL){
            if($request->isMethod('post')){
               
                $validation = Validator::make($request->all(), [
                    'financial_year'=>'required',
                    'gm_number'=>'required',
                    'gm_capacity'=>'required|max:500',
                    'consumer_number'=>'required',
                    'cunsumer_capacity'=>'required',
                    'fc_number'=>'required',
                    'fc_capacity'=>'required',
                    'ipds_number'=>'required',
                    'ipds_capacity'=>'required',
                    'sr_number'=>'required',
                    'sr_capacity'=>'required',
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
                $url=urlencode('/state-implementing-agency/recieved-progress-report');
                    $auditData = array('action_type'=>'3','description'=>'SNA Update Additional Information Data','user_type'=>'0'); $this->auditTrail($auditData);
                    return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
                // return redirect(Auth::getDefaultDriver().'/recieved-progress-report/');
                //return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
            }
            return view('backend.state-implementing-agency.commisioning.solarRooftopReport');
        }
    } 