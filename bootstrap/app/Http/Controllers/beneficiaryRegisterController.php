<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\Otp;
use App\Traits\General;
use App\Models\Beneficiary;
use App\Models\SolarBeneficiary;
use Hash;

class beneficiaryRegisterController extends Controller
{
    use General;
    
    public function userRegistration(Request $request)
    {
        
        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'name'=>'required',
                'pan_no'=>'required',
                'contact_no'=>'required|unique:beneficiary',
                'address'=>'required',

                'state_id'=>'required',
                'email'=>'required',
                'district_id'=>'required',
                'sub_district_id'=>'required',
                'village'=>'required',
                //'captcha'=>'required|captcha'
            ],[
                //'captcha.captcha'=>'captcha validation failed'
            ]);
          try {
            $password = Hash::make('123456');
            $email=$request->input('email');
            $contact=$request->input('contact_no');
           
            $developer=new SolarBeneficiary();
            $developer->name= $request->input('name');
            $developer->pan_no= $request->input('pan_no');
            $developer->contact_no=$request->input('contact_no');
            $developer->address= $request->input('address');
            $developer->email= $email;
            $developer->password= $password;
            $developer->state_id=$request->input('state_id');
            $developer->district_id=$request->input('district_id');
            $developer->sub_district_id=$request->input('sub_district_id');
            $developer->village=$request->input('village');
            $developer->save();
            // return redirect('/user-registration')->with('message', 'Please Wait for admin to Verify Your Account');
            return redirect('/user-registration')->with('message', 'Your Account Created Successfully');
          } catch (\Throwable $th) {
                //throw $th;
                 dd($th->getMessage());
         }
    }
            $stateData=State::orderby("name")->get();
            $districtData=District::orderby("name")->get();  
            return view('userRegistration',compact('stateData','districtData'));

    }
    public function sendOTP(Request $request){

            $phone=$request->number;
            $data=SolarBeneficiary::where('contact_no',$phone)->first();
            if(!$data){
                    Otp::where('otp_title', $phone)->delete();
                    // $otpPhone=$this->generateOtp();
                    $otpPhone= 123456 ;
                    $otpDataPhone= new Otp();
                    $otpDataPhone->otp_title=$phone;
                    $otpDataPhone->otp=$otpPhone;
                    $otpDataPhone->otp_type='P';
                    $otpDataPhone->save();
                    if($otpDataPhone){
                        // $message="OTP is ".$otpPhone." for registration";
                        // $this->sendSms($message, $phone);
                        return response()->json(['status'=>'success','massage'=>'OTP Send']);
                    }
                return response()->json(['status'=>'error','massage'=>'OTP not Send']);  
            }
           return response()->json(['status'=>'error','massage'=>'User already registered']);  
            

    }

    public function verifyOTP(Request $request){
        $phone=$request->number;
        $otp=$request->otp;
        $data=Otp::where('otp_title',$phone)->where('otp',$otp)->first();
        if($data){
            return response()->json(['status'=>'success','massage'=>'OTP Verification successfull. Please submit now']);
        }
        return response()->json(['status'=>'error','massage'=>'OTP  verification failed']); 
    }

    
    public function loginOtp(Request $request){
        $phone=$request->number;
        $data=SolarBeneficiary::where('contact_no',$phone)->first();
        if($data){
            Otp::where('otp_title', $phone)->delete();
            // $otpPhone=$this->generateOtp();
            $otpPhone= 123456 ;
            $otpDataPhone= new Otp();
            $otpDataPhone->otp_title=$phone;
            $otpDataPhone->otp=$otpPhone;
            $otpDataPhone->otp_type='P';
            $otpDataPhone->save();
            return response()->json(['status'=>'success','massage'=>'OTP Send']);
        }
        return response()->json(['status'=>'error','massage'=>'User not registered']); 

    }


    public function userOTPVerified(Request $request){
        $phone=$request->number;
        $otp=$request->otp;
        $data=Otp::where('otp_title',$phone)->where('otp',$otp)->first();
        if($data){
            
            return response()->json(['status'=>'success','massage'=>'OTP Verification successfull']);
        }
        return response()->json(['status'=>'error','massage'=>'OTP  verification failed']); 
    }
    
    public function UserLogIn(){

        return view('userLogIn');
    }
    public function UserLogInType(){
        return view('UserLogInType');
    }
    public function adminLogIn(){
        return view('mnreLogin');
    }
}