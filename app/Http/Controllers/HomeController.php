<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Village;
use App\Traits\General;
use App\Models\Consumer;
use App\Models\SubDistrict;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail,Validator;

class HomeController extends Controller
{
    use General;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function consumerInterestForm(Request $request)
    {
        if($request->isMethod('get')){
            $sub_districts = SubDistrict::all();
            return view('frontend.consumerInterestForm', compact('sub_districts'));
        }

        elseif($request->isMethod('post')){
            try {
                $consumer = new Consumer();
                $consumer->consumer_id = $this->generateIdForStakeholders('CON', $request->state_id);//traits (general.php) main function bnaya Hai generateIdForStakeholder
                $consumer->name = $request->name;
                $consumer->house_no = $request->house_no;
                //$data->columnname = $request->formvariableName
                $consumer->village = $request->village;
                $consumer->post = $request->post;
                $consumer->block = $request->block;
                $consumer->panchayat = $request->panchayat;
                $consumer->ward_no = $request->ward_no;
                $consumer->sub_district_id = $request->sub_district_id;
                $consumer->district_id = $request->district_id;
                $consumer->state_id = $request->state_id;
                $consumer->phone = $request->phone;
                $consumer->aadhar_no = base64_encode($request->aadhar_no);
                $consumer->email = $request->email;
                $consumer->category = $request->category;
                $consumer->number_of_cattle = json_encode($request->cattles);
                $consumer->toilet_linked = $request->toilet_linked;
                $consumer->existing_biogas_plant = $request->existing_biogas_plant;
                $consumer->subsidy_availed = $request->subsidy_availed;
                $consumer->comment = $request->comment;
                $consumer->date_of_reg = date("d-m-Y");
                $isSaved = $consumer->save();
                if($isSaved){
                    Session::flash('msg', ['status' => 'Success', 'msg' => "Your interest has been successfully submitted. We will contact you soon!"]);
                    return redirect('/');
                }
            } catch (\Throwable $th) { // throwable class hai catch ki
                return redirect()->back()->with("error","Server Error !");
            }
        }
    }
    // public function testSandes(){
    //     $sandesData=$this->sendSandesOTP('123456','fufytufytgfv');
    //    // dd($sandesData);
    // }
    

    public function feedback(Request $request)
  
    {       

        if($request->isMethod('post')){
            // dd($request);
            $validation = Validator::make($request->all(), [
                'name'=>'required|regex:/^[a-zA-Z ]+$/u',
                'contact_no'=>'required|max:10|min:10',
                'email'=>'required|email',
                'scheme_type'=>'required|integer|gt:0|lt:3',
                'feedback_type'=>'required|integer|gt:0|lt:3',
                'message'=>'required|regex:/^[a-zA-Z.,_ ]+$/u',
                'subject'=>'required|regex:/^[a-zA-Z.,_ ]+$/u',
            ],
            [
              'feedback_type.gt'=>'Please Select Valid Type',  
              'feedback_type.lt'=>'Please Select Valid Type',  
              'scheme_type.gt'=>'Please Select Valid Type',  
              'scheme_type.lt'=>'Please Select Valid Type', 
              ]
            );
            if ($validation->fails()){  //check all validations are fine, if not then redirect and show error messages
                return response()->json(['status'=>'verror','data'=>$validation->errors()]);
            }
            try {
                $data = new Feedback();
                $data->name = $request->name;
                $data->contact_no = $request->contact_no;
                $data->email = $request->email;
                $data->scheme_type = $request->scheme_type;
                $data->message = $request->message;
                $data->subject = $request->subject;
                $data->feedback_type =$request->feedback_type;
                $data->save();
                $url=urlencode('/feedback');
                return response()->json(['status' => 'success','message'=>'Thank you for contacting, we will contact very soon','url'=>$url,'redirect'=>'yes']); 
                    // return response()->json(['status' => 'success','message'=>'Thank you for contacting, we will contact very soon','url'=>'no','redirect'=>'yes']); 
            } catch (\Throwable $th) { 
                return response()->json(['status' => 'error','message'=>"Server Error !".$th->getMessage()]); 
                return redirect()->back()->with("error","Server Error !".$th->getMessage());
            }
        }
        return view('frontend.feedback');
    }











}