<?php

namespace App\Http\Controllers\Backend\Beneficiary;
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
        return view('backend.beneficiary.dashboard',compact('data'));
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
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
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
            if($request->type == 'internal_infrastructure'){
                $validation = Validator::make($request->all(), [
                // 'dpr_status'=>'required',
                'land_status_identified'=>'required',
                'land_status_aquired'=>'required',
                'govt_land_identified'=>'required',
                'govt_land_acquired'=>'required',
                'private_land_acquired'=>'required',
                'private_land_identified'=>'required',
                'others'=>'required',
                // 'internal_infrastructure_remarks'=>'max:500',
                'road_status'=>'required',
                'park_boundary'=>'required',
                'road_distance'=>'required',
                'work_status'=>'required|max:255',
                // 'road_remarks'=>'max:500',

                    // waterfacilities
                'source_water'=>'required',
                'required_water'=>'required|max:1000',
                'proposed_system'=>'required|max:255',
                'status'=>'required|max:255',
                // 'water_facility_remarks'=>'max:500',
                // drainage system
                'drainage_system_details'=>'required|max:1000',
                'tender_status'=>'required|max:255',
                'otherRemarks'=>'max:500',
                // fencing boundary
                'fencing_details'=>'required|max:1000',
                'fencing_status'=>'required|max:255',
                // 'otherRemark'=>'max:500',
                // telecommunication facilities
                'tele_facility_details'=>'required|max:1000',
                'tender_progress_status'=>'required|max:255',
                'telecomunication_remark'=>'max:500',
                ],
                [
                // 'internal_infrastructure_remarks.max'=>'The Remarks may not be greater than 500 characters',
                'road_status.required'=>'This fields are required',
                'park_boundary.required'=>'This fields are required',
                'road_distance.required'=>'This fields are required',
                'work_status.required'=>'This fields are required',
                'work_status.max'=>'The Status may not be greater than 255 characters',
                // 'road_remarks.max'=>'The Remarks may not be greater than 500 characters',
                    // waterfacilities
                'source_water.required'=>'This fields are required',
                'required_water.required'=>'This fields are required',
                'required_water.max'=>'This fields may not be greater than 1000 characters',
                'proposed_system.required'=>'This fields are required',
                'proposed_system.max'=>'This fields may not be greater than 255 characters',
                'status.required'=>'This fields are required',
                'status.max'=>'The Status may not be greater than 255 characters',
                // 'water_facility_remarks.max'=>'The Remarks may not be greater than 500 characters',
                    // drainage system
                'drainage_system_details.required'=>'This fields are required',
                'drainage_system_details.max'=>'The details may not be greater than 1000 characters',
                'tender_status.required'=>'This fields are required',
                'tender_status.max'=>'The Status may not be greater than 255 characters',
                // 'otherRemarks.max'=>'The Remarks may not be greater than 500 characters',
                    // fencing boundary
                'fencing_details.required'=>'This fields are required',
                'fencing_details.max'=>'This fields may not be greater than 1000 characters',
                'fencing_status.required'=>'This fields are required',
                'fencing_status.max'=>'This fields may not be greater than 255 characters',
                // 'otherRemark.max'=>'The Remarks may not be greater than 500 characters',
                    // telecommunication facilities
                'tele_facility_details.required'=>'This fields are required',
                'tele_facility_details.max'=>'This fields may not be greater than 1000 characters',
                'tender_progress_status.required'=>'This fields are required',
                'tender_progress_status.max'=>'The status may not be greater than 255 characters',
                'telecomunication_remark.max'=>'The Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                $internal_infrastructureData=array();
                // $internal_infrastructureData['dpr_status']=$request->dpr_status;
                $internal_infrastructureData['land_status_identified']=$request->land_status_identified;
                $internal_infrastructureData['land_status_aquired']=$request->land_status_aquired;
                $internal_infrastructureData['govt_land_identified']=$request->govt_land_identified;
                $internal_infrastructureData['govt_land_acquired']=$request->govt_land_acquired;
                $internal_infrastructureData['private_land_acquired']=$request->private_land_acquired;
                $internal_infrastructureData['private_land_identified']=$request->private_land_identified;
                // $internal_infrastructureData['others']=$request->others;
                $internal_infrastructureData['road_status']=$request->road_status;
                $internal_infrastructureData['park_boundary']=$request->park_boundary;
                $internal_infrastructureData['road_distance']=$request->road_distance;
                $internal_infrastructureData['work_status']=$request->work_status;
                // $roadData['road_remarks']=$request->road_remarks;
                    // waterfacilities
                $internal_infrastructureData['source_water']=$request->source_water;
                $internal_infrastructureData['required_water']=$request->required_water;
                $internal_infrastructureData['proposed_system']=$request->proposed_system;
                $internal_infrastructureData['status']=$request->status;
                // $waterFacilities['water_facility_remarks']=$request->water_facility_remarks;
                    // drainage system
                $internal_infrastructureData['drainage_system_details']=$request->drainage_system_details;
                $internal_infrastructureData['tender_status']=$request->tender_status;
                // $drainageFacility['otherRemarks']=$request->otherRemarks;
                // fencing boundary
                $internal_infrastructureData['fencing_details']=$request->fencing_details;
                $internal_infrastructureData['fencing_status']=$request->fencing_status;
                // $fencing['otherRemark']=$request->otherRemark;
                // telecommunication faciities
                $internal_infrastructureData['tele_facility_details']=$request->tele_facility_details;
                $internal_infrastructureData['tender_progress_status']=$request->tender_progress_status;
                $internal_infrastructureData['telecomunication_remark']=$request->telecomunication_remark;
                // dd($internal_infrastructureData);
                // $internal_infrastructureData['internal_infrastructure_remarks']=$request->internal_infrastructure_remarks;
                if($request->editId){
                    ProgressReport::where('id',$request->editId)->update(['internal_infrastructure'=>$internal_infrastructureData]);
                    $auditData = array('action_type'=>'3','description'=>'User Update Internal Infrastructure Data','user_type'=>'0');
                    $this->auditTrail($auditData); 
                    return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                }      
            }
            // if($request->type == 'road'){
            //     $validation = Validator::make($request->all(), [
            //     'road_status'=>'required',
            //     'park_boundary'=>'required',
            //     'road_distance'=>'required',
            //     'work_status'=>'required|max:255',
            //     'road_remarks'=>'max:500',

            //     waterfacilities
            //     'source_water'=>'required',
            //     'required_water'=>'required|max:1000',
            //     'proposed_system'=>'required|max:255',
            //     'status'=>'required|max:255',
            //     'water_facility_remarks'=>'max:500',
            //     drainage system
            //     'drainage_system_details'=>'required|max:1000',
            //     'tender_status'=>'required|max:255',
            //     'otherRemarks'=>'max:500',
            //     fencing boundary
            //     'fencing_details'=>'required|max:1000',
            //     'fencing_status'=>'required|max:255',
            //     'otherRemark'=>'max:500',
            //     telecommunication facilities
            //     'tele_facility_details'=>'required|max:1000',
            //     'tender_progress_status'=>'required|max:255',
            //     'telecomunication_remark'=>'max:500',
            //     ],
            //     [
            //     'road_status.required'=>'This fields are required',
            //     'park_boundary.required'=>'This fields are required',
            //     'road_distance.required'=>'This fields are required',
            //     'work_status.required'=>'This fields are required',
            //     'work_status.max'=>'The Status may not be greater than 255 characters',
            //     'road_remarks.max'=>'The Remarks may not be greater than 500 characters',
            //     waterfacilities
            //     'source_water.required'=>'This fields are required',
            //     'required_water.required'=>'This fields are required',
            //     'required_water.max'=>'This fields may not be greater than 1000 characters',
            //     'proposed_system.required'=>'This fields are required',
            //     'proposed_system.max'=>'This fields may not be greater than 255 characters',
            //     'status.required'=>'This fields are required',
            //     'status.max'=>'The Status may not be greater than 255 characters',
            //     'water_facility_remarks.max'=>'The Remarks may not be greater than 500 characters',
            //     drainage system
            //     'drainage_system_details.required'=>'This fields are required',
            //     'drainage_system_details.max'=>'The details may not be greater than 1000 characters',
            //     'tender_status.required'=>'This fields are required',
            //     'tender_status.max'=>'The Status may not be greater than 255 characters',
            //     'otherRemarks.max'=>'The Remarks may not be greater than 500 characters',
            //     fencing boundary
            //     'fencing_details.required'=>'This fields are required',
            //     'fencing_details.max'=>'This fields may not be greater than 1000 characters',
            //     'fencing_status.required'=>'This fields are required',
            //     'fencing_status.max'=>'This fields may not be greater than 255 characters',
            //     'otherRemark.max'=>'The Remarks may not be greater than 500 characters',
            //         telecommunication facilities
            //     'tele_facility_details.required'=>'This fields are required',
            //     'tele_facility_details.max'=>'This fields may not be greater than 1000 characters',
            //     'tender_progress_status.required'=>'This fields are required',
            //     'tender_progress_status.max'=>'The status may not be greater than 255 characters',
            //     'telecomunication_remark.max'=>'The Remarks may not be greater than 500 characters',


            //     ]);
            //     if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //             road
            //         $roadData=array();
            //         $roadData['road_status']=$request->road_status;
            //         $roadData['park_boundary']=$request->park_boundary;
            //         $roadData['road_distance']=$request->road_distance;
            //         $roadData['work_status']=$request->work_status;
            //         $roadData['road_remarks']=$request->road_remarks;
            //         waterfacilities
            //         $waterFacilities['source_water']=$request->source_water;
            //         $waterFacilities['required_water']=$request->required_water;
            //         $waterFacilities['proposed_system']=$request->proposed_system;
            //         $waterFacilities['status']=$request->status;
            //             $waterFacilities['water_facility_remarks']=$request->water_facility_remarks;
            //             drainage system
            //         $drainageFacility['drainage_system_details']=$request->drainage_system_details;
            //         $drainageFacility['tender_status']=$request->tender_status;
            //         $drainageFacility['otherRemarks']=$request->otherRemarks;
            //             fencing boundary
            //         $fencing['fencing_details']=$request->fencing_details;
            //         $fencing['fencing_status']=$request->fencing_status;
            //         $fencing['otherRemark']=$request->otherRemark;
            //             telecommunication faciities
            //         $telecommunicationData['tele_facility_details']=$request->tele_facility_details;
            //         $telecommunicationData['tender_progress_status']=$request->tender_progress_status;
            //         $telecommunicationData['telecomunication_remark']=$request->telecomunication_remark;



            //         if($request->editId){
            //             ProgressReport::where('id',$request->editId)->update(['road'=>$roadData]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update Road Data','user_type'=>'0');
            //             $this->auditTrail($auditData); 
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
            //         }
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
                      
            // }
            // Next tab Water Facilities
            // if($request->type == 'water_facilities'){
                
            //     $validation = Validator::make($request->all(), [
            //     'source_water'=>'required',
            //     'required_water'=>'required|max:1000',
            //     'proposed_system'=>'required|max:255',
            //     'status'=>'required|max:255',
            //     'water_facility_remarks'=>'max:500',
            //     ],
            //     [
            //         'source_water.required'=>'This fields are required',
            //         'required_water.required'=>'This fields are required',
            //         'required_water.max'=>'This fields may not be greater than 1000 characters',
            //         'proposed_system.required'=>'This fields are required',
            //         'proposed_system.max'=>'This fields may not be greater than 255 characters',
            //         'status.required'=>'This fields are required',
            //         'status.max'=>'The Status may not be greater than 255 characters',
            //         'water_facility_remarks.max'=>'The Remarks may not be greater than 500 characters',
            //     ]);
            //     if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //         //code...
            //         $waterFacilities=array();
            //         $waterFacilities['source_water']=$request->source_water;
            //         $waterFacilities['required_water']=$request->required_water;
            //         $waterFacilities['proposed_system']=$request->proposed_system;
            //         $waterFacilities['status']=$request->status;
            //         $waterFacilities['water_facility_remarks']=$request->water_facility_remarks;
            //         //dd($request);
            //         if($request->editId){
            //             ProgressReport::where('id',$request->editId)->update(['water_facility'=>$waterFacilities]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update Water Facilities Data','user_type'=>'0');
            //             $this->auditTrail($auditData);
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
            //         }  
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
            // }
            // if($request->type == 'drainage_system'){
            //     $validation = Validator::make($request->all(), [
            //     'drainage_system_details'=>'required|max:1000',
            //     'tender_status'=>'required|max:255',
            //     'otherRemarks'=>'max:500',
            //     ],
            //     [
            //     'drainage_system_details.required'=>'This fields are required',
            //     'drainage_system_details.max'=>'The details may not be greater than 1000 characters',
            //     'tender_status.required'=>'This fields are required',
            //     'tender_status.max'=>'The Status may not be greater than 255 characters',
            //     'otherRemarks.max'=>'The Remarks may not be greater than 500 characters',
            //     ]);
            //     if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //         //code...
            //         $drainageFacility=array();
            //         $drainageFacility['drainage_system_details']=$request->drainage_system_details;
            //         $drainageFacility['tender_status']=$request->tender_status;
            //         $drainageFacility['otherRemarks']=$request->otherRemarks;
            //         //dd($request);
            //         if($request->editId){
                    
            //             ProgressReport::where('id',$request->editId)->update(['drainage_facility'=>$drainageFacility]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update Drainage System Data','user_type'=>'0');
            //             $this->auditTrail($auditData);   
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
            //         } 
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }   
            // }
            // if($request->type == 'fencing_boundary'){
            //     $validation = Validator::make($request->all(), [
            //     'fencing_details'=>'required|max:1000',
            //     'fencing_status'=>'required|max:255',
            //     'otherRemark'=>'max:500',
            //     ],
            //     [
            //     'fencing_details.required'=>'This fields are required',
            //     'fencing_details.max'=>'This fields may not be greater than 1000 characters',
            //     'fencing_status.required'=>'This fields are required',
            //     'fencing_status.max'=>'This fields may not be greater than 255 characters',
            //     'otherRemark.max'=>'The Remarks may not be greater than 500 characters',
            //     ]);
            //     if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //         //code...
            //         $fencing=array();
            //         $fencing['fencing_details']=$request->fencing_details;
            //         $fencing['fencing_status']=$request->fencing_status;
            //         $fencing['otherRemark']=$request->otherRemark;
            //         //dd($request);
            //         if($request->editId){
            //             ProgressReport::where('id',$request->editId)->update(['fencing'=>$fencing]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update Fencing Boundary Data','user_type'=>'0');
            //             $this->auditTrail($auditData);      
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
            //         } 
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
            // }
            // if($request->type == 'telecommunication_facilities'){
            //     $validation = Validator::make($request->all(), [
            //     'tele_facility_details'=>'required|max:1000',
            //     'tender_progress_status'=>'required|max:255',
            //     'telecomunication_remark'=>'max:500',
            //     ],
            //     [
            //     'tele_facility_details.required'=>'This fields are required',
            //     'tele_facility_details.max'=>'This fields may not be greater than 1000 characters',
            //     'tender_progress_status.required'=>'This fields are required',
            //     'tender_progress_status.max'=>'The status may not be greater than 255 characters',
            //     'telecomunication_remark.max'=>'The Remarks may not be greater than 500 characters',
            //     ]);
            //     if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //         //code...
            //         $telecommunicationData=array();
            //         $telecommunicationData['tele_facility_details']=$request->tele_facility_details;
            //         $telecommunicationData['tender_progress_status']=$request->tender_progress_status;
            //         $telecommunicationData['telecomunication_remark']=$request->telecomunication_remark;
            //         //dd($request);
            //         if($request->editId){
            //             ProgressReport::where('id',$request->editId)->update(['telecommunication_facility'=>$telecommunicationData]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update Telecommunication Facilities Data','user_type'=>'0');
            //             $this->auditTrail($auditData);
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']); 
            //         } 
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
            // }
            if($request->type == 'internal_transmission_system'){
                $validation = Validator::make($request->all(), [
                'int_transmission_detail'=>'required|max:1000',
                'connection_point'=>'required',
                'whether_applied'=>'required',
                'external_details'=>'required',
                'external_status'=>'required',
                'ext_responsibility'=>'required',
                'internal_transmission_status'=>'required|max:255',
                'internal_transmission_remarks'=>'max:500',
                ],
                [
                'int_transmission_detail.required'=>'This fields are required',
                'int_transmission_detail.max'=>'The Details may not be greater than 1000 characters',
                'connection_point.required'=>'This fields are required',
                'whether_applied.required'=>'This fields are required',
                'external_details.required'=>'This fields are required',
                'external_status.required'=>'This fields are required',
                'ext_responsibility.required'=>'This fields are required',
                'internal_transmission_status.required'=>'This fields are required',
                'internal_transmission_status.max'=>'The Status may not be greater than 255 characters',
                'internal_transmission_remarks.max'=>'The Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    //code...
                    $internalTrasmission=array();
                    $internalTrasmission['int_transmission_detail']=$request->int_transmission_detail;
                    $internalTrasmission['connection_point']=$request->connection_point;
                    $internalTrasmission['whether_applied']=$request->whether_applied;
                    $internalTrasmission['external_details']=$request->external_details;
                    $internalTrasmission['external_status']=$request->external_status;
                    $internalTrasmission['ext_responsibility']=$request->ext_responsibility;
                    $internalTrasmission['internal_transmission_status']=$request->internal_transmission_status;
                    $internalTrasmission['internal_transmission_remarks']=$request->internal_transmission_remarks;
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['internal_transmission_system'=>$internalTrasmission]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Internal Transmission System Data','user_type'=>'0');
                        $this->auditTrail($auditData); 
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    } 
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            // if($request->type == 'external_transmission_system'){
            //     $validation = Validator::make($request->all(), [
            //     'ext_responsibility'=>'required',
            //     'external_details'=>'required|max:1000',
            //     'external_status'=>'required|max:255',
            //     'ext_remarks'=>'max:500',
            //     ],
            //     [
            //     'ext_responsibility.required'=>'This fields are required',
            //     'external_details.required'=>'This fields are required',
            //     'external_details:max'=>'Details may not be greater than 1000 characters.',
            //     'external_status.required'=>'This fields are required',
            //     'external_status.max'=>'Status may not be greater than 500 characters',
            //     'ext_remarks.max'=>'Remarks may not be greater than 500 characters.',
            //     ]);
            //     if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
            //         return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            //     }
            //     try {
            //         $externalTrasmission=array();
            //         $externalTrasmission['ext_responsibility']=$request->ext_responsibility ;
            //         $externalTrasmission['external_details']=$request->external_details;
            //         $externalTrasmission['external_status']=$request->external_status;
            //         $externalTrasmission['ext_remarks']=$request->ext_remarks;
            //         if($request->editId){
            //             ProgressReport::where('id',$request->editId)->update(['external_transmission_system'=>$externalTrasmission]);
            //             $auditData = array('action_type'=>'3','description'=>'User Update External Transmission System Data','user_type'=>'0');
            //             $this->auditTrail($auditData);
            //             return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
            //         }  
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
            // }
            if($request->type == 'solar_projects'){
                $validation = Validator::make($request->all(), [
                'detail'=>'required',
                'agency'=>'required|max:255',
                'nit_date'=>'required',
                'bidders_name'=>'required',
                'TD_capacity'=>'required|min:0',
                'tariff'=>'required|min:0',
                'spds_name_loa'=>'required',
                'capacity_loa'=>'required',
                'psa_date'=>'required',
                'discom_name'=>'required',
                // 'psa_signature'=>'required',
                'spds_name_ppa'=>'required',
                'ppa_capacity'=>'required',
                'ppa_date'=>'required',
                'spds_name_scod'=>'required',
                'scod_capacity'=>'required',
                'scod_date'=>'required',
                'extended_spds_name'=>'required',
                'extended_capacity'=>'required',
                'extended_date'=>'required',
                'solar_project_remarks'=>'max:500',
                ],
                [
                'detail.required'=>'This fields are required',
                'agency.required'=>'This fields are required',
                'nit_date.required'=>'This fields are required',
                'bidders_name.required'=>'This fields are required',
                'TD_capacity.required'=>'This fields are required',
                'tariff.required'=>'This fields are required',
                'spds_name_loa.required'=>'This fields are required',
                'capacity_loa.required'=>'This fields are required',
                'psa_date.required'=>'This fields are required',
                'discom_name.required'=>'This fields are required',
                // 'psa_signature.required'=>'This fields are required',
                'spds_name_ppa.required'=>'This fields are required',
                'ppa_capacity.required'=>'This feilds are required',
                'ppa_date.required'=>'This feilds are required',
                'spds_name_scod.required'=>'This feilds are required',
                'scod_capacity.required'=>'This feilds are required',
                'scod_date.required'=>'This feilds are required',
                'extended_spds_name.required'=>'This feilds are required',
                'extended_capacity.required'=>'This feilds are required',
                'extended_daterequired'=>'This feilds are required',
                'solar_project_remarks.max'=>'Remarks may not be greater than 500 characters',
                ]
                );
                if ($validation->fails()){   
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $solarProject=array();
                    $solarProject['detail']=$request->detail;
                    $solarProject['agency']=$request->agency;
                    $solarProject['nit_date']=$request->nit_date;
                    $solarProject['bidders_name']=$request->bidders_name;
                    $solarProject['TD_capacity']=$request->TD_capacity;
                    $solarProject['tariff']=$request->tariff;
                    $solarProject['spds_name_loa']=$request->spds_name_loa;
                    $solarProject['capacity_loa']=$request->capacity_loa;
                    $solarProject['psa_date']=$request->psa_date;
                    $solarProject['discom_name']=$request->discom_name;
                    // $solarProject['psa_signature']=$request->psa_signature;
                    $solarProject['spds_name_ppa']=$request->spds_name_ppa;
                    $solarProject['ppa_capacity']=$request->ppa_capacity;
                    $solarProject['ppa_date']=$request->ppa_date;
                    $solarProject['spds_name_scod']=$request->spds_name_scod;
                    $solarProject['scod_capacity']=$request->scod_capacity;
                    $solarProject['scod_date']=$request->scod_date;
                    $solarProject['extended_spds_name']=$request->extended_spds_name;
                    $solarProject['extended_capacity']=$request->extended_capacity;
                    $solarProject['extended_date']=$request->extended_date;
                    $solarProject['solar_project_remarks']=$request->solar_project_remarks;
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['solar_projects'=>$solarProject]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Solar Projects Data','user_type'=>'0');
                        $this->auditTrail($auditData);   
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }  
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'financial_closure'){
                $validation = Validator::make($request->all(), [
                'financial_closure_details'=>'required|max:1000',
                'financial_closure_remarks'=>'max:500',
                ],
                [
                'financial_closure_details.required'=>'This fields are required',
                'financial_closure_details.max'=>'Details may not be greater than 1000 characters',
                'financial_closure_remarks.max'=>'Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails()){ 
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $financialClosure=array();
                    $financialClosure['financial_closure_details']=$request->financial_closure_details;
                    $financialClosure['financial_closure_remarks']=$request->financial_closure_remarks;
                    //dd($request);
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['financial_closure'=>$financialClosure]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Financial Closure Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    } 
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'award_of_work'){
                $validation = Validator::make($request->all(), [
                'award_work_details'=>'required|max:1000',
                'whether_awarded'=>'required',
                'pooling_stations'=>'required|max:1000',
                'aow_status'=>'required|max:255',
                'work_award_remarks'=>'max:500'
                ],
                [
                'award_work_details.required'=>'This fields are required',
                'award_work_details.max'=>'Details may not be greater than 1000 characters',
                'whether_awarded.required'=>'This fields are required',
                'pooling_stations.required'=>'This fields are required',
                'pooling_stations.max'=>'This field may not be greater than 1000 characters',
                'aow_status.required'=>'This fields are required',
                'aow_status.max'=>'Status may not be greater than 500 characters',
                'work_award_remarks.max'=>'Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $awardOfWork=array();
                    $awardOfWork['award_work_details']=$request->award_work_details;
                    $awardOfWork['whether_awarded']=$request->whether_awarded;
                    $awardOfWork['pooling_stations']=$request->pooling_stations; 
                    $awardOfWork['aow_status']=$request->aow_status;
                    $awardOfWork['work_award_remarks']=$request->work_award_remarks;
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['award_of_work'=>$awardOfWork]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Aeard Of Work Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }  
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'solar_park_completion'){
                $validation = Validator::make($request->all(), [
                'developement_activities'=>'required',
                'date_inprincuple_approval'=>'required',
                'solarPark_work_details'=>'required|max:1000',
                'SPC_delay'=>'required|max:255',
                'SPC_remarks'=>'max:500',
                'upload_file'=>'required|in:kml,xlsx,xls|max:32768',
                ],
                [
                'developement_activities.required'=>'This fields are required',
                'date_inprincuple_approval.required'=>'This fields are required',
                'solarPark_work_details.required'=>'This fields are required',
                'solarPark_work_details.max'=>'Details may not be greater than 1000 characters',
                'SPC_delay.required'=>'This fields are required',
                'SPC_delay.max'=>'this field may not be greater than 255 characters',
                'SPC_remarks.max'=>'Remarks may not be greater than 500 characters',  
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $solarparkCompletion=array('upload_file'=>array());
                    $solarparkCompletion['developement_activities']=$request->developement_activities;
                    $solarparkCompletion['date_inprincuple_approval']=$request->date_inprincuple_approval;
                    $solarparkCompletion['solarPark_work_details']=$request->solarPark_work_details; 
                    $solarparkCompletion['SPC_delay']=$request->SPC_delay;
                    $solarparkCompletion['SPC_remarks']=$request->SPC_remarks;
                    // $solarparkCompletion['upload_file']=$request->upload_file;

                    $dir_path = 'systems\\'.Auth::id().'\\'.$request->editId.'\\';
                    Storage::disk('filestore')->makeDirectory($dir_path);
                    $upload_file = [];
                    foreach($request->file('upload_file') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'UPLOAD_FILE_'.$rd.'_');   
                        array_push($upload_file, $filename['name']);
                    }
                    array_push($solarparkCompletion['upload_file'], $upload_file); 
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['solarpark_completion'=>$solarparkCompletion]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Solar Park Completion Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'status_of_release_of_cfa'){
                $validation = Validator::make($request->all(), [
                'land_acquisition_amount'=>'required',
                'financial_closure_amount'=>'required',
                'aw_pooling_station_amount'=>'required',
                'receipt_material_site_amount'=>'required',
                'completion_construction_amount'=>'required',
                'land_acquisition_due_date'=>'required',
                'financial_closure_due_date'=>'required',
                'aw_pooling_station_due_date'=>'required',
                'receipt_material_site_due_date'=>'required',
                'completion_construction_due_date'=>'required',
                'land_acquisition_release_date'=>'required',
                'financial_closure_release_date'=>'required',
                'aw_pooling_station_release_date'=>'required',
                'receipt_material_site_release_date'=>'required',
                'completion_construction_release_date'=>'required',
                // // ],
                // [
                // 'developement_activities.required'=>'This fields are required',
                // 'date_inprincuple_approval.required'=>'This fields are required',
                // 'solarPark_work_details.required'=>'This fields are required',
                // 'solarPark_work_details.max'=>'Details may not be greater than 1000 characters',
                // 'SPC_delay.required'=>'This fields are required',
                // 'SPC_delay.max'=>'this field may not be greater than 255 characters',
                // 'SPC_remarks.max'=>'Remarks may not be greater than 500 characters',  
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $solarparkCompletion=array();
                    $solarparkCompletion['land_acquisition_amount']=$request->land_acquisition_amount;
                    $solarparkCompletion['financial_closure_amount']=$request->financial_closure_amount;
                    $solarparkCompletion['aw_pooling_station_amount']=$request->aw_pooling_station_amount; 
                    $solarparkCompletion['receipt_material_site_amount']=$request->receipt_material_site_amount;
                    $solarparkCompletion['completion_construction_amount']=$request->completion_construction_amount;
                    $solarparkCompletion['land_acquisition_due_date']=$request->land_acquisition_due_date;
                    $solarparkCompletion['financial_closure_due_date']=$request->financial_closure_due_date;
                    $solarparkCompletion['aw_pooling_station_due_date']=$request->aw_pooling_station_due_date;
                    $solarparkCompletion['receipt_material_site_due_date']=$request->receipt_material_site_due_date;
                    $solarparkCompletion['completion_construction_due_date']=$request->completion_construction_due_date;
                    $solarparkCompletion['land_acquisition_release_date']=$request->land_acquisition_release_date;
                    $solarparkCompletion['financial_closure_release_date']=$request->financial_closure_release_date;
                    $solarparkCompletion['aw_pooling_station_release_date']=$request->aw_pooling_station_release_date;
                    $solarparkCompletion['receipt_material_site_release_date']=$request->receipt_material_site_release_date;
                    $solarparkCompletion['completion_construction_release_date']=$request->completion_construction_release_date;
                   
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['status_of_release_of_cfa'=>$solarparkCompletion]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Solar Park Completion Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'external_power_evacuation_system'){
                $validation = Validator::make($request->all(), [
                'external_transmission'=>'required|max:1000',
                'delay_external_transmission'=>'required|max:255',
                'external_transmission_remarks'=>'max:500',
                ],
                [
                'external_transmission.required'=>'This fields are required',
                'external_transmission.max'=>'Details may not be greater than 1000 characters',
                'delay_external_transmission.required'=>'This fields are required',
                'delay_external_transmission.max'=>'This fields may not be greater than 255 characters',
                'external_transmission_remarks.max'=>'Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails()){   //check all validations are fine, if not then redirect and show error messages
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    $externalPowerSystem=array();
                    $externalPowerSystem['external_transmission']=$request->external_transmission;
                    $externalPowerSystem['delay_external_transmission']=$request->delay_external_transmission;
                    $externalPowerSystem['external_transmission_remarks']=$request->external_transmission_remarks;
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['external_power_system'=>$externalPowerSystem]);
                        $auditData = array('action_type'=>'3','description'=>'User Update External Power Evaluation System Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }  
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
            if($request->type == 'solar_project_completion'){
                
                $validation = Validator::make($request->all(), [
                    'solar_project_completion_details'=>'required|max:1000',
                    'delay_solar_project'=>'required|max:255',
                    'solar_project_complation_remarks'=>'max:500',
                ],
                [
                    'solar_project_completion_details.required'=>'This fields are required',
                    'solar_project_completion_details.max'=>'Details may not be greater than 1000 characters',
                    'delay_solar_project.required'=>'This fields are required',
                    'delay_solar_project.max'=>'This field may not be greater than 255 characters',
                    'solar_project_complation_remarks.max'=>'Remarks may not be greater than 500 characters',
                ]);
                if ($validation->fails())   //check all validations are fine, if not then redirect and show error messages
                {
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    //code...
                    $solarProjectCompletion=array();
                    $solarProjectCompletion['solar_project_completion_details']=$request->solar_project_completion_details;
                    $solarProjectCompletion['delay_solar_project']=$request->delay_solar_project;
                    $solarProjectCompletion['solar_project_complation_remarks']=$request->solar_project_complation_remarks; 
                    //dd($request);
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['solar_project_completion'=>$solarProjectCompletion]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Solar Project Completion Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }  
                } catch (\Throwable $th) {
                    //throw $th;
                }  
            }
            if($request->type == 'attachments'){
                //dd($request);
                $validation = Validator::make($request->all(), [
                    'site_photo'=>'required',
                    'road_photo'=>'required',
                    'ipes_photo'=>'required',
                    'exts_photo'=>'required',
                    'solar_project_photo'=>'required',
                    'additional_documents'=>'required',
                ],
                [
                    // 'site_photo.required'=>'This fields are required',
                    // 'road_photo.required'=>'This fields are required',
                    // 'ipes_photo.required'=>'This fields are required',
                    // 'exts_photo.required'=>'This fields are required',
                    // 'solar_project_photo.required'=>'This fields are required',
                ]);
                if ($validation->fails())   //check all validations are fine, if not then redirect and show error messages
                {
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    //code...
                    $attachments=array('site_photo'=>array(),'road_photo'=>array(),'ipes_photo'=>array(),'exts_photo'=>array(),'solar_project_photo'=>array(),'additional_documents'=>array());
                    $dir_path = 'systems\\'.Auth::id().'\\'.$request->editId.'\\';
                    Storage::disk('filestore')->makeDirectory($dir_path);
                    $site_photo = [];
                    foreach($request->file('site_photo') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'SITE_PHOTO_'.$rd.'_');     
                        array_push($site_photo, $filename['name']);
                    }
                    array_push($attachments['site_photo'], $site_photo); 
                    //dd($attachments);
                    $road_photo = [];
                    foreach($request->file('road_photo') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'ROAD_PHOTO_'.$rd.'_');     
                        array_push($road_photo, $filename['name']);
                    }
                    array_push($attachments['road_photo'], $road_photo); 
                    //dd($attachments);
                    $ipes_photo = [];
                    foreach($request->file('ipes_photo') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'INTERNAL_POWER_ES_PHOTO_'.$rd.'_');     
                        array_push($ipes_photo, $filename['name']);
                    }
                    array_push($attachments['ipes_photo'], $ipes_photo); 
                    $exts_photo = [];
                    foreach($request->file('exts_photo') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'EXTERNAL_TS_PHOTO_'.$rd.'_');     
                        array_push($exts_photo, $filename['name']);
                    }
                    array_push($attachments['exts_photo'], $exts_photo); 
                    $solar_project_photo = [];
                    foreach($request->file('solar_project_photo') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'SOLAR_PROJECT_PHOTO_'.$rd.'_');     
                        array_push($solar_project_photo, $filename['name']);
                    }
                    array_push($attachments['solar_project_photo'], $solar_project_photo);
                    $additional_documents = [];
                    foreach($request->file('additional_documents') as $image)
                    {
                        $rd=rand(6,778798);    
                        $filename=$this->uploadFile($image, $dir_path,'ADDITIONAL_DOCUMENTS_'.$rd.'_');     
                        array_push($additional_documents, $filename['name']);
                    }
                    array_push($attachments['additional_documents'], $additional_documents);
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['attachments'=>$attachments]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Attachements Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    } 
                } catch (\Throwable $th) {
                    //throw $th;
                }    
            }
            if($request->type == 'additional_information'){
               
                $validation = Validator::make($request->all(), [
                    'other_documents'=>'required',
                ],
                [
                    'other_documents.required'=>'This fields are required',
                    // 'other_documents.mimes'=>'Upload Only PDF Format',
                    'other_documents.max'=>'File should be less then 1MB',
                ]);
                if ($validation->fails())   //check all validations are fine, if not then redirect and show error messages
                {
                    return response()->json(['status'=>'verror','data'=>$validation->errors()]);
                }
                try {
                    //code...
                    $dir_path = 'systems\\'.Auth::id().'\\'.$request->editId.'\\';
                    Storage::disk('filestore')->makeDirectory($dir_path);
                    if($request->hasFile('other_documents')){
                        $rd=rand(6,778798);
                        $file= $this->uploadFile($request->file('other_documents'), $dir_path,'OTHER_DOCUMENTS_'.$rd.'_');
                        $other_documents=$file['name'];
                    }
                    if($request->editId){
                        ProgressReport::where('id',$request->editId)->update(['additional_information'=>$other_documents]);
                        $auditData = array('action_type'=>'3','description'=>'User Update Additional Information Data','user_type'=>'0');
                        $this->auditTrail($auditData);
                        return response()->json(['status' => 'success','message'=>'Details save successfuly!','next'=>$request->next,'url'=>'no','redirect'=>'yes']);
                    }
                } catch (\Throwable $th) {
                    //throw $th;
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
                    //code...
                    $dir_path = 'systems\\'.Auth::id().'\\'.$request->editId.'\\';
                    Storage::disk('filestore')->makeDirectory($dir_path);
                    if($request->hasFile('undertaking')){
                        $rd=rand(6,778798);
                        $file= $this->uploadFile($request->file('undertaking'), $dir_path,'UNDERTAKING_'.$rd.'_');
                        $undertaking=$file['name'];
                    }
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
                }
            }
        }
        $auditData = array('action_type'=>'1','description'=>'User view all Data','user_type'=>'0');
        $this->auditTrail($auditData);
        $generalData=array();
        $data= ProgressReport::select('*')->where('id',$id)->where('user_id',Auth::id())->first();
        // dd($data);
        if($data!=null){
            if($data->final_submission==1){
                return redirect(Auth::getDefaultDriver().'/my-progress-report'); 
            }
            $previousData= ProgressReport::select('general')->where('user_id',Auth::id())->orderBy("id",'DESC')->skip(1)->take(1)->first();
            if($previousData!=NULL){
                $decode=json_decode($previousData,true);
                $decode_dpr=json_decode($decode['general']);
                $generalData['dpr_status'] = $decode_dpr->dpr_status; // agar previous data null nahi hai to 
            }
            
            $generalData['month']=$data->month;
            $generalData['year']=$data->year;
            $generalData['id']=$data->id;
            $generalData['general'] = json_decode($data->general, true);
            $generalData['internal_infrastructure'] = json_decode($data->internal_infrastructure, true);
            $generalData['road'] = json_decode($data->road, true);
            $generalData['water_facilities'] = json_decode($data->water_facility, true);
            $generalData['drainage_system'] = json_decode($data->drainage_facility, true);
            $generalData['fencing_boundary'] = json_decode($data->fencing, true);
            $generalData['telecommunication_facilities'] = json_decode($data->telecommunication_facility, true);
            $generalData['internal_transmission_system'] = json_decode($data->internal_transmission_system, true);
            $generalData['external_transmission_system'] = json_decode($data->external_transmission_system, true);
            $generalData['solar_projects'] = json_decode($data->solar_projects, true);
            $generalData['financial_closure'] = json_decode($data->financial_closure, true);
            $generalData['award_of_work'] = json_decode($data->award_of_work, true);
            $generalData['solar_park_completion'] = json_decode($data->solarpark_completion, true);
            $generalData['land_acquisition_release_date'] = json_decode($data->land_acquisition_release_date, true);
            $generalData['status_of_release_of_cfa'] = json_decode($data->status_of_release_of_cfa, true);
            $generalData['external_power_evacuation_system'] = json_decode($data->external_power_system, true);
            $generalData['solar_project_completion'] = json_decode($data->solar_project_completion, true);
            $generalData['attachments'] = json_decode($data->attachments, true);
            $generalData['additional_information'] = $data->additional_information;
            
            //dd($generalData);
            $states = State::All();
            return view('backend.beneficiary.progress_report.progressReport' , compact('states','id','generalData'));
        }else{
            return redirect()->back()->with("error",'Invalid Request');
        }   
    }
    public function newProgressReport(Request $request){
        if($request->isMethod('post')){
            $month=$request->month;
            $year=$request->year;
            $existingProgressData=ProgressReport::select('*')->where('user_id', Auth::id())->where('month', $month)->where('year',$year)->first();
            if($existingProgressData!=null){
                return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$existingProgressData->id);
                return response()->json(['error' => 'error','message'=>'Progress Report Existing for the Month!']);
                // return redirect()->back()->with("error",'Progress Report Existing for the Month');
            }
            $newProgressData=new ProgressReport();
            $newProgressData->month=$request->month;
            $newProgressData->year=$request->year;
            $newProgressData->user_id=Auth::id();
            $newProgressData->save();
            $id=$newProgressData->id;
        //     if('final_submission == 0'){
        //         return redirect(Auth::getDefaultDriver().'/application/progress_report/');
        //    } 
           return redirect(Auth::getDefaultDriver().'/application/progress_report/'.$id);
        }
        return view('backend.beneficiary.progress_report.newProgressReport');
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
        return view('backend.beneficiary.progress_report.myProgressReport',compact('progressDetails','states'));
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
                $submitUrl = URL::to('/beneficiary/change-password');
                
                $auditData = array('action_type'=>'3','description'=>' MNRE User  Change Password ','user_type'=>'1');
                $this->auditTrail($auditData);
               
                return view('backend.beneficiary.changePassword',compact('submitUrl'));
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
        }
        $previousprogressReport=ProgressReport::select($type)->where('month',$month)->where('year',$year)->where('user_id',Auth::id())->first();
        $auditData = array('action_type'=>'3','description'=>'User Copied Previous Data in Progress Report','user_type'=>'0');
        $this->auditTrail($auditData);
        $data=ProgressReport::where('id',$id)->update([$type=>$previousprogressReport->$type]);
        return response()->json(['status' => 'success','message'=>'Details save successfuly!']);
        // if($data){  
        // }
        // return response()->json(['status' => 'error','message'=>'error!']);
        // dd($previousprogressReport->$type);
    }


public function addSolarPark(Request $request){
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
        $newSPData=new ManageSolarPark();
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
        $url=urlencode('/beneficiary/manage-solar-park');
        return response()->json(['status' => 'success','message'=>'You have successfully submitted Progress Report!','url'=>$url,'redirect'=>'yes']); 
        // return response()->json(['status' => 'success','message'=>'Details save successfuly!']); 
        // return redirect()->back()->with("status","New Data Added Successfully !");
    }
    $states = State::orderby('name')->get();
    return view('backend.beneficiary.add_solar_park',compact('states'));
}

public function solarParkList(Request $request){
    $mnreuserDetail=ManageSolarPark::getSolarParkDevDetails();
    // $mnreuserDetail=ManageSolarPark::where('user_id',Auth::user()->user_id)->get();
    return view('backend.beneficiary.solarParkList',compact('mnreuserDetail'));
}


}


            