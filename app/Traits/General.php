<?php
namespace App\Traits;

use Carbon\Carbon;
use App\Models\State;
use App\Models\AuditTrail;
use App\Models\Tenders;
use App\Models\Agency;
use App\Models\TenderTimeLine;
use App\Models\ActionNotification;
use App\Models\SelectedBidder;
use App\Models\SelectedBidderProject;

use Illuminate\Support\Facades\Crypt;
use DB, File, Mail, Log, Auth;
use Illuminate\Support\Facades\Storage;

trait General
{
    public function log($message, $data)
    {
        Log::info($message." ".$data);
        Log::info("****************************************************************************************************");
    }
    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function print($array=null)
    {
        echo "<pre>";print_r($array);die;
    }

    public function execSP($SP, $params)
    {
        $data = json_decode(json_encode(DB::select('CALL '.$SP, $params)), true);
        return $data;
    }

    public function sendMail($emailFile, $data, $email, $subject)
    {
        $data['mail_to'] = $email;
        $data['subject'] = $subject;
        Mail::send('emails.'.$emailFile, $data, function($mail) use ($data) {
            $mail->to($data['mail_to'])
                    ->subject($data['subject']);
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
    }

    public function sendSms($message, $number)
    {
        $message = rawurlencode($message);
        $server = env('SMS_SERVER');
        $username = env('SMS_USERNAME');
        $pin = rawurlencode(env('SMS_PIN'));
        $signature = env('SMS_SIGNATURE');

        $url = 'https://'.$server.'/failsafe/HttpLink?username='.$username.'&pin='.$pin.'&message='.$message.'&mnumber=91'.$number.'&signature='.$signature;

        $connection = curl_init();

        curl_setopt($connection, CURLOPT_URL, $url);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($connection);
        curl_close($connection);

        if($data)
            return TRUE;
        else
            return FALSE;
    }

    public function passwordPolicyTest($string)
    {
        if(
            preg_match('/(?=[A-Z][^A-Z]*)/', $string) && // Atleast 2 uppercase
            preg_match('/(?=[a-z][^a-z]*)/', $string) && // Atleast 1 lowercase
            preg_match('/(?=[0-9][^0-9]*)/', $string) && // Atleast 1 digit
            preg_match('/(?=[\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E\x80-\xFF][^\x20-\x2F\x3A-\x40\x5B-\x60\x7B-\x7E\x80-\xFF]*)/', $string) // Atleast 2 special characters
        )
            return TRUE;
        else
            return FALSE;
    }
    public function uploadFile($file, $dir_path, $prefix='')
    {
        $randomNumber = time();
        $customName = $prefix."_".Auth::user()->id.'_'.$randomNumber.'.'.$file->getClientOriginalExtension();
        $imagename = empty($prefix) ? ($this->generateRandomString().'.'.$file->getClientOriginalExtension()) : $customName;
        Storage::disk('filestore')->putFileAs($dir_path, $file, $imagename);
        return !empty($prefix) ? ['name' => $imagename, 'date' => date('Y-m-d')] : $imagename;
    }
    public function encodeid($id){
        if($id!=''){
            $encrypted = Crypt::encryptString($id);
            return $encrypted;
            $hashids = new Hashids('almmnisemnre',10);
            return $hashids->encode($id);
        }
        
    }
    public function decodeid($id){
        if($id!=''){
            $decrypted = Crypt::decryptString($id);
            
            return $decrypted;
            $hashids = new Hashids('almmnisemnre',10);
            if(!empty($hashids->decode($id))){
                return $hashids->decode($id)[0];
            }
            abort('404');
        }
    }

    public function generateIdForStakeholders($prefix, $stateCode)
    {
        $state = State::where('code', $stateCode)->value('short_name');
        return $prefix.'-'.$state.'-'.date('Ymd').'-'.rand(10,100);
    }
    //Added By Ekta Mewade on 13 July 2022, 9:51 AM
    function sendSandesOTP($mobile,$message){
        //return array("status" => "error","message" => 'Test Function');
        //return array("status" => "success","message" => 'OTP message has been sent. Please check the Sandes App in the mobile.');
        $message= urlencode($message);
        $agent='Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';
        $url='http://localhost:8021/send?receiverid='.$mobile.'&msg='.$message .'';
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false); //765abcde98
        $curl_output = curl_exec($ch);
        if(curl_errno($ch))
        {
            $status = array("status" => "error","message" => 'Sandes OTP failed to sent message to '.$mobile.' Error:' . curl_error($ch));
        }
        
        curl_close($ch);
        $output = json_decode($curl_output, true);
        if($output['status'] == "success"){
            $status = array("status" => "success","message" => 'OTP message has been sent. Please check the Sandes App in the mobile.');
        }else if($output['status'] == "error"){
            if($output['code'] == "GEN016"){ 
                $status = array("status" => "error","message" => 'Message could not be sent as User is not registered in the Sandes Mobile App. Kindly installed Sandes App in the mobile.');
            }else{
                $status = array("status" => "success","message" => $output['message']);
            }
        }else{
            $status = array("status" => "success","message" => "Message could not sent. Please contact itsupport-mnre@nic.in");
        }
        return $status;     
    }
    //Added By Ekta Mewade on 14 July 2022, 9:51 AM
    public function auditTrail($data){
        $login_user_id = 0;
        $user_id = Auth::id();
        if(!empty($user_id)){  $login_user_id = $user_id; }
    
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
            $browser =  'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Edg') !== FALSE) //For Supporting IE 11
            $browser =  'Microsoft Edge';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
            $browser =  'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
            $browser =  'Mozilla Firefox';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
            $browser =  'Google Chrome';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
            $browser =  "Opera Mini";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
            $browser =  "Opera";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
            $browser =  "Safari";
        else
            $browser =  'Something else';
            
