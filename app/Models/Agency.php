<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    //
    protected $table="tbl_master_agency";
    public $timestamps = false;

    public static function getAgencyDetailsById($sna_id){
        return self::select('tbl_master_agency.*','states.name as state_name','districts.name as district_name')
                    ->join('states','states.code','tbl_master_agency.state')
                    ->join('districts','districts.code','tbl_master_agency.district')
                    // ->where('tbl_master_agency.id',$id)
                    ->where('tbl_master_agency.sna_id',$sna_id)
                    ->paginate(10);
    }
    public static function getAgencyDataByTenderId($tender_id){
        return self::select('tbl_master_agency.agency_name','states.name as state_name')
        ->join('states','states.code','tbl_master_agency.state')
        ->join('tbl_master_tender','tbl_master_tender.agency_id','tbl_master_agency.id')
        ->where('tbl_master_tender.id',$tender_id)
        ->groupby('tbl_master_agency.agency_name')
        ->first()->toArray();
    }

}