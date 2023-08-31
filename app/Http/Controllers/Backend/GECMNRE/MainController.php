<?php

namespace App\Http\Controllers\Backend\GECMNRE;
use App\Utils\EmailSmsNotifications;
use App\Http\Controllers\Controller;
use App\Traits\General;
use App\Utils\Dashboard;
use App\Models\GecReport;
use Illuminate\Http\Request;
use Auth;
class MainController extends Controller
{
    //
    use General;
    public function __construct(){
        $this->emailSmsNotifications = new EmailSmsNotifications();
    }
    public function index(){
        
        $dashboard=new Dashboard();
        $data="";
        $auditData = array('action_type'=>'1','description'=>'User Visit Dashboard Page','user_type'=>'7');
        $this->auditTrail($auditData);
        return view('backend.gecdeveloper.dashboard',compact('data'));
    }
    public function gecProgressReport(Request $request){
        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'date'=>'required',
            ]);
            $fromdata=$request->input('date');
            $todata=$request->input('date');
            $state=$request->input("state");
            $district=$request->input("district_id");
            $park_name=$request->input("park_name");
            $capacity=$request->input("capacity");
            $progressDetails=array();
            $i=0;

            $reportQuery=GecReport::whereBetween('entry_date', [$fromdata.' 00:00:00' , $todata.' 23:59:59']);
            if($request->state !=''){
                $reportQuery->orWhere('state',$state);
            }
            if($request->district_id !=''){
                $reportQuery->orWhere('district_id',$district);
            }
            if($request->park_name !=''){
                $reportQuery->orWhere('park_name','like', '%' . $park_name. '%');
            }
            if($request->capacity !=''){
                $reportQuery->orWhere('capacity',$capacity);
            }
            $reportQuery->orderBy("entry_date",'DESC');
            $progressData=$reportQuery->get();
                foreach($progressData as $data){$i++;
                    if($data['final_submission']==1){

                        $decodeData=json_decode($data['general'],true);
                        $progressDetails[$i] = $data;
                        // $progressDetails[$i]['state_name'] =State::where('code',$decodeData['state'])->first()['name'];
                        // $progressDetails[$i]['district_name'] =District::where('code',$decodeData['district'])->first()['name'];
                    }
                }
                $auditData = array('action_type'=>'1','description'=>'User Search Progress Report Data','user_type'=>'1');
                $this->auditTrail($auditData);
                // $states = State::orderby('name')->get();
                return view('backend.gecmnre.searchgecReport',compact('progressDetails'));
        }
        $auditData = array('action_type'=>'1','description'=>'User Visit Progress Report Page','user_type'=>'1');
        $this->auditTrail($auditData);
        $progressDetails=array();
        // $states = State::orderby('name')->get();
        return view('backend.gecmnre.searchgecReport',compact('progressDetails'));
    }
    public function previewgecReport(Request $request, $id=NULL){
        if($request->isMethod('post')){
            if($request->editId){
                GecReport::where('id',$request->editId)->update([
                'status'=>$request->status,
                'gecmnre_remark'=>$request->gecremark]);
                $auditData = array('action_type'=>'3','description'=>'GEC Update User Remark','user_type'=>'1'); $this->auditTrail($auditData);
                $url=urlencode('/'.Auth::getDefaultDriver().'/preview-gec-report/'.$request->editId);
                return response()->json(['status' => 'success','message'=>'GEC Remark saved successfuly!','next'=>$request->next,'url'=>$url,'redirect'=>'yes']); 
            } 
        }
        $color="yellow";
        $progressDetailspreview=GecReport::where('id',$id)->first();
        if($progressDetailspreview->status==1){
            $color="green";
        }elseif($progressDetailspreview->status==2){
            $color="orange"; 
        }elseif($progressDetailspreview->status==3){
            $color="red"; 
        }

        $auditData = array('action_type'=>'1','description'=>'User view Preview Progress Report','user_type'=>'1');
        $this->auditTrail($auditData);
        // $previousprogressReport=ProgressReport::select($type)->where('month',($month-1))->where('year',$year)->where('user_id',Auth::id())->first();
        return view('backend.gecmnre.previewGECReport',compact('progressDetailspreview','id','color'));
    }
}