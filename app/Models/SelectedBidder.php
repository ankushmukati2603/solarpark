<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectedBidder extends Model
{
    //
    protected $table="tbl_selected_bidder";
    public $timestamps = false;

    protected $fillable = [
        'ppa_psa_date', 'ppa_psa_capacity', 'ppa_psa_signed_state','discom_name','electricity_per_unit_cost','duration_ppa','loi_loa_date'
    ];
    
    static function getSelectedBidderDetails($tender_id){
        return self::select('tbl_selected_bidder.*','tbl_master_bidder.bidder_name','tbl_master_agency.agency_name','tbl_reverse_auction.ra_date')
                    ->leftjoin('tbl_master_bidder', 'tbl_selected_bidder.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_master_bidder.agency_id')
                    ->leftjoin('tbl_reverse_auction', 'tbl_reverse_auction.tender_id', 'tbl_selected_bidder.tender_id')
                    ->where('tbl_selected_bidder.tender_id', $tender_id )
                    ->get();
    }
    
    static function getSelectedBidderData($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder.*','tbl_master_bidder.bidder_name')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder.bidder_id', 'tbl_master_bidder.id')
                    ->where('tbl_selected_bidder.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder.bidder_id', $bidder_id )
                    ->first();
    }

    static function getSelectedBidderData_bk($bidder_id,$tender_id){
        return self::select('tbl_selected_bidder.*','tbl_master_bidder.bidder_name','states.name as ppa_psa_signed_state')
                    ->join('tbl_master_bidder', 'tbl_selected_bidder.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('states','states.code','tbl_selected_bidder.ppa_psa_signed_state')
                    ->where('tbl_selected_bidder.tender_id', base64_decode($tender_id) )
                    ->where('tbl_selected_bidder.bidder_id', $bidder_id )
                    ->first();
    }

    static function getSelectedBidderDetailsByTenders($tender_id){
        return self::select('tbl_selected_bidder.*','tbl_master_bidder.bidder_name','tbl_master_agency.agency_name')
                    ->leftjoin('tbl_master_bidder', 'tbl_selected_bidder.bidder_id', 'tbl_master_bidder.id')
                    ->leftjoin('tbl_master_agency', 'tbl_master_agency.id', 'tbl_master_bidder.agency_id')
                    ->where('tbl_selected_bidder.tender_id', $tender_id )
                    ->get()->toArray();
    }

    
    

}