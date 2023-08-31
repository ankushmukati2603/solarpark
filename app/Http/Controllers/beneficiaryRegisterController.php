<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\Otp;
use App\Traits\General;
use App\Models\Beneficiary;
use App\Models\SolarBeneficiary;
use App\Models\StateImplementingAgencyUser;
use App\Models\StuUser;
use Hash,Validator;

class beneficiaryRegisterController extends Controller
{
    use General;
    
    public function userRegistration(Request $request)
    {
        
        if($request->isMethod('post')){
            $scheValidate='';$panValidate='';$emailValidate='required';
            if($request->usertype==1){ //SNA
                $scheValidate='required';
                $emailValidate='required|email|unique:state_implementing_agency_users';
            }
            if($request->usertype==2){ //STU
                $scheValidate='';
                $emailValidate='required|email|unique:stu_users';
            }
            if($request->usertype==3){ //SPPD
                $panValidate='required';
                $emailValidate='required|email|unique:beneficiary';
            }
            
           $validation = Validator::make($request->all(), [
                'usertype'=>'required',
                'name'=>'required|regex:/^[a-zA-Z ]+$/u',
                'scheme_name'=>$scheValidate,
                'pan_no'=>$panValidate,
                'contact_no'=>'required|max:10|min:10',
                'address'=>'required|regex:/^[a-zA-Z.,-_ ]+$/u',
                'state_id'=>'required',
                'email'=>$emailValidate,
                'district_id'=>'required|integer|gt:0',
                // 'sub_district_id'=>'required|integer|gt:0',
                // 'village'=>'required|integer|gt:0',
            ],[
                'usertype.required'=>'This field is required',
                // 'scheme_name.required'=>'This field is required',
                // 'pan_no.required'=>'This field is required',
                // 'contact_no.required'=>'This field is required',
            ]
            );
            // dd($data);
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
          try {
                $password = Hash::make('123456');
            
                
                if($request->usertype==1){ //SNA
                    $developer=new StateImplementingAgencyUser();
                    $developer->program_id= $request->input('scheme_name'); 
                    $developer->phone=$request->input('contact_no');
                    $message="Your Account Created Successfully. You will get Login details after approval on email.";   
                }
                if($request->usertype==2){ //STU
                    $developer=new StuUser();
                    $developer->phone=$request->input('contact_no');
                    $message="Your Account Created Successfully. Please check Login details on your email.";   
                }
                if($request->usertype==3){ //SPPD
                    $developer=new SolarBeneficiary();
                    $developer->pan_no= $request->input('pan_no');
                    $developer->contact_no=$request->input('contact_no');
                    $message="Your Account Created Successfully. You will get Login details after approval on email.";   
                }
                
                $developer->name= $request->input('name');
                
                $developer->address= $request->input('address');
                $developer->email= $request->input('email');
                $developer->password= $password;
                $developer->state_id=$request->input('state_id');
                $developer->district_id=$request->input('district_id');
                $developer->save();
                
                if($request->usertype==2){
                    // shoot email
                }
                $url=urlencode('/');
                return response()->json(['status' => 'success','message'=>$message,'url'=>$url,'redirect'=>'yes']); 

                // return redirect('/user-registration')->with('message', 'Your Account Created Successfully');
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
    public function SeciLogIn(){
       
        return view('secilogin');
    }
    public function gecadminLogIn(){
       
        return view('gecadminLogIn');
    }
}