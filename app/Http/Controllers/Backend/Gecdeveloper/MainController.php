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
use App\Models\Gecd;
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
        $auditData = array('action_type'=>'1','description'=>'User Visit Dashboard Page','user_type'=>'7');
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
           
                $validation = Validator::make($request->all(), [
                    'package_no'=>'required',
                    'package_name'=>'required|regex:/^[a-zA-Z ]+$/u',
                    'project_under_package'=>'required|regex:/^[a-zA-Z ]+$/u',
                    'project_type'=>'required|in:1,2,3,4,5,6|gte:0|lte:6',
                    'mnre_sanction_date'=>'required|before:yesterday',
                    'tender_notice_date'=>'required|before:yesterday',
                    'last_submission_date'=>'required|before:yesterday',
                    'technical_bid_opening_date'=>'required|before:yesterday',
                    'financial_bid_opening_date'=>'required|before:yesterday',
                    'award_package_date'=>'required|before:yesterday',
                    'comm_date_award_letter'=>'required|before:yesterday',
                    'dpr_cost'=>'required|lte:100|gte:0',
                    'awarded_cost'=>'required|lte:100|gte:0',
                    'physical_progess'=>'required|regex:/^[a-zA-Z ]+$/u',
                    'package_expenditure'=>'required|lte:100|gte:0',
                    'financial_progress'=>'required|lte:100|gte:0',
                    'land_detail'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                    'forest_clearance_details'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                ]);
                if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $generaldata=array();
               
                if($request->editId){
                    $final_submission=0;
                    $message="Details Saved Successfuly";
                            //condition m agr button per click krega to final submission 1 hoga
                    if($request->submit_type==1){
                        $final_submission=1;
                            // Final Submission button ki value hain  final_submission=name hai bustton ka
                        $message="Application Submitted";
                    } 
                    $generaldata=GecReport::findOrFail($request->editId);
                    $generaldata->package_no=$request->package_no;
                    $generaldata->package_name=$request->package_name;
                    $generaldata->project_under_package=$request->project_under_package;
                    $generaldata->project_type=$request->project_type;
                    $generaldata->financial_progress=$request->financial_progress;
                    $generaldata->mnre_sanction_date=$request->mnre_sanction_date;
                    $generaldata->tender_notice_date=$request->tender_notice_date;
                    $generaldata->last_submission_date=$request->last_submission_date;
                    $generaldata->technical_bid_opening_date=$request->technical_bid_opening_date;
                    $generaldata->financial_bid_opening_date=$request->financial_bid_opening_date;
                    $generaldata->award_package_date=$request->award_package_date;
                    $generaldata->comm_date_award_letter=$request->comm_date_award_letter;
                    $generaldata->dpr_cost=$request->dpr_cost;
                    $generaldata->awarded_cost=$request->awarded_cost;
                    $generaldata->physical_progess=$request->physical_progess;
                    $generaldata->package_expenditure=$request->package_expenditure;
                    $generaldata->land_detail=$request->land_detail;
                    $generaldata->forest_clearance_details=$request->forest_clearance_details;
                    $generaldata->remark=$request->remark;
                    $generaldata->final_submission=$final_submission;

                    $generaldata->save();
                    
                    $auditData = array('action_type'=>'3','description'=>'GEC User Submited GEC Progress Data','user_type'=>'7'); $this->auditTrail($auditData);
                    $url=urlencode('/'.Auth::getDefaultDriver().'/progress-report');
                    return response()->json(['status' => 'success','message'=>$message,'next'=>$request->next,'url'=>$url,'redirect'=>'yes']); 
                }  
        }
        $auditData = array('action_type'=>'1','description'=>'GEC User view Data','user_type'=>'7');
        $this->auditTrail($auditData);
        $generalData=array();
        $data= GecReport::where('id',$id)->where('user_id',Auth::id())->first();
        if($data){
            if($data->final_submission==1){
                $auditData = array('action_type'=>'1','description'=>'GEC User visit New Progress Report Page','user_type'=>'7');
                $this->auditTrail($auditData);
                return redirect()->back()->with('error', 'Report already submitted');   
                return redirect(Auth::getDefaultDriver().'/new-gec-progress-report');
            }
        }
        if($data!=null){
            $generalData= GecReport::where('user_id',Auth::id())->where('id',$id)->first();
            $auditData = array('action_type'=>'1','description'=>'GEC User view all Data','user_type'=>'7');
            $this->auditTrail($auditData);
            return view('backend.gecdeveloper.progress_report.progressReport' , compact('generalData','id'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        }   
    }
    public function newProgressReport(Request $request,$id=NULL){

        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'month'=>'required|gt:0|lte:12',
                'year'=>'required|gte:2005|lte:2023',
                'package_name'=>'required|regex:/^[a-zA-Z ]+$/u',
                'package_no'=>'required',
            ]);
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $month=$request->month;
            $year=$request->year;
            $package_no=$request->package_no;
            $package_name=$request->package_name;
            $existingGecData=GecReport::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->where('package_no',$package_no)->first();
            if($existingGecData!=null && $existingGecData->final_submission==1){
                return response()->json(['status' => 'error','message'=>'Gec Report Existing for this Month!','url'=>'']);
            }
            $newGecData=new GecReport();
            $newGecData->month=$month;
            $newGecData->year=$year;
            $newGecData->package_name=$request->package_name;
            $newGecData->package_no=$package_no;
            $newGecData->user_id=Auth::id();
            $newGecData->save();
            $id=$newGecData->id;
            $auditData = array('action_type'=>'2','description'=>'GEC User Insert New Progress Report Data','user_type'=>'7');
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/application/progress_report/'.$id);
            return response()->json(['status' => 'success','message'=>"Please wait...",'url'=>$url,'redirect'=>'yes']); 
            //return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        $packagenoDetail=GecReport::select('package_no','id')->get();
        $packagenameDetail=GecReport::select('package_name','id')->get();
        
        $auditData = array('action_type'=>'1','description'=>'GEC visit New Progress Report Page','user_type'=>'7');
        $this->auditTrail($auditData);
        return view('backend.gecdeveloper.progress_report.newProgressReport',compact('packagenameDetail','packagenoDetail'));
    }
    public function ProgressReport(Request $request){        
        if($request->isMethod('post')){
            $fromdata=$request->input('date');
            $todata=$request->input('date');
            $state=$request->input("state");
            $district=$request->input("district_id");
            $park_name=$request->input("park_name");
            $capacity=$request->input("capacity");
            $progressDetails=array();
            $progressDetails= GecReport::where('user_id',Auth::id())->orderBy("submitted_on",'DESC')->get()->toArray();
            
            $auditData = array('action_type'=>'1','description'=>'GEC User Search Progress Report Data','user_type'=>'7');
            $this->auditTrail($auditData);
            $states = State::orderby('name')->get();
            return view('backend.gecdeveloper.progress_report.ProgressReport',compact('progressDetails','states'));
        }
            $auditData = array('action_type'=>'1','description'=>'GEC User Visit Progress Report Page','user_type'=>'7');
            $this->auditTrail($auditData);
            $progressDetails=array();
            $states = State::orderby('name')->get();
        return view('backend.gecdeveloper.progress_report.myProgressReport',compact('progressDetails','states'));
    }

}


            