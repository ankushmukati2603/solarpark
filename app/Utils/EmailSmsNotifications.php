<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Consumer;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\Installation;
use App\Models\Inspection;
use App\Models\MaintenanceRegistry;
use App\Models\StateImplementingAgencyUser;

use Auth, Log;

class EmailSmsNotifications
{
    use General;
    public function __construct(){}

    public function notifyAgencyRegistration($email, $password, $uniqueId, $agencyName)
    {
        try{
            $data['password'] = $password;
            $data['unique_id'] = $uniqueId;
            $data['agency_name'] = $agencyName;
            $this->sendMail('notifySNARegistration', $data, $email, 'Biogas Application Portal: Implementing Agency Registration Successful');
        }//notifyAgencyRegistration= blade page ka name h $data main kuch bhi pass kr skte h jo hame chahiye
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInstallerRegistration($email, $password, $uniqueId, $name, $mobile)
    {
        try{
            $data['password'] = $password;
            $data['unique_id'] = $uniqueId;
            $data['name'] = $name;
            $text = 'You have been successfully registered in the Biogas application portal. Your unique registration no. for the portal is: '.$uniqueId.'. The details of your account have been sent on your email.';
            $this->sendMail('notifyInstallerRegistration', $data, $email, 'Biogas Application Portal: Installer Registration Successful');
            $this->sendSms($text, $mobile);
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyLocalbodyRegistration($email, $password, $uniqueId, $name, $mobile)
    {
        try{
            $data['password'] = $password;
            $data['unique_id'] = $uniqueId;
            $data['name'] = $name;
            $text = 'You have been successfully registered in the Biogas application portal. Your unique registration no. for the portal is: '.$uniqueId.'. The details of your account have been sent on your email.';
            $this->sendMail('notifyLocalbodyRegistration', $data, $email, 'Biogas Application Portal: Localbody Registration Successful');
            $this->sendSms($text, $mobile);
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInstallerAssociation($siaID, $installerId)
    {
        try{
            $data['sia'] = StateImplementingAgencyUser::where('id', $siaID)->value('name');
            $installer = Installer::select('name','email','phone')->where('id', $installerId)->first();
            $data['installer'] = $installer['name'];
            $notifyAcceptanceToCustomer = 'You have been selected by the implementing agencies to work in their states for NNBOMP programme. For more details check your email.';
            $this->sendMail('notifyInstallerAssociation', $data, $installer['email'], 'Biogas Application Portal: Installer Association Successful');
            $this->sendSms($notifyAcceptanceToCustomer, $installer['phone']);
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyAcceptanceToCustomer($consumerId)
    {
        $consumer = Consumer::select('name','phone')->where('id', $consumerId)->first();
        $sia = StateImplementingAgencyUser::where('id', Auth::id())->value('name');
        $text = 'Dear '.$consumer['name'].',%nWe are happy to inform you that your interest form has been accepted by '.$sia;
        $this->sendSms($text, $consumer['phone']);
    }
    public function notifyAcceptanceToInstaller($installationId)
    {
        $installation = Installation::select(['installers.name as installer_name',
                                        'installers.email as installer_email',
                                        'consumers.name as consumer_name',
                                        'consumers.email',
                                        'consumers.phone',
                                        'consumers.house_no',
                                        'consumers.village',
                                        'consumers.post',
                                        'consumers.block',
                                        'consumers.panchayat',
                                        'consumers.ward_no',
                                        'sub_districts.name as sub_district_name',
                                        'districts.name as district_name',
                                        'states.name as state_name'])
                                        ->where('installations.id', $installationId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('consumers','consumers.id','installations.consumer_id')
                                        ->leftjoin('sub_districts','sub_districts.code','consumers.sub_district_id')
                                        ->leftjoin('districts','districts.code','consumers.district_id')
                                        ->leftjoin('states','states.code','consumers.state_id')
                                        ->first();
        $data = [
            'consumer_name' => $installation->consumer_name,
            'installer_name' => $installation->installer_name,
            'email' => $installation->email,
            'phone' => $installation->phone,
            'house_no' => $installation->house_no,
            'village' => $installation->village,
            'post' => $installation->post,
            'block' => $installation->block,
            'panchayat' => $installation->panchayat,
            'ward_no' => $installation->ward_no,
            'sub_district_name' => $installation->sub_district_name,
            'district_name' => $installation->district_name,
            'state_name' => $installation->state_name
        ];
        $this->sendMail('notifyAcceptanceToInstaller', $data, $installation['installer_email'], 'Biogas Application Portal: Installer Assigned');
    }
    public function notifyInstallationAcceptance($installtionId)
    {
        try{
            $installation = Installation::select('installers.name as installer_name','installations.bpmr_no','state_implementing_agency_users.name as agency_name','installers.email')
                                        ->where('installations.id', $installtionId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('state_implementing_agency_users','installations.state_implementing_agency_id','state_implementing_agency_users.id')
                                        ->first();
            
            $data['installer'] = $installation['installer_name'];
            $data['agency'] = $installation['agency_name'];
            $data['system_code'] = $installation['bpmr_no'];
            $this->sendMail('notifyInstallationAcceptance', $data, $installation['email'], 'Biogas Application Portal: System Accepted ['.$installation['bpmr_no'].']');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifySIAFeedbacks($installtionId, $review, $docs)
    {
        try{
            $installation = Installation::select('installers.name as installer_name','installations.bpmr_no','state_implementing_agency_users.name as agency_name','installers.email')
                                        ->where('installations.id', $installtionId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('state_implementing_agency_users','installations.state_implementing_agency_id','state_implementing_agency_users.id')
                                        ->first();
            
            $data['installer'] = $installation['installer_name'];
            $data['agency'] = $installation['agency_name'];
            $data['system_code'] = $installation['bpmr_no'];
            $data['review'] = $review;
            $data['docs'] = $docs;
            $this->sendMail('notifySIAFeedbacks', $data, $installation['email'], 'Biogas Application Portal: Modification Feedback ['.$installation['bpmr_no'].']');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInpectorRegistration($email, $password, $uniqueId, $name)
    {
        try{
            $data['password'] = $password;
            $data['unique_id'] = $uniqueId;
            $data['name'] = $name;
            $this->sendMail('notifyInpectorRegistration', $data, $email, 'Biogas Application Portal: Inspector Registration Successful');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInspectorAssignmentToProject($installtionId)
    {
        try{
            $installation = Installation::select([
                                            'inspectors.name as inspector_name',
                                            'installers.name as installer_name',
                                            'installers.email as installer_email',
                                            'installers.installer_id',
                                            'consumers.name as consumer_name',
                                            'consumers.consumer_id as consumer_code',
                                            'installations.bpmr_no',
                                            'inspectors.email'
                                        ])->where('installations.id', $installtionId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('inspectors','inspectors.id','installations.inspector_id')
                                        ->leftjoin('consumers','consumers.id','installations.consumer_id')
                                        ->first();
            
            $data['inspector'] = $installation['inspector_name'];            
            $data['installer'] = $installation['installer_name'];
            $data['installer_code'] = $installation['installer_id'];
            $data['consumer'] = $installation['consumer_name'];
            $data['system_code'] = $installation['bpmr_no'];
            $data['consumer_code'] = $installation['consumer_code'];
            $this->sendMail('notifyInspectorAssignmentToProject', $data, $installation['email'], 'Biogas Application Portal: Inspection Assignment');
            $this->sendMail('notifyInstallerAssignmentToProject', $data, $installation['installer_email'], 'Biogas Application Portal: Inspection Assignment');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInspectionFeedback($installationId, $comments)
    {
        try{
            $installation = Installation::select('installers.name as installer','installations.bpmr_no','installers.email','state_implementing_agency_users.email as agency_email')
                                        ->where('installations.id', $installationId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('state_implementing_agency_users','state_implementing_agency_users.id','installations.state_implementing_agency_id')
                                        ->first();

            $data['installer'] = $installation['installer'];
            $data['systemID'] = $installation['bpmr_no'];
            $data['comments'] = $comments;
            $this->sendMail('notifyInspectionFeedback', $data, $installation['email'], 'Biogas Application Portal: Inspection Feedbacks ['.$data['systemID'].']');
            $this->sendMail('notifyInspectionFeedbackToSNA', $data, $installation['agency_email'], 'Biogas Application Portal: Inspection Feedbacks ['.$data['systemID'].']');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifyInspectionApproval($installationId)
    {
        try{
            $installation = Installation::select('installers.name as installer','installations.bpmr_no','installers.email','state_implementing_agency_users.email as agency_email')
                                        ->where('installations.id', $installationId)
                                        ->leftjoin('installers','installers.id','installations.installer_id')
                                        ->leftjoin('state_implementing_agency_users','state_implementing_agency_users.id','installations.state_implementing_agency_id')
                                        ->first();

            $data['installer'] = $installation['installer'];
            $data['systemID'] = $installation['bpmr_no'];
            $this->sendMail('notifyInspectionApproval', $data, $installation['email'], 'Biogas Application Portal: System approved in inspection ['.$data['systemID'].']');
            $this->sendMail('notifyInspectionApprovalToSNA', $data, $installation['agency_email'], 'Biogas Application Portal: System approved in inspection ['.$data['systemID'].']');
        }
        catch(\Exception $e){
            Log::info($e);
        }
    }
    public function notifySystemApproval($installationId)
    {
        $installation = Installation::select([
                                        'consumers.name as consumer_name',
                                        'consumers.email as consumer_email',
                                        'installers.name as installer',
                                        'installers.email as installer_email',
                                        'installations.bpmr_no',
                                        'state_implementing_agency_users.name as agency_name'
                                    ])->leftjoin('consumers','consumers.id','installations.consumer_id')
                                    ->leftjoin('installers','installers.id','installations.installer_id')
                                    ->leftjoin('state_implementing_agency_users','state_implementing_agency_users.id','installations.state_implementing_agency_id')
                                    ->where('installations.id', $installationId)
                                    ->first();

        $data['systemID'] = $installation['bpmr_no'];
        $data['consumer_name'] = $installation['consumer_name'];
        $data['installer'] = $installation['installer'];
        $data['agency_name'] = $installation['agency_name'];

        $this->sendMail('notifySystemApprovalToConsumer', $data, $installation['consumer_email'], 'Biogas Application Portal: System approved ['.$data['systemID'].']');
        $this->sendMail('notifySystemApprovalToInstaller', $data, $installation['installer_email'], 'Biogas Application Portal: System approved ['.$data['systemID'].']');
    }
}