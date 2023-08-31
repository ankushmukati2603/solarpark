<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\SubDistrict;
use App\Traits\General;
use App\Utils\Responder;
use App\Models\BiogasModel;
use App\Models\InstallationCapacity;
use App\Models\InstallationStatus;
use Illuminate\Support\Facades\Validator;

use Config, Storage, File;

class GeneralController extends Controller
{
    public function __construct(){
        $this->responder = new Responder();
    }

    public function getMetaData(Request $request)
    {
        try{
            $biogasModel = new BiogasModel();
            $models = $biogasModel->getAllBiogasModels();
            $installationCapacity = new InstallationCapacity();
            $capacities = $installationCapacity->getAllInstallationCapacities();
            $installationStatus = new InstallationStatus();
            $statuses = $installationStatus->getAllStatuses();

            $result = [
                'biogas_models' => $models,
                'installation_capacities' => $capacities,
                'categories' => Config::get('constants.categories'),
                'priorities' => Config::get('constants.priority'),
                'slurries' => Config::get('constants.slurries'),
                'bank_account_types' => Config::get('constants.bank_account_types'),
                'statuses' => $statuses
            ];
            return $this->responder->makeResult(true, 1015, $result);
        }
        catch(\Exception $e){
            return $this->responder->makeResult(false, 1001, []);
        }
    }
    public function getDocument($consumerId, $folder, $file, $maintenanceRegistryCode = NULL)
    {
        $dir_path = 'systems/'.base64_decode($consumerId).'/'.base64_decode($folder);
        $dir_path = empty($maintenanceRegistryCode) ? $dir_path.'/'.base64_decode($file) : $dir_path.'/'.base64_decode($maintenanceRegistryCode).'/'.base64_decode($file);
        return Storage::disk('filestore')->download($dir_path);
    }
    public function getImages($imagePath)
    {
        $dir_path = base64_decode($imagePath);
        return Response::download($dir_path);
    }
}
