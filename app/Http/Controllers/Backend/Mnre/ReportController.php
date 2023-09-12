<?php

namespace App\Http\Controllers\Backend\Mnre;

use Illuminate\Http\Request;

use App\Models\State;
use App\Models\Mnre;
use App\Models\Program;
use App\Traits\General;
use App\Models\District;
use App\Models\SubDistrict;
use App\Models\Village;
use App\Models\ReiaReport;
use App\Models\ProgressReport;
use App\Models\StuReport;
use App\Models\Tenders;
use App\Models\SelectedBidderProject;
use App\Models\Commissioning;
use App\Models\SelectedBidder;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use DB, URL, Auth, Hash, Storage, Validator, Config, Log;
class ReportController extends Controller
{
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
        //dd(Auth::user());
    }
    
    // SPPD Reports
    public function solarParkProgressReport(Request $request){
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
            $progressData=$reportQuery->paginate(20);
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
                return view('backend.mnre.solarParkReport.solarParkProgressReport',compact('progressDetails','states'));
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
        $states = State::orderby('name')->get();
        return view('backend.mnre.solarParkReport.solarParkProgressReport',compact('progressDetails','states'));
    }
    public function previewSolarParkProgressReport(Request $request , $id){
        $id=$this->decodeid($id);
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
        // dd($previewData);
        // $previousprogressReport=ProgressReport::select($type)->where('month',($month-1))->where('year',$year)->where('user_id',Auth::id())->first();
        return view('backend.mnre.SolarParkReport.solarParkProgressReportPreview',compact('progressDetailspreview','previewData','id'));
    }
    public function mnreRemarkSolarPark(Request $request){

        $validation = Validator::make($request->all(), [
        'status'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
        'mnreremarks'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        try {
            //code...
            if($request->editId){
                $id=$this->decodeid($request->editId);
                $data= ProgressReport::where('id',$id)->update([
                    'status'=>$request->input('status'),
                    'remarks'=>$request->input('mnreremarks'),
                ]);
                $auditData = array('action_type'=>'3','description'=>'MNRE Update Progress Report Status and Remark','user_type'=>'1'); $this->auditTrail($auditData);
                $url = urlencode('/'.Auth::getDefaultDriver().'/solar-park-reports');
                return response()->json(['status' => 'success','message'=>'Remark saved successfuly!','url'=>$url,'redirect'=>'yes']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th->getMessage());
            return response()->json(['status' => 'ExError','message'=>$th->getMessage()]);
        }
        

    }

    // REIA Reports
    public function reiaReports(Request $request){
        $from_date = NULL; $to_date = NULL;$state_id = NULL;$district_id = NULL;$tender_date = NULL;$scheme_name = NULL;$filters=[];
        if ($request->isMethod('post')) {
            if(!empty($request->filter['from_date'])) $from_date = $request->filter['from_date'];
            if(!empty($request->filter['to_date'])) $to_date = $request->filter['to_date'];
            if(!empty($request->filter['state_id'])) $state_id = $request->filter['state_id'];
            if(!empty($request->filter['district_id'])) $district_id = $request->filter['district_id'];
            if(!empty($request->filter['tender_date'])) $tender_date = $request->filter['tender_date'];
            if(!empty($request->filter['scheme_name'])) $scheme_name = $request->filter['scheme_name'];
            //$filters = $request->filter;

            $query = ReiaReport::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name');

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
            return view('backend.mnre.ReiaReport.progressReport', compact('progressDetails', 'states','schemes'));
            // dd($progressData);
        }
        $reiaProgressReportData = ReiaReport::getAllReiaReport();
        $auditData = array('action_type' => '1', 'description' =>'REIA User Visit Progress Report Page', 'user_type' => '7');
        $this->auditTrail($auditData);
        $states = State::orderby('name')->get();
        $schemes = DB::table('schemes')->where('status', 1)->get();
        return view('backend.mnre.ReiaReport.progressReport', compact('reiaProgressReportData', 'states','filters','schemes'));
    }
    public function reiareportpreview($id){
        $reia_id =  $this->decodeid($id);
        $reiaData=ReiaReport::getReiaReportById($reia_id);
        $data = array(); 
        if ($reiaData) {
            $data=$reiaData;
            $data['bidder_id'] = json_decode($reiaData->bidder_id, true);
            $data['select_bidders_capacity'] = json_decode($reiaData->select_bidders_capacity, true);
            $data['ppa_date'] = json_decode($reiaData->ppa_date, true);
            $data['ppa_capacity'] = json_decode($reiaData->ppa_capacity, true);
        }
        return view('backend.mnre.ReiaReport.PreviewReiaReport',compact('data'));
    }
    public function mnreRemarkReia(Request $request){

        $validation = Validator::make($request->all(), [
            'mnre_status'=>'required',
            'mnre_remarks'=>'required',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        if($request->editId){
            $id=$this->decodeid($request->editId);
            $data= ReiaReport::where('id',$id)->update([
                'mnre_status'=>$request->input('status'),
                'mnre_remarks'=>$request->input('mnre_remarks'),
            ]);
            $auditData = array('action_type'=>'3','description'=>'MNRE Update REIA Report Status and Remarks','user_type'=>'1'); $this->auditTrail($auditData);
            $url = urlencode('/'.Auth::getDefaultDriver().'/Reia-Reports');
            return response()->json(['status' => 'success','message'=>'Remark saved successfuly!','url'=>$url,'redirect'=>'yes']);
        }

    }

    // STu-CTU Report

    public function stuReports(Request $request){ 

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
        $auditData = array('action_type'=>'1','description'=>'GEC User Visit Progress Report Page','user_type'=>'1');
        $this->auditTrail($auditData);
        $states = State::orderby('name')->get();

        // $progressDetails=array();
        $stuReportDetails=StuReport::getAllStuReports();
        return view('backend.mnre.StuReport.ProgressReport',compact('stuReportDetails','states'));
    }
    public function stureportpreview($id){
        try {
            //code...
            $stu_id =  $this->decodeid($id);
            $stuData=StuReport::getStuReportById($stu_id);
            // dd($stuData);
            return view('backend.mnre.StuReport.PreviewStuProgressReport',compact('stuData'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }

    public function mnreRemarkStu(Request $request){
        $validation = Validator::make($request->all(), [
            'mnre_status'=>'required',
            'mnre_remark'=>'required',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        try {
            //code...
            if($request->editId){
                $id=$this->decodeid($request->editId);
                $data= StuReport::where('id',$id)->update([
                    'mnre_status'=>$request->input('status'),
                    'mnre_remark'=>$request->input('mnre_remark'),
                ]);
                $auditData = array('action_type'=>'3','description'=>'MNRE Update STU/CTU Report Status and Remarks','user_type'=>'1'); $this->auditTrail($auditData);
                $url = urlencode('/'.Auth::getDefaultDriver().'/Stu-Reports');
                return response()->json(['status' => 'success','message'=>'Remark saved successfuly!','url'=>$url,'redirect'=>'yes']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            Log::info($th->getMessage());
            return response()->json(['status' => 'ExError','message'=>$th->getMessage()]);
        }
        
    }


    // SNA Report

    public function snaReports(Request $request){ 
        
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
        $auditData = array('action_type'=>'1','description'=>'MNRE User Visit Progress Report Page','user_type'=>'1');
        $this->auditTrail($auditData);
        $snaReportDetails=Tenders::where('tender_status',4)->orderby('entry_date','DESC')->paginate(20);
        return view('backend.mnre.SnaReport.snaProgressReport',compact('snaReportDetails'));
    }

    public function snareportpreview($id){
        try {
            //code...
            $tender_id =  $this->decodeid($id);
            $tender=Tenders::getTenderDetailsById($tender_id);
            $bidderProjectLocationData=SelectedBidderProject::getSelectedBidderProjectDetails($tender_id);
            $commissioningData=Commissioning::getCommissionedDataByTenderId($tender_id);
            $selectedBidderData=SelectedBidder::getSelectedBidderDetails($tender_id);
            // dd($selectedBidderData);
            return view('backend.mnre.SnaReport.PreviewSnaProgressReport',compact('tender','selectedBidderData','bidderProjectLocationData','commissioningData','tender_id'));
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            // return response()->json(['status' => 'ExError','message'=>$th->getMessage()]);
        }
        
    }

    public function mnreRemarkSna(Request $request){
        $validation = Validator::make($request->all(), [
            'mnre_status'=>'required',
            'mnre_remarks'=>'required',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        try {
            //code...
            if($request->editId){
                $id=$this->decodeid($request->editId);
                $data= Tenders::where('id1',$id)->update([
                    'mnre_status'=>$request->input('mnre_status'),
                    'mnre_remarks'=>$request->input('mnre_remarks'),
                ]);
                $auditData = array('action_type'=>'3','description'=>'MNRE Update SNA Report Status and Remarks','user_type'=>'1'); $this->auditTrail($auditData);
                $url = urlencode('/'.Auth::getDefaultDriver().'/Sna-Reports');
                return response()->json(['status' => 'success','message'=>'Remark saved successfuly!','url'=>$url,'redirect'=>'yes']);
            }
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return response()->json(['status' => 'ExError','message'=>$th->getMessage()]);

        }
        
    }




}