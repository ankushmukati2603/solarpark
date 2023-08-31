<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inspector;
use App\Utils\Responder;
use App\Models\Installation;
use Illuminate\Http\Request;
use App\Models\Consumer;
use App\Models\Inspection;
use App\Models\InstallationReviewLog;
use App\Traits\General;
use App\Policies\ApiPolicy;
use App\Http\Resources\InspectionDetailsResource;
use App\Utils\EmailSmsNotifications;
use Validator;

class InspectorController extends Controller
{
    use General;
    private $dir_path;
    public function __construct(){
        $this->responder = new Responder();
        $this->apiPolicy = new ApiPolicy();
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function getProfile(Request $request)
    {
        try{
            $inspector = Inspector::getUserProfile($request->user['id']);
            if($inspector)
                return $this->responder->makeResult(true, 1004, $inspector);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function getInspectionList(Request $request)
    {
        try
        {
            $validation = Validator::make($request->all(), ['list_type' => 'required','limit' => 'required','offset' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            $inspections = [];
            switch ($request->list_type){
                case 'pending':
                    $inspections = Installation::getInspections($request, [5, 7]);
                break;
                case 'approved':
                    $inspections = Installation::getInspections($request, [8, 9, 10]);
                break;
            }
            $messageCode = 1017;

            if(!count($inspections))
                $messageCode = 1018;

            return $this->responder->makeResult(true, $messageCode, ['inspections' => $inspections['inspections'], 'total_inspections' => $inspections['count']]);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function getInspectionDetail(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), ['inspection_id' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);

            if($this->apiPolicy->verifyInspectionOwner($request->user['id'], $request->inspection_id))
                return $this->responder->makeResult(false, 4002, []);

            $inspections = new InspectionDetailsResource(Inspection::getInspectionDetails($request->inspection_id));
            $messageCode = 1011;

            if($inspections)
                $messageCode = 1022;

            return $this->responder->makeResult(true, $messageCode, $inspections);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function updateInspectionDetail(Request $request)
    {
        $validation = Validator::make($request->all(), $this->inspectionDetailValidations());
        if($validation->fails())
            return $this->responder->makeResult(true, 1007, []);

        if($this->apiPolicy->verifyInspectionOwner($request->user['id'], $request->insp_id))
            return $this->responder->makeResult(false, 4002, []);

        try{
            $inspectionInfo = Inspection::select('consumers.consumer_id','installations.id','inspections.inspection_id','inspections.inspector_id','consumers.state_id')
                                        ->where('inspections.id', $request->insp_id)
                                        ->leftjoin('installations','installations.id','inspections.installation_id')
                                        ->leftjoin('consumers', 'consumers.id','installations.consumer_id')
                                        ->first();
            
            $this->dir_path = 'systems\\'.$inspectionInfo->consumer_id.'\\inspection\\';
            
            $inspectionData = $this->updateInspection($request, $inspectionInfo);
            Installation::where('id', $inspectionInfo->id)->update(['installation_status' => $request->approval == 1 ? 8 : 9,'approval_date' => date('Y-m-d')]);
            if($request->approval == 0){
                InstallationReviewLog::insert([
                    'installation_id' => $inspectionInfo->id,
                    'review_type' => 'I',
                    'review_action' => 'MD',
                    'docs' => json_encode([]),
                    'review' => $request->corrections,
                    'created_by' => $inspectionInfo->inspector_id,
                ]);
                $this->emailSmsNotifications->notifyInspectionFeedback($inspectionInfo->id, $request->corrections);
            }
            else
               $this->emailSmsNotifications->notifyInspectionApproval($inspectionInfo->id);
            if(!$inspectionData){
                $messageCode = 1011;
            }
            $messageCode = 1019;
            return $this->responder->makeResult(true, $messageCode, []);;
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    protected function inspectionDetailValidations()
    {
        return [
            'date_of_inspection' => 'required',
            'pic_of_plant_with_family_member' => 'file|mimes:jpg,jpeg,png',
            'pic_of_stove_with_flame' => 'file|mimes:jpg,jpeg,png'
        ];
    }
    protected function updateInspection($request, $inspectionInfo)
    {
        $inspectionDataArray = [
            'date' => date('Y-m-d', strtotime($request->date_of_inspection)),
            'appropriate_location' => $request->appropriate_location,
            'beneficiary_feeding_plant' => $request->beneficiary_feeding_plant,
            'biogas_production_optimum_level' => $request->biogas_production_optimum_level,
            'plant_connected_to_pipeline' => $request->plant_connected_to_pipeline,
            'biogas_used_at_kitchen' => $request->biogas_used_at_kitchen,
            'optimum_quantity_of_biogas_slurry_produced' => $request->optimum_quantity_of_biogas_slurry_produced,
            'slurry_used_for_agriculture_business' => $request->slurry_used_for_agriculture_business,
            'recommendations' => $request->recommendations,
            'approval' => $request->approval
        ];
        if($request->approval == 0){
            $validation = Validator::make($request->all(), ['corrections' => 'required']);
            if($validation->fails())
                return $this->responder->makeResult(true, 1007, []);
        }
        if($request->approval == 1){
            $inspectionDataArray['approval_date'] = date('Y-m-d');
        }
        if($request->hasFile('pic_of_stove_with_flame')){
            $inspectionDataArray['pic_of_stove_with_flame'] = json_encode($this->uploadFile($request->file('pic_of_stove_with_flame'), $this->dir_path));
        }
        if($request->hasFile('pic_of_plant_with_family_member')){
            $inspectionDataArray['pic_of_plant_with_family_member'] = json_encode($this->uploadFile($request->file('pic_of_plant_with_family_member'), $this->dir_path));
        }

        if(empty($inspectionInfo->inspection_id))
            $inspectionDataArray['inspection_id'] = $this->generateIdForStakeholders('INS', $inspectionInfo->state_id);

        if(Inspection::select('id')->where('id', $request->insp_id)->first()){
            Inspection::where('id', $request->insp_id)->update($inspectionDataArray);
            return true;
        }
        return false;
    }
}
