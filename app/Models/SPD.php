<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPD extends Model
{
    //
    protected $table="tbl_master_sub_agency";
    public $timestamps = false;

    public static function getSPADAAgencyListById($sna_id){
        return self::select('tbl_master_sub_agency.*','states.name as state_name','districts.name as district_name','tbl_master_agency.agency_name as parent_agency')
                    ->leftjoin('states','states.code','tbl_master_sub_agency.state')
                    ->leftjoin('districts','districts.code','tbl_master_sub_agency.district')
                    ->leftjoin('tbl_master_agency','tbl_master_agency.id','tbl_master_sub_agency.agency_id')
                    // ->where('tbl_master_agency.id',$id)
                    ->where('tbl_master_agency.sna_id',$sna_id)
                    ->paginate(10);
    }

}