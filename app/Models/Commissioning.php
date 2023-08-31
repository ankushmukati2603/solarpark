<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SelectedBidderProject;
use App\Models\Bidder;

class Commissioning extends Model
{
    //
    protected $table="tbl_commissioning";
    public $timestamps = false;

    static function getSelectedBidderComissionedData($bidder_id,$tender_id){
        return self::select('tbl_commissioning.*','tbl_master_bidder.bidder_name')
                    ->join('tbl_master_bidder', 'tbl_commissioning.bidder_id', 'tbl_master_bidder.id')
                    ->where('tbl_commissioning.tender_id', base64_decode($tender_id) )
                    ->where('tbl_commissioning.bidder_id', $bidder_id )
                    ->first();
    }
    static function getProjectDataById($project_id){
        $projectData=array();
        $data= SelectedBidderProject::select('*')->where('id',$project_id )->first()->toArray();
        if($data!=null){
            $projectData['data']=$data;
            $projectData['commissioned_data'] = Commissioning::select('*')->where('project_id',$project_id )->get()->toArray();
            $projectData['commissioned_data_count']=count($projectData['commissioned_data']);
        }
        return $projectData;
    }

    static function getCommissionedDataByTenderId($tender_id){
        $commissionedData=array();$i=0;
        $data= SelectedBidderProject::select('id','bidder_id','project_title','state','schedule_commissiong_date','commissioned_capacity','revised_schedule_commissiong_date')->where('tender_id',$tender_id )->get()->toArray();
        if(count($data)>0){
            foreach($data as $dt){
                $projectData[$i]=$dt;
                $projectData[$i]['state']=State::select('name')->where('code',$dt['state'])->first()['name'];
                $projectData[$i]['bidder_name']=Bidder::select('bidder_name')->where('id',$dt['bidder_id'])->first()['bidder_name'];
                $projectData[$i]['commissionedData'] = Commissioning::where('project_id',$dt['id'])->get()->toArray();
                $i++;
            }
            
        }
        return $projectData;
    }
    

}