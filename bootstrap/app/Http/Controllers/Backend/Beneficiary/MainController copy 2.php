<?php

namespace App\Http\Controllers\Backend\Beneficiary;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use App\Models\State;
use App\Traits\General;
use App\Models\SubDistrict;
use App\Utils\Dashboard;
use App\Models\Consumer;
use App\Models\mediumBiogasPlantBelow10KW;
use App\Models\mediumBiogasPlantAbove10KW;
use Illuminate\Http\Request;
use Auth , Storage;

class MainController extends Controller
{
    //
    use General;
    public function __construct()
    {
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }

    public function index()
    {
        $dashboard=new Dashboard();
        $data=$dashboard->getBeneficiaryDashboardData();
        return view('backend.beneficiary.dashboard',compact('data'));
    }
    public function smallBiogasPlants_bk(Request $request){
        // if($request->isMethod('post')){
            
            
            // try {
            //     if($request->editId){
                    
            //         $consumer=SmallBiogasPlant::find($request->editId); 
            //     }else{
            //         $data=new SmallBiogasPlant();
            //     }
                if($request->isMethod('post')){
                    $validatedData=$request->validate([
                        'name'=>'required',
                        'phone'=>'required',
                        'email'=>'required',
                        'category'=>'required',
                        'state_id'=>'required',
                        'district_id'=>'required',
                        'sub_district_id'=>'required',
                        'block'=>'required',
                        'village'=>'required',
                        'localbody_type'=>'required',
                        'panchayat'=>'required',
                        'ward_no'=>'required',
                        'post'=>'required',
                        'house_no'=>'required',
                        'toilet_linked'=>'required',
                        'existing_biogas_plant'=>'required',
                        'slurry_filter_unit'=>'required',
                        'cattle_available'=>'required',
                        'authorized'=>'required',
                   ]);
                try{
                    if($request->editId){
                        
                        $data=SmallBiogasPlant::find($request->editId); 
                    }else{
                        $data = new SmallBiogasPlant();
                    }
                    $final_submission=0;
                    $massege="Details Saved Successfuly";
                        //condition m agr button per click krega to final submission 1 hoga
                    if(isset($request->final_submission) && $request->final_submission=="Final Submission"){
                        $final_submission=1;
                        // Final Submission button ki value hain  final_submission=name hai bustton ka
                        $massege="Application Submitted";
                    } 
                // $state=State::select('short_name')->where('code',$request->input('state_id'))->first();
                // $name=substr($request->input('name'),0,4);
                // $name= strtoupper($name);
                
                
                //$data->application_id= $value;
                $data->beneficiary_id= Auth::id();
                $data->name=$request->input('name');
                $data->phone=$request->input('phone');
                $data->email=$request->input('email');
                $data->category=$request->input('category');
                $data->state_id=$request->input('state_id');
                $data->district_id=$request->input('district_id');
                $data->sub_district_id=$request->input('sub_district_id');
                $data->block=$request->input('block');
                $data->village=$request->input('village');
                $data->localbody_type=$request->input('localbody_type');
                $data->panchayat=$request->input('panchayat');
                $data->ward_no=$request->input('ward_no');
                $data->post=$request->input('post'); 
                $data->house_no=$request->input('house_no');
                $data->toilet_linked=$request->input('toilet_linked');
                $data->existing_biogas_plant=$request->input('existing_biogas_plant');
                $data->slurry_filter_unit=$request->input('slurry_filter_unit');
                $data->cattle_available=$request->input('cattle_available');
                $data->number_of_cattles=json_encode($request->input('number_of_cattles'));
                $data->comment = $request->input('comment');
                $data->final_submission=$final_submission;
                $data->authorized=$request->input('authorized');
                $data->save();

                $application_id = 'SBP/'.($data->id).'/'.date('Y');
                SmallBiogasPlant::where('id',$data->id)->update(['application_id'=>$application_id]);

                $auditData = array('action_type'=>'2','description'=>$massege,'user_type'=>'0');
                $this->auditTrail($auditData);
                //Email  Fire from system to user
                return redirect()->back()->with("message",$massege);
                // return redirect('/smallBiogasPlants')->with('message', 'User Details Submitted');
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            
        }
        $consumer=array();
        $data=SmallBiogasPlant::select('*')->where('beneficiary_id', Auth::id())->first();
        if($data){
            if($data->final_submission==1){
                $editable = 'disabled';
                $consumer=SmallBiogasPlant::getById($data->id);
                $consumer['number_of_cattles']=json_decode($consumer->number_of_cattles,true);
                //dd($consumer);
                return view('backend.beneficiary.SBPPreview', compact('consumer'));
            }

            $consumer=$data;
            $consumer['number_of_cattles'] = json_decode($consumer->number_of_cattles, true);
            //dd($consumer);
        }
        $auditData = array('action_type'=>'1','description'=>'User Visit Smallbiogasplants form' ,'user_type'=>'0');
        $this->auditTrail($auditData);

        $states=State::orderby("name")->get();
        $sub_districts=SubDistrict::orderby("name")->get();
        return view('backend.beneficiary.smallBiogasPlants', compact('states','sub_districts','consumer'));
    }
    public function smallBiogasPlants(Request $request){
        // if($request->isMethod('post')){
            
            
            // try {
            //     if($request->editId){
                    
            //         $consumer=SmallBiogasPlant::find($request->editId); 
            //     }else{
            //         $data=new SmallBiogasPlant();
            //     }
                if($request->isMethod('post')){
                    $validatedData=$request->validate([
                        'name'=>'required',
                        'phone'=>'required',
                        'email'=>'required',
                        'category'=>'required',
                        'state_id'=>'required',
                        'district_id'=>'required',
                        'sub_district_id'=>'required',
                        'block'=>'required',
                        'village'=>'required',
                        'localbody_type'=>'required',
                        'panchayat'=>'required',
                        'ward_no'=>'required',
                        'post'=>'required',
                        'house_no'=>'required',
                        'toilet_linked'=>'required',
                        'existing_biogas_plant'=>'required',
                        'slurry_filter_unit'=>'required',
                        'cattle_available'=>'required',
                        'authorized'=>'required',
                        'number_of_cattles.*'=>'required'
                   ]);
                try{
                    if($request->editId){
                        
                        $data=Consumer::find($request->editId); 
                    }else{
                        $data = new Consumer();
                    }
                    $final_submission=0;
                    $massege="Details Saved Successfuly";
                        
                    if(isset($request->final_submission) && $request->final_submission=="Final Submission"){
                        $final_submission=1;
                       
                        $massege="Application Submitted";
                    } 
                
                $data->beneficiary_id= Auth::id();
                $data->name=$request->input('name');
                $data->phone=$request->input('phone');
                $data->email=$request->input('email');
                $data->category=$request->input('category');
                $data->state_id=$request->input('state_id');
                $data->district_id=$request->input('district_id');
                $data->sub_district_id=$request->input('sub_district_id');
                $data->block=$request->input('block');
                $data->village=$request->input('village');
                $data->localbody_type=$request->input('localbody_type');
                $data->panchayat=$request->input('panchayat');
                $data->ward_no=$request->input('ward_no');
                $data->post=$request->input('post'); 
                $data->house_no=$request->input('house_no');
                $data->toilet_linked=$request->input('toilet_linked');
                $data->existing_biogas_plant=$request->input('existing_biogas_plant');
                $data->slurry_filter_unit=$request->input('slurry_filter_unit');
                $data->cattle_available=$request->input('cattle_available');
                $data->number_of_cattle=json_encode($request->input('number_of_cattles'));
                $data->comment = $request->input('comment');
                $data->final_submission=$final_submission;
                $data->customer_type='new';
                $data->sna_remarks='NA';
                $data->mnre_remarks_by_sna='NA';
                $data->authorized=$request->input('authorized');
                //dd($data);
                $data->save();

                $application_id = 'SBP/'.($data->id).'/'.date('Y');
                Consumer::where('id',$data->id)->update(['consumer_id'=>$application_id]);

                $auditData = array('action_type'=>'2','description'=>$massege,'user_type'=>'0');
                $this->auditTrail($auditData);
                
                return redirect()->back()->with("message",$massege);
                
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }
            
        }
        $consumer=array();
        $data=Consumer::select('*')->where('beneficiary_id', Auth::id())->first();
        if($data){
            if($data->final_submission==1){
                $editable = 'disabled';
                $consumer=Consumer::getBeneficiaryById($data->id);
                //dd($consumer);
                $consumer['number_of_cattles']=json_decode($consumer->number_of_cattle,true);
                //dd($consumer);
                return view('backend.beneficiary.SBPPreview', compact('consumer'));
            }

            $consumer=$data;
            $consumer['number_of_cattles'] = json_decode($consumer->number_of_cattle, true);
            //dd($consumer);
        }
        $auditData = array('action_type'=>'1','description'=>'User Visit Smallbiogasplants form' ,'user_type'=>'0');
        $this->auditTrail($auditData);

        $states=State::orderby("name")->get();
        $sub_districts=SubDistrict::orderby("name")->get();
        return view('backend.beneficiary.smallBiogasPlants', compact('states','sub_districts','consumer'));
    }



    
    public function mediumBiogasPlantsBelow10KW(Request $request){
       
        if($request->isMethod('post')){
           // dd($request);
            $validatedData=$request->validate([
                'organization_name'=>'required|max:50',
                'organization_address'=>'required |regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'project_name'=>'required|max:50',
                'project_address'=>'required |regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'applications_details'=>'required',
                'capacity'=>'required',
                //'cattles_details'=>'required',
                //'other_sources'=>'required',
                'manufacturer_name'=>'required',
                'required_daily_power'=>'required',
                'biogas_generation'=>'required',
                'no_of_plants'=>'required',
                'operational_hours'=>'required',
                'actual_cost'=>'required|numeric|min:0|digits_between:1,12',
                'project_cost'=>'required|numeric|min:0|digits_between:1,12',
                'amount_of_cfa'=>'required|numeric|min:0|digits_between:1,15',
                'undertaking'=>'required_if:editId,0|mimes:pdf|max:1024',
                'authorized'=>'required',
                //'cattles_details.*' => 'required',
                'cattles_details.*'=>'required',
                //'other_sources.*' =>'required',
                'other_sources.*'=>'required',
            ],[
                'organization_address.regex'=>'Special Character not allowed',
                'project_address.regex'=>'Special Character not allowed',
                'organization_name.max'=>'Organization name must be less then 50 Characters',
                'project_name.max'=>'Organization name must be less then 50 Characters',
                'undertaking.mimes'=>'Only PDF format is allowed',
                'undertaking.required_if'=>'Please upload undertaking',
                'cattles_details.*.required' => 'This fields are required',
                'other_sources.*.required' =>'This fields are required'
            ]);
            try {



            if($request->editId){
                $data=mediumBiogasPlantBelow10KW::find($request->editId);
            }else{
                $data=new mediumBiogasPlantBelow10KW();
            }$final_submission=0;
            $massege="Details Saved Successfuly";
            if(isset($request->final_submission) && $request->final_submission=="Final Submission"){
                $final_submission=1;
                $massege="Application Submitted";
            } 
                // $prefix="MBIO";
                // $number=mediumBiogasPlantBelow10KW::max('id');
                // $name=substr($request->input('project_name'),0,4);
                // $name= strtoupper($name);
                // $ldate = date('Y');
                //$value = $prefix.'/'.$ldate.'/'.($number+1);
                //$value = $prefix.'/'.($number+1).'/'.$ldate;
               
                //$data->application_id= $value;
                $data->beneficiary_id=Auth::id();
                $data->organization_name=$request->input('organization_name');
                $data->organization_address=$request->input('organization_address');
                $data->project_name=$request->input('project_name');
                $data->project_address=$request->input('project_address');
                $data->applications_details=$request->input('applications_details');
                $data->capacity=$request->input('capacity');
                $data->cattles_details=json_encode($request->input('cattles_details'));
                $data->other_sources=json_encode($request->input('other_sources'));
                $data->manufacturer_name=$request->input('manufacturer_name');
                $data->required_daily_power=$request->input('required_daily_power');
                $data->biogas_generation=$request->input('biogas_generation');
                $data->no_of_plants=$request->input('no_of_plants');
                $data->operational_hours=$request->input('operational_hours');
                $data->actual_cost=$request->input('actual_cost');
                $data->project_cost=$request->input('project_cost');
                $data->amount_of_cfa=$request->input('amount_of_cfa');
                $data->final_submission=$final_submission;
                $data->authorized=$request->input('authorized');
                //dd($data);
                
                $dir_path = 'systems\\BioDocument\\';
                Storage::disk('filestore')->makeDirectory($dir_path);
                if($request->hasFile('undertaking')){
                    $file= $this->uploadFile($request->file('undertaking'), $dir_path);
                    $data->undertaking=$file['name'];
                }
                $data->save();

                $application_id = 'MBP/'.($data->id).'/'.date('Y');
                mediumBiogasPlantBelow10KW::where('id',$data->id)->update(['application_id'=>$application_id]);
                $auditData = array('action_type'=>'2','description'=>$massege,'user_type'=>'0');
                $this->auditTrail($auditData);
                // dd($data);
                return redirect()->back()->with("message",$massege);
                // return redirect('/mediumBiogasPlants')->with('message', 'User Details Submitted');
            } catch (\Throwable $th) {
                
                dd($th->getMessage());
            }
        }
                $consumer=array();
                $data=mediumBiogasPlantBelow10KW::select('*')->where('beneficiary_id',Auth::id())->first();
                if($data){
                    
                    if($data->final_submission==1){
                        $editable = 'disabled';
                        $consumer=mediumBiogasPlantBelow10KW::getById($data->id);
                        $consumer['cattles_details']=json_decode($consumer->cattles_details,true);
                        $consumer['other_sources']=json_decode($consumer->other_sources,true);
                        //dd($consumer);
                        return view('backend.beneficiary.MBPPreviewupto10kw', compact('consumer'));
                    }
                    $consumer=$data;
                    //dd($consumer);
                    $consumer['cattles_details']=json_decode($consumer->cattles_details,true);
                    $consumer['other_sources']=json_decode($consumer->other_sources,true);
                }
        
        $auditData = array('action_type'=>'1','description'=>'User Visit mediumBiogasPlants1 form' ,'user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.beneficiary.upto10KWMediumPlant',compact('consumer'));
    }





    public function mediumBiogasPlantsAbove10KW(Request $request){
        if($request->isMethod('post')){
           //dd($request);
            $validatedData=$request->validate([
                'beneficiary_name'=>'required|max:50',
                'beneficiary_address'=>'required |regex:/(^[-0-9A-Za-z.,\/ ]+$)/',
                'gps'=>'required',
                'contact_number'=>'required',
                'state_agency_name'=>'required',
                'category'=>'required',
                'generated_power'=>'required',
                'required_biogas'=>'required',
                'plant_size'=>'required',
                'cattles'=>'required',               
                'other_sources'=>'required',
                'agricultural_waste'=>'required',
                
                'raw_material_file'=>'required_if:editId,0|mimes:pdf',
                'latrine_attached_no'=>'required',
                'users_no'=>'required',
                'land_for_plant'=>'required',
                'commissioning_procurement_detail'=>'required_if:editId,0|mimes:pdf',
                'quantum_power'=>'required',
                'power_documents'=>'required_if:editId,0|mimes:pdf',
                'engine_type'=>'required',
                'engine_capacity'=>'required',
                'biogas_engine_file'=>'required_if:editId,0|mimes:pdf',
                'plant_cost'=>'required',
                'manure_management'=>'required',
                'electricity_cost'=>'required',
                'project_funding'=>'required_if:editId,0|mimes:pdf',
                'maintenance_funds'=>'required',
                'undertaking_nodal_ajency'=>'required_if:editId,0|mimes:pdf',
                'mechanism_to_transfer'=>'required',
                'project_information'=>'required',
                'undertaking'=>'required_if:editId,0|mimes:pdf',
                'authorize'=>'required',
                'cattles.*' => 'required',
                'other_sources.*' =>'required',
            ],
            [
                'cattles.*.required' => 'This fields are required',
                'other_sources.*.required' =>'This fields are required'
            ]
            );
            try{
            if($request->editId){
                $data=mediumBiogasPlantAbove10KW::find($request->editId);
            }else{
                $data=new mediumBiogasPlantAbove10KW();
            }
            $final_submission=0;
            $massege="Details Saved Successfuly";
            if(isset($request->final_submission) && $request->final_submission=="Final Submission"){
                $final_submission=1;
                $massege="Application Submitted";
            }  
                // $prefix="MBP";
                // $number=mediumBiogasPlantAbove10KW::max('id');
                //dd($number+1);
                // $name=substr($request->input('beneficiary_name'),0,4);
                // $name= strtoupper($name);
                // $ldate = date('Y');
                //$value = $prefix.'/'.$ldate.'/'.($number+1);
                // $value = $prefix.'/'.($number+1).'/'.$ldate;
            //dd($request);
           
            $data->beneficiary_name=$request->input('beneficiary_name');
            $data->beneficiary_id=Auth::id();
           // $data->application_id= $value;
            $data->beneficiary_address=$request->input('beneficiary_address');
            $data->gps=$request->input('gps');
            $data->contact_number=$request->input('contact_number');
            $data->state_agency_name=$request->input('state_agency_name');
            $data->category=$request->input('category');
            $data->generated_power=$request->input('generated_power');
            $data->required_biogas=$request->input('required_biogas');
            $data->plant_size=$request->input('plant_size');
            $data->cattles=json_encode($request->input('cattles'));
            $data->other_sources=json_encode($request->input('other_sources'));
            $data->agricultural_waste=$request->input('agricultural_waste');
            $data->latrine_attached_no=$request->input('latrine_attached_no');
            $data->users_no=$request->input('users_no');
            $data->land_for_plant=$request->input('land_for_plant');
            $data->quantum_power=$request->input('quantum_power');
            $data->engine_type=$request->input('engine_type');
            $data->engine_capacity=$request->input('engine_capacity');
            $data->plant_cost=$request->input('plant_cost');
            $data->manure_management=$request->input('manure_management');
            $data->electricity_cost=$request->input('electricity_cost');
            $data->maintenance_funds=$request->input('maintenance_funds');
            $data->mechanism_to_transfer=$request->input('mechanism_to_transfer');
            $data->project_information=$request->input('project_information');
            $data->final_submission=$final_submission;
            $data->authorize=$request->input('authorize');
            //dd($data);
            $dir_path = 'systems\\BiogasAbove10KW\\';
            Storage::disk('filestore')->makeDirectory($dir_path);
            if($request->hasFile('raw_material_file')){
                $file= $this->uploadFile($request->file('raw_material_file'), $dir_path);
                $data->raw_material_file=$file['name'];
            }
            if($request->hasFile('commissioning_procurement_detail')){
                $file= $this->uploadFile($request->file('commissioning_procurement_detail'), $dir_path);
                $data->commissioning_procurement_detail=$file['name'];
               
            }
            if($request->hasFile('power_documents')){
                $file= $this->uploadFile($request->file('power_documents'), $dir_path);
                $data->power_documents=$file['name'];
               
            }
            if($request->hasFile('biogas_engine_file')){
                $file= $this->uploadFile($request->file('biogas_engine_file'), $dir_path);
                $data->biogas_engine_file=$file['name'];
               
            }
            if($request->hasFile('project_funding')){
                $file= $this->uploadFile($request->file('project_funding'), $dir_path);
                $data->project_funding=$file['name'];
               
            }
            if($request->hasFile('undertaking_nodal_ajency')){
                $file= $this->uploadFile($request->file('undertaking_nodal_ajency'), $dir_path);
                $data->undertaking_nodal_ajency=$file['name'];
               
            }
            if($request->hasFile('undertaking')){
                $file= $this->uploadFile($request->file('undertaking'), $dir_path);
                $data->undertaking=$file['name'];
               
            }
            $data->save();

            $application_id = 'MBP/'.($data->id).'/'.date('Y');
            mediumBiogasPlantAbove10KW::where('id',$data->id)->update(['application_id'=>$application_id]);

            
            $auditData = array('action_type'=>'2','description'=>$massege,'user_type'=>'0');
            $this->auditTrail($auditData);
            return redirect()->back()->with("message",$massege);
           // return redirect('/mediumBiogasPlantsAbove10KW')->with('message', 'User Details Submitted');
        } catch (\Throwable $th) {
            
            dd($th->getMessage());
        }
        }
        $consumer=array();
        $data=mediumBiogasPlantAbove10KW::select('*')->where('beneficiary_id',Auth::id())->first();
        if($data){
                    
            if($data->final_submission==1){
                $editable = 'disabled';
                $consumer=mediumBiogasPlantAbove10KW::getById($data->id);
                $consumer['cattles']=json_decode($consumer->cattles,true);
                $consumer['other_sources']=json_decode($consumer->other_sources,true);
                //dd($consumer);
                return view('backend.beneficiary.MBPPreviewabove10kw', compact('consumer'));
            }
            $consumer=$data;
            $consumer['cattles']=json_decode($consumer->cattles,true);
            $consumer['other_sources']=json_decode($consumer->other_sources,true);
        }
        
        // if($data->final_submission==1){
        //     $editable = 'disabled';
        //     $consumer=mediumBiogasPlantAbove10KW::getById($data->id);
        //     $consumer['cattles']=json_decode($consumer->cattles,true);
        //     $consumer['other_sources']=json_decode($consumer->other_sources,true);
        //     //dd($consumer);
        //     return view('backend.beneficiary.MBPPreviewabove10kw', compact('consumer'));
        // }



        // $consumer=$data;
        // $consumer['cattles']=json_decode($consumer->cattles,true);
        // $consumer['other_sources']=json_decode($consumer->other_sources,true);
       //dd($_SERVER);
        $auditData = array('action_type'=>'1','description'=>'User Visit mediumBiogasPlants2 form' ,'user_type'=>'0');
        $this->auditTrail($auditData);
        return view('backend.beneficiary.above10KWMediumPlant',compact('consumer'));
    }

    public function previewDocs($folder, $file, $maintenanceRegistryCode = NULL)
    {
        $filePath = 'systems/'.$folder.'/'.$file;
        // $filePath = empty($maintenanceRegistryCode) ? $filePath.'/'.$file : $filePath.'/'.$maintenanceRegistryCode.'/'.$file;
        return view('auth.preview', compact('filePath'));
    }
    
}