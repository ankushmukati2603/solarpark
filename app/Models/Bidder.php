<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    //
    protected $table="tbl_master_bidder";
    public $timestamps = false;

    public static function getBidderDetailsById($sna_id){
        return self::select('tbl_master_bidder.*','tbl_master_agency.agency_name','states.name as state_name',
                    'districts.name as district_name','tbl_master_sub_agency.agency_name as spd_name')
                    ->leftjoin('states','states.code','tbl_master_bidder.state')
                    ->leftjoin('districts','districts.code','tbl_master_bidder.district')
                    ->leftjoin('tbl_master_agency','tbl_master_agency.id','tbl_master_bidder.agency_id')
                    ->leftjoin('tbl_master_sub_agency','tbl_master_sub_agency.id','tbl_master_bidder.agency_sub_id')
                    ->where('tbl_master_bidder.sna_id',$sna_id)
                    ->paginate(5);
    }

    public static function getBidderListById($sna_id){
        return self::select('tbl_master_bidder.bidder_name','tbl_master_bidder.id','states.name as state_name')
                    ->leftjoin('states','states.code','tbl_master_bidder.state')
                    // ->leftjoin('districts','districts.code','tbl_master_bidder.district')
                    // ->leftjoin('tbl_master_agency','tbl_master_agency.id','tbl_master_bidder.agency_id')
                    // ->leftjoin('tbl_master_sub_agency','tbl_master_sub_agency.id','tbl_master_bidder.agency_sub_id')
                    ->where('tbl_master_bidder.sna_id',$sna_id)
                    ->get();
    }

    
   

}