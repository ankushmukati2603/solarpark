<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class SelectedBidderProject extends Model
{
    //
    protected $table="tbl_selected_bidder_project";
    public $timestamps = false;

    protected $fillable = [
        'ppa_psa_date', 'ppa_psa_capacity', 'ppa_psa_signed_state','discom_name','electricity_per_unit_cost','duration_ppa','loi_loa_date'
    ];
    
    public static function getProjectDetailForTender($tender_id,$bidder_id){
        
        // dd($tender_id.'---------'.$bidder_id);
        return self::select('tbl_selected_bidder_project.*','districts.name as district_id',
        'sub_districts.name as sub_district_id','villages.name as village_id','states.name as state')
                    // ->leftjoin('tbl_master_tender','tbl_master_tender.id','tbl_selected_bidder_project.tender_id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.ppa_psa_signed_state')
                    ->leftjoin('districts','districts.code','tbl_selected_bidder_project.district_id')
                    ->leftjoin('sub_districts','sub_districts.code','tbl_selected_bidder_project.sub_district_id')
                    ->leftjoin('villages','villages.code','tbl_selected_bidder_project.village_id')
                    ->where('tbl_selected_bidder_project.tender_id',$tender_id)
                    ->where('tbl_selected_bidder_project.bidder_id',$bidder_id)
                    // ->where('tbl_selected_bidder_project.bidder_id',$bidder_id)
                    ->get()->toArray();
    }

    public static function getPPAPSADetailForTender(){
        return self::select('tbl_selected_bidder_project.tender_id','tbl_selected_bidder_project.ppa_psa_date','tbl_selected_bidder_project.bidder_id','tbl_master_tender.tender_no',
                        'tbl_master_tender.nit_no','tbl_master_tender.scheme_type','tbl_master_tender.capacity','tbl_master_tender.entry_date')
                    ->join('tbl_master_tender','tbl_master_tender.id','tbl_selected_bidder_project.tender_id')
                    ->whereNotNull('tbl_selected_bidder_project.ppa_psa_date')
                    ->groupby('tbl_selected_bidder_project.tender_id')
                    ->get()->toArray();
    }
    public static function getLOADetailForTender(){
        return self::select('tbl_selected_bidder_project.tender_id','tbl_selected_bidder_project.loi_loa_date','tbl_selected_bidder_project.bidder_id','tbl_master_tender.tender_no',
                        'tbl_master_tender.nit_no','tbl_master_tender.scheme_type','tbl_master_tender.capacity','tbl_master_tender.entry_date')
                    ->join('tbl_master_tender','tbl_master_tender.id','tbl_selected_bidder_project.tender_id')
                    ->whereNotNull('tbl_selected_bidder_project.loi_loa_date')
                    ->groupby('tbl_selected_bidder_project.tender_id')
                    ->get()->toArray();
    }

    public static function getCommissiongDetailsOfTender(){
        return self::select('tbl_selected_bidder_project.tender_id','tbl_selected_bidder_project.schedule_commissiong_date','tbl_selected_bidder_project.bidder_id','tbl_master_tender.tender_no',
                        'tbl_master_tender.nit_no','tbl_master_tender.scheme_type','tbl_master_tender.capacity','tbl_master_tender.entry_date')
                    ->join('tbl_master_tender','tbl_master_tender.id','tbl_selected_bidder_project.tender_id')
                    ->whereNotNull('tbl_selected_bidder_project.commissioned_capacity')
                    ->groupby('tbl_selected_bidder_project.tender_id')
                    ->get()->toArray();
    }

    static function getSelectedBidderProjectData($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','states.name as ppa_psa_signed_state')
                    // ->leftjoin('tbl_selected_bidder','tbl_selected_bidder.bidder_id','tbl_selected_bidder_project.bidder_id')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.ppa_psa_signed_state')
                    ->where('tbl_selected_bidder_project.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder_project.bidder_id', $bidder_id )
                    ->get();
    }
    
    
    static function getSelectedBidderProjectLocationData($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','states.name as state','districts.name as district_id',
                    'sub_districts.name as sub_district_id','villages.name as village_id')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.state')
                    ->leftjoin('districts','districts.code','tbl_selected_bidder_project.district_id')
                    ->leftjoin('sub_districts','sub_districts.code','tbl_selected_bidder_project.sub_district_id')
                    ->leftjoin('villages','villages.code','tbl_selected_bidder_project.village_id')
                    ->where('tbl_selected_bidder_project.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder_project.bidder_id', $bidder_id )
                    ->orderby('tbl_selected_bidder_project.id', 'ASC' )
                    ->get();
    }
    static function getSelectedBidderProjectDetails($tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','tbl_master_agency.agency_name','states.name as state','districts.name as district_id',
                    'st.name as signed_state','tbl_selected_bidder.bidder_selected_date','sub_districts.name as sub_district_id','villages.name as village_id')
                    ->leftjoin('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('tbl_selected_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_selected_bidder.id')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_master_bidder.agency_id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.state')
                    ->leftjoin('states as st','st.code','tbl_selected_bidder_project.ppa_psa_signed_state')
                    ->leftjoin('districts','districts.code','tbl_selected_bidder_project.district_id')
                    ->leftjoin('sub_districts','sub_districts.code','tbl_selected_bidder_project.sub_district_id')
                    ->leftjoin('villages','villages.code','tbl_selected_bidder_project.village_id')
                    ->where('tbl_selected_bidder_project.tender_id', $tender_id )
                    ->get();
    }



    // Report Views
    public static function getBidderBidDetailForTenderByTenderId($tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','tbl_master_agency.agency_name','states.name as state','districts.name as district_id',
                    'st.name as signed_state','tbl_selected_bidder.bidder_selected_date','sub_districts.name as sub_district_id','villages.name as village_id')
                    ->leftjoin('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('tbl_selected_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_selected_bidder.id')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_master_bidder.agency_id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.state')
                    ->leftjoin('states as st','st.code','tbl_selected_bidder_project.ppa_psa_signed_state')
                    ->leftjoin('districts','districts.code','tbl_selected_bidder_project.district_id')
                    ->leftjoin('sub_districts','sub_districts.code','tbl_selected_bidder_project.sub_district_id')
                    ->leftjoin('villages','villages.code','tbl_selected_bidder_project.village_id')
                    ->where('tbl_selected_bidder_project.tender_id', $tender_id )
                    ->get()->toArray();
    }

    static function getSelectedBidderDetails($tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','tbl_master_agency.agency_name','states.name as state','districts.name as district_id',
                    'st.name as signed_state','tbl_selected_bidder.bidder_selected_date','sub_districts.name as sub_district_id','villages.name as village_id')
                    ->leftjoin('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('tbl_selected_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_selected_bidder.id')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_master_bidder.agency_id')
                    ->leftjoin('states','states.code','tbl_selected_bidder_project.state')
                    ->leftjoin('states as st','st.code','tbl_selected_bidder_project.ppa_psa_signed_state')
                    ->leftjoin('districts','districts.code','tbl_selected_bidder_project.district_id')
                    ->leftjoin('sub_districts','sub_districts.code','tbl_selected_bidder_project.sub_district_id')
                    ->leftjoin('villages','villages.code','tbl_selected_bidder_project.village_id')
                    ->where('tbl_selected_bidder_project.tender_id', $tender_id )
                    ->orderby('tbl_selected_bidder_project.id')
                    ->get()->toArray();
    }


    // Under Implementation
    static function getSelectedBidderRecordsById($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','tbl_master_tender.capacity as tender_capacity')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->join('tbl_master_tender', 'tbl_selected_bidder_project.tender_id', 'tbl_master_tender.id')
                    ->where('tbl_selected_bidder_project.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder_project.bidder_id', $bidder_id )
                    ->whereNotNull('tbl_selected_bidder_project.commissioned_capacity')
                    ->get();
    }

    // Commissioned

    static function getSelectedBidderRecordsByImplemented($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder_project.*','tbl_master_bidder.bidder_name','tbl_master_tender.capacity as tender_capacity')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder_project.bidder_id', 'tbl_master_bidder.id')
                    ->join('tbl_master_tender', 'tbl_selected_bidder_project.tender_id', 'tbl_master_tender.id')
                    ->where('tbl_selected_bidder_project.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder_project.bidder_id', $bidder_id )
                    ->whereNotNull('tbl_selected_bidder_project.status_stage_two')  // Adding condition to check Implemented Tenders
                    ->get();
    }
}