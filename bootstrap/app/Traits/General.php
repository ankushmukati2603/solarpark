<?php
namespace App\Traits;

use Carbon\Carbon;
use App\Models\State;
use App\Models\AuditTrail;
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
    // public function uploadFile($file, $dir_path, $withDate = '')
    // {
    //     $imagename = $this->generateRandomString().'.'.$file->getClientOriginalExtension();
    //     Storage::disk('filestore')->putFileAs($dir_path, $file, $imagename);
    //     return empty($withDate) ? ['name' => $imagename, 'date' => date('Y-m-d')] : $imagename;
    // }

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
}