            $auditTrail= new AuditTrail;
            $auditTrail->user_id=$login_user_id;
            $auditTrail->module_name=$_SERVER['REQUEST_URI'];
            $auditTrail->device=$browser;
            $auditTrail->ip_address=$_SERVER['REMOTE_ADDR'];
            $auditTrail->entry_date=date('Y-m-d H:i:s');
            $auditTrail->action_type=$data['action_type'];
            $auditTrail->description=$data['description'];
            $auditTrail->user_type=$data['user_type'];
            $auditTrail->save();
    }
    public function generateOtp(){
        return rand(100000,999999);
    }
    public function getCurruntDate(){
        date_default_timezone_set('Asia/Kolkata');
        return date('Y-m-d H:i:s');
    }

    public function tenderTimeline($data){
        try {
            //code... 
                $checkData=TenderTimeLine::where('tender_id',$data['tender_id'])->where('action_type',$data['action_type'])->count();
                if($checkData==0){
                    $agencyId=Tenders::select('agency_id','agency_sub_id')->where('id',$data['tender_id'])->first();
                    $agencyState=Agency::select('state')->where('id',$agencyId->agency_id)->first();
                    $tenderTimeline= new TenderTimeLine;
                    $tenderTimeline->entry_date=$this->getCurruntDate();
                    $tenderTimeline->tender_id=$data['tender_id'];
                    $tenderTimeline->agency_id=$agencyId->agency_id;
                    $tenderTimeline->sub_agency_id=$agencyId->agency_sub_id;
                    $tenderTimeline->state_id=$agencyState->state;
                    $tenderTimeline->action_description=$data['action_description'];
                    $tenderTimeline->action_type=$data['action_type'];
                    $tenderTimeline->action_date=$data['action_date'];
                    $tenderTimeline->save();
                }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }
    public function actionNotification($data){
    try {
        //code... 
        $actionNotification= new ActionNotification;
            $actionNotification->updated_at=$this->getCurruntDate();
            $actionNotification->to_id=$data['to_id'];//sna/beneficiary/mnre
            $actionNotification->from_id=Auth::id();//mnre
            $actionNotification->to_user_type=$data['to_user_type'];
            $actionNotification->from_user_type=Auth::getDefaultDriver();
            $actionNotification->notification_description=$data['notification_description'];

            $actionNotification->status=0;
            $actionNotification->save();
    } catch (\Throwable $th) {
        //throw $th;
        dd($th->getMessage());
    }
           
    }
    public function dateFormat($date){
        return date('d M Y',strtotime($date));
    }
    public function checkCommissionedData($tender_id){
        $arrayData=array();$i=0;
        $data = SelectedBidder::where('tender_id',$tender_id)->get();
        $status='success';
        foreach($data as $dt){
            $cnt=SelectedBidderProject::where('bidder_id',$dt->bidder_id)->where('tender_id',$tender_id)->count();
            if($cnt==0){
                $status='error';
            }
        }
        return $status;
        // Checking whether all location details has been filled by bidder
    }
    public function tenderStatus($status,$tender_id){
        $stateCode='';
        $countLocations=SelectedBidderProject::where('tender_id',$tender_id)->count();
        $countCommissionedLocations=SelectedBidderProject::where('tender_id',$tender_id)->whereNotNull('commissioned_details')->count();
        $checkLocationFilledByBidderStatus=$this->checkCommissionedData($tender_id);
        if($status==1){
            $stateCode='<span class="badge bg-primary">Draft Tender</span>';
        }elseif($status==2){
            $stateCode='<span class="badge bg-info">Under Implementation</span>';
        }elseif($status==3){
            $stateCode='<span class="badge bg-warning">Implemented</span>';
        }elseif($status==4){
            if($countLocations>$countCommissionedLocations && $countCommissionedLocations!=0 && $checkLocationFilledByBidderStatus=='success'){
                // checkComissionedStatus=='success' Means all location filled by bidder to check for partial commissioned status   
                $stateCode='<span class="badge bg-success">Partially Commissioned</span>';
            }else{
                $stateCode='<span class="badge bg-success">Commissioned</span>';
            }
        }elseif($status==5){
            $stateCode='<span class="badge bg-danger">Cancelled</span>';
        }elseif($status==6){
            $stateCode='<span class="badge bg-success">Partially Commissioned</span>';
        }
        echo $stateCode;
    }
}