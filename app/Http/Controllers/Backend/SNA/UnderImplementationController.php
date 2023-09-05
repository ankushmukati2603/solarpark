<?php

namespace App\Http\Controllers\Backend\SNA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Traits\General;
use App\Models\Tenders;
use App\Models\SelectedBidderProject;
use App\Models\TenderTimeLine;
use App\Utils\EmailSmsNotifications;
use App\Models\VillageSISL;
use App\Models\SystemSISL;
use App\Exports\TenderExport;

use DB, URL, Auth, Hash, Storage, Config, Gate,Validator,PDF;

class UnderImplementationController extends Controller
{
    use General;
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    public function under_implementation(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'status_stage_two.*' => 'required', 
                'status_lta.*' => 'required',
                'ltoa_date.*' => 'required',
                'status_transmisison_line.*' => 'required',
                'interconnection_vol_level.*' => 'required',
            ],[
                'status_stage_two.*.required'=>'This field is required',
                'status_lta.*.required'=>'This field is required',
                'ltoa_date.*.required'=>'This field is required',
                'status_transmisison_line.*.required'=>'This field is required',
                'interconnection_vol_level.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            for($i=0;$i<count($request->input('status_stage_two'));$i++){
                $SelectedBidderProject=SelectedBidderProject::findOrFail($request->id[$i]);
                $SelectedBidderProject->status_stage_two=$request->status_stage_two[$i];
                $SelectedBidderProject->status_lta=$request->status_lta[$i];
                $SelectedBidderProject->ltoa_date=$request->ltoa_date[$i];
                $SelectedBidderProject->status_transmisison_line=$request->status_transmisison_line[$i];
                $SelectedBidderProject->interconnection_vol_level=$request->interconnection_vol_level[$i];
                $SelectedBidderProject->save();
                //Tender Timeline
                if($i==0){
                    $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Under Implementation Details Submitted',
                    'action_type'=>'under-implementation','action_date'=>$request->ltoa_date[$i]);
                    $this->tenderTimeline($tenderTimeline);
                }
            }      
            Tenders::where('id',base64_decode($request->tender))->update(['tender_status' => 3]);  //Implemented   
            $auditData = array('action_type'=>'3','description'=>'SNA Add Under Implementation Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/Under-Implementation');
            return response()->json(['status' => 'success','message'=>'Under Implementation Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
            
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Add Under Implementation Details page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->where('tender_status', '!=' , 5)->get();
        return view('backend.state-implementing-agency.underImplementation',compact('tenderList'));
    }

    public function getSelectedBidderRecords($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderRecordsById($id,$tender_id);
        $result='';
        $i=0;
        if($selectedBidderProjectData->isNotEmpty()){
            $result='<hr/><table class="table table-bordered" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="8">
                            <h4>Tender Under Implementation Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project Name </th>
                        <th>Project capacity (MW)</th>
                        <th>Status of Stage 2 connectivity <span class="text-danger">*</span></th>
                        <th>Status of LTA & target region <span class="text-danger">*</span></th>
                        <th>LTOA operationalization date <span class="text-danger">*</span></th>
                        <th>Status of Transmisison line from <br> project site to Sub stattion (by developer)<span class="text-danger">*</span></th>
                        <th>Interconnection Point/S/S voltage level <span class="text-danger">*</span></th>
                        
                    </tr>';
            foreach($selectedBidderProjectData as $data){$i++;
                if($data->status_stage_two==''){
                    $result.='<tr>
                    <td class="row-index">'.$data->project_title.'
                        <input type="hidden" name="id[]" value="'.$data->id.'" />
                    </td>
                    <td>'.$data->commissioned_capacity.'
                    </td>
                    <td>
                        <select name="status_stage_two[]" id="status_stage_two" class="form-control">
                            <option value="">~~Select~~</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                            <span name="status_stage_two.'.($i-1).'"></span>
                    </td>
                    <td>
                        <select name="status_lta[]" id="status_lta" class="form-control">
                            <option value="">~~Select~~</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                        <span name="status_lta.'.($i-1).'"></span>
                    </td>
                    <td>
                        <input type="date" class="form-control pull-right alldatepicker "
                            id="ltoa_date" placeholder="MM-DD-YYYY" name="ltoa_date[]"
                            value="">
                            <span name="ltoa_date.'.($i-1).'"></span>
                    </td>
                    <td>
                        <select name="status_transmisison_line[]" id="status_transmisison_line" class="form-control">
                            <option value="">~~Select~~</option>
                            <option value="Completed">Completed</option>
                            <option value="In Progress">In Progress</option>
                        </select>
                        <span name="status_transmisison_line.'.($i-1).'"></span>
                    </td>
                    <td>
                        <input type="text" name="interconnection_vol_level[]" id="interconnection_vol_level" value="" class="form-control" placeholder="Enter Interconnection Point/S/S voltage level" />
                        <span name="interconnection_vol_level.'.($i-1).'"></span>
                    </td>
                </tr>';
                if($i==count($selectedBidderProjectData)){
                    $result.='<tr>
                        <td colspan="6">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                        </td>
                    </tr>';
                }
            }
            else{
                $result.='<tr>
                <td class="row-index">'.$data->project_title.'</td>
                <td>'.$data->commissioned_capacity.'</td>
                <td>'.$data->status_stage_two.'</td>
                <td>'.$data->status_lta.'</td>
                <td>'.date("d M Y",strtotime($data->ltoa_date)).'</td>
                <td>'.$data->status_transmisison_line.'</td>
                <td>'.$data->interconnection_vol_level.'</td>
                </tr>';
            }
            
        }
        $result.='</table>';
        return response()->json(['status' => 'success','result'=>$result]);
            
        }
        else{
            $result.='<h3 class="text-danger">Please add Commissioning Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
        
    }

    public function commissioned(Request $request){
        if($request->isMethod('post')){
            $validation = Validator::make($request->all(), [
                'tender'=>'required',
                'bidders'=>'required',
                'project_type.*' => 'required', 
                'module_type.*' => 'required',
                'module_make.*' => 'required',
                'substation_name.*' => 'required',
                'substation_voltage.*' => 'required',
                'feeder_name.*' => 'required',
                'feeder_voltage.*' => 'required',
                'have_solar_project.*' => 'required',
                'ac_voltage.*' => 'required',
                'dc_voltage.*' => 'required',
            ],[
                'project_type.*.required'=>'This field is required',
                'module_type.*.required'=>'This field is required',
                'module_make.*.required'=>'This field is required',
                'substation_name.*.required'=>'This field is required',
                'substation_voltage.*.required'=>'This field is required',
                'feeder_name.*.required'=>'This field is required',
                'feeder_voltage.*.required'=>'This field is required',
                'have_solar_project.*.required'=>'This field is required',
                'ac_voltage.*.required'=>'This field is required',
                'dc_voltage.*.required'=>'This field is required',
            ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            $arrayData=array();
            for($i=0;$i<count($request->input('project_type'));$i++){
                
                $arrayData['project_type']=$request->project_type[$i];
                $arrayData['module_type']=$request->module_type[$i];
                $arrayData['module_make']=$request->module_make[$i];
                $arrayData['substation_name']=$request->substation_name[$i];
                $arrayData['substation_voltage']=$request->substation_voltage[$i];
                $arrayData['feeder_name']=$request->feeder_name[$i];
                $arrayData['feeder_voltage']=$request->feeder_voltage[$i];
                $arrayData['have_solar_project']=$request->have_solar_project[$i];
                $arrayData['ac_voltage']=$request->ac_voltage[$i];
                $arrayData['dc_voltage']=$request->dc_voltage[$i];
                $arrayData['solar_park_name']=$request->solar_park_name[$i];

                $commissionedDetail=SelectedBidderProject::findOrFail($request->id[$i]); 
                $commissionedDetail->commissioned_details=json_encode($arrayData);
                $commissionedDetail->save();  
                
                // Tender Timeline
                if($i==0){
                    $tenderTimeline = array('tender_id'=>base64_decode($request->input('tender')),'action_description'=>'Commissioned Details Submitted',
                    'action_type'=>'commissioned','action_date'=>$this->getCurruntDate());
                    $this->tenderTimeline($tenderTimeline);
                }
            } 
            // Updating Tender Status
            Tenders::where('id',base64_decode($request->tender))->update(['tender_status' => 4]);  //Commissioned     

            $auditData = array('action_type'=>'3','description'=>'SNA Add Commissioned Details successfuly','user_type'=>'2'); 
            $this->auditTrail($auditData);
            $url=urlencode('/'.Auth::getDefaultDriver().'/Commissioned');
            return response()->json(['status' => 'success','message'=>'Commissioned Details saved successfuly!','url'=>$url,'redirect'=>'yes']);
            
        }
        $auditData = array('action_type'=>'1','description'=>'SNA Visit Commissioned Details page','user_type'=>'2');
        $this->auditTrail($auditData);
        $tenderList=Tenders::where('sna_id',Auth::id())->whereIn('tender_status',[3,4])->get();
        return view('backend.state-implementing-agency.commissioned',compact('tenderList'));
    }
    public function getSelectedBidderRecordsByImplemented($id,$tender_id){
        $selectedBidderProjectData=SelectedBidderProject::getSelectedBidderRecordsByImplemented($id,$tender_id);
        $result='';
        $i=0;
        if($selectedBidderProjectData->isNotEmpty()){
            $result='<hr/><table class="table table-bordered tenderBlock table-responsive" id="ppaTbale">
                    <tr class="bg-primary text-light">
                        <th colspan="12">
                            <h4>Tender Commissioned Details</h4>
                        </th>
                    </tr>
                    <tr class="bg-success text-light">
                        <th>Project Name </th>
                        <th>Project capacity (MW)</th>
                        <th>Project Type <span class="text-danger">*</span></th>
                        <th>Type of Module <span class="text-danger">*</span></th>
                        <th>Module Make <span class="text-danger">*</span></th>
                        <th>Substation Name <span class="text-danger">*</span></th>
                        <th>Substation Voltage Level (KV) <span class="text-danger">*</span></th>
                        
                        <th>Feeder Name <span class="text-danger">*</span></th>
                        <th>Feeder Voltage (KV)<span class="text-danger">*</span></th>
                        <th>Projects in Solar Park <span class="text-danger">*</span></th>
                        <th>Commissioned AC Capacity <span class="text-danger">*</span></th>
                        <th>Commissioned DC Capacity <span class="text-danger">*</span></th>
                    </tr>';
            foreach($selectedBidderProjectData as $data){$i++;
                if($data->commissioned_details=='')
                {
                    $result.='<tr>
                        <td class="row-index">'.$data->project_title.'
                            <input type="hidden" name="id[]" value="'.$data->id.'" />
                        </td>
                        <td>'.$data->commissioned_capacity.'
                        </td>
                        <td>
                            <select name="project_type[]" id="project_type" class="form-control">
                                <option value="">~~Select~~</option>
                                <option value="Ground Mounted">Ground Mounted</option>
                                <option value="Rooftop">Rooftop</option>
                                <option value="Other">Other</option>
                            </select>
                                <span name="project_type.'.($i-1).'"></span>
                        </td>
                        <td>
                            <select name="module_type[]" id="module_type" class="form-control">
                                <option value="">~~Select~~</option>
                                <option value="Thin">Thin</option>
                                <option value="Poly">Poly</option>
                                <option value="Mono">Mono</option>
                                <option value="Other">Other</option>
                            </select>
                            <span name="module_type.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                id="module_make" placeholder="Module Make" name="module_make[]"
                                value="">
                                <span name="module_make.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                id="substation_name" placeholder="Name of Substation" name="substation_name[]"
                                value="">
                                <span name="substation_name.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input  type="text" class="form-control"
                                id="substation_voltage" placeholder="Substation Voltage Level(KV)" name="substation_voltage[]"
                                value="">
                                <span name="substation_voltage.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                id="feeder_name" placeholder="Name of Feeder" name="feeder_name[]"
                                value="">
                                <span name="feeder_name.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input  type="number" step="any" class="form-control"
                                id="feeder_voltage" placeholder="Feeder Voltage (KV)" name="feeder_voltage[]"
                                value="">
                                <span name="feeder_voltage.'.($i-1).'"></span>
                        </td>
                        <td>
                            <select name="have_solar_project[]" id="have_solar_project_select'.($i-1).'"  class="form-control">
                                <option value="">~~Select~~</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                            <input type="text" name="solar_park_name[]" id="solar_park_name'.($i-1).'" class="form-control" placeholder="Leave blank if No" value="NA" />
                            <span name="have_solar_project.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input  type="number" step="any" class="form-control"
                                id="ac_voltage" placeholder="AC Voltage" name="ac_voltage[]"
                                value="">
                                <span name="ac_voltage.'.($i-1).'"></span>
                        </td>
                        <td>
                            <input  type="number" step="any" class="form-control"
                                id="dc_voltage" placeholder="DC Voltage" name="dc_voltage[]"
                                value="">
                                <span name="dc_voltage.'.($i-1).'"></span>
                        </td>
                    </tr>';
                    if($i==count($selectedBidderProjectData)){
                        $result.='<tr>
                            <td colspan="12">
                                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success">
                            </td>
                        </tr>';
                    }
                }
                else{
                    $commissionedData=json_decode($data->commissioned_details,true);
                    // dd($commissionedData);
                    $solarprojectname="NA";
                    if($commissionedData['have_solar_project']=='Yes'){
                        $solarprojectname=$commissionedData['solar_park_name'];
                    }
                    // dd($commissionedData);
                    $result.='<tr>
                    <td class="row-index">'.$data->project_title.'</td>
                    <td>'.$data->commissioned_capacity.'</td>
                    <td>'.$commissionedData['project_type'].'</td>
                    <td>'.$commissionedData['module_type'].'</td>
                    <td>'.$commissionedData['module_make'].'</td>
                    <td>'.$commissionedData['substation_name'].'</td>
                    <td>'.$commissionedData['substation_voltage'].'</td>
                    <td>'.$commissionedData['feeder_name'].'</td>
                    <td>'.$commissionedData['feeder_voltage'].'</td>
                    <td>'.$commissionedData['have_solar_project'].'<br> Project Name : '.$solarprojectname.'</td>
                    <td>'.$commissionedData['ac_voltage'].'</td>
                    <td>'.$commissionedData['dc_voltage'].'</td>
                    </tr>';
                }
            
        }
            $result.='</table>';
            return response()->json(['status' => 'success','result'=>$result]);
            
        }
        else{
            $result.='<h3 class="text-danger">Please add Implementation Details</h3>';
        }
        return response()->json(['status' => 'success','result'=>$result]);
        
    }

    
    
}   