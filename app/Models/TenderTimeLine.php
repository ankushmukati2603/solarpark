<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenderTimeLine extends Model
{
    //
    protected $table="tbl_tender_timeline";
    public $timestamps = false;

    public static function getTenderTimeLine(){
        return self::select('tbl_tender_timeline.*','tbl_master_agency.agency_name','states.name as state','tbl_master_tender.tender_no','tbl_master_sub_agency.agency_name as sub_agency_name')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_tender_timeline.agency_id')
                    ->leftjoin('tbl_master_sub_agency', 'tbl_master_sub_agency.id', 'tbl_tender_timeline.sub_agency_id')
                    ->leftjoin('states','states.code','tbl_master_agency.state')
                    ->leftjoin('tbl_master_tender','tbl_master_tender.id','tbl_tender_timeline.tender_id')
                    ->get()->toArray();
    }
    public static function getTenderTimeLineByFilter($state = null, $agency = null, $tender_id = null,$fromdate=null,$todate=null){
        // dd($state);
        $query =self::select('tbl_tender_timeline.*','tbl_master_agency.agency_name','states.name as state','tbl_master_tender.tender_no')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_tender_timeline.agency_id')
                    ->leftjoin('states','states.code','tbl_master_agency.state')
                    ->leftjoin('tbl_master_tender','tbl_master_tender.id','tbl_tender_timeline.tender_id');
                    
        if($state){
            $query->where('tbl_tender_timeline.state_id', $state);
        }
        if($agency){
            $query->where('tbl_tender_timeline.agency_id', $agency);
        }
        if($tender_id){
            $query->where('tbl_tender_timeline.tender_id', $tender_id);
        }
        if($fromdate){
            $query->where('tbl_tender_timeline.action_date','>', $fromdate);
        }
        if($todate){
            $query->where('tbl_tender_timeline.action_date','>', $todate);
        }
                    

        return $query->get()->toArray();
    }

   
}