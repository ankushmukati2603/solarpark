<?php

namespace App\Http\Controllers\Backend\SECI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\General;
use App\Models\ProgressReport;
use App\Models\State;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\Village;
use App\Models\AuditTrail;
use DB, URL, Auth, Hash, Storage, Validator, Config;

class MainController extends Controller
{
    //
    use General;
    
    public function dashboard(){
        $auditData = array('action_type'=>'1','description'=>'SECI view Dashboard','user_type'=>'6');
        $this->auditTrail($auditData);
        return view('backend.seci.dashboard');
    }
    public function solarParkApplications(){
        $applicationDetail=ProgressReport::getReportForMnreUsers();
        //$developerDetail=Beneficiary::All();
        $auditData = array('action_type'=>'1','description'=>'SECI view Solar Park Applications','user_type'=>'6');
        $this->auditTrail($auditData);
        return view('backend.seci.parkAppList',compact('applicationDetail'));
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
        $auditData = array('action_type'=>'1','description'=>'SECI view Preview Progress Report','user_type'=>'6');
        $this->auditTrail($auditData);
        // $previousprogressReport=ProgressReport::select($type)->where('month',($month-1))->where('year',$year)->where('user_id',Auth::id())->first();
        return view('backend.seci.previewProgressReport',compact('progressDetailspreview','previewData','id'));
    }

    public function seciRemark(Request $request){

        $validation = Validator::make($request->all(), [
        'status'=>'required',
        'seciRemark'=>'required',
        
        ]);
        if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            return response()->json(['status'=>'verror','data'=>$validation->errors()]);
        }
        if($request->editId){
            $data= ProgressReport::where('id',$request->editId)->update([
                'seci_status'=>$request->input('status'),
                'seci_remarks'=>$request->input('seciRemark'),
            ]);
            $auditData = array('action_type'=>'3','description'=>'SECI Update Report Status and Remark','user_type'=>'6'); $this->auditTrail($auditData);
            $url = urlencode('/'.Auth::getDefaultDriver().'/solar_park_applications');
            return response()->json(['status' => 'success','message'=>'Remark save successfuly!','url'=>$url,'redirect'=>'yes']);
        }

    }





}