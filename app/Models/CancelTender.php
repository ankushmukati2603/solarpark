<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelTender extends Model
{
    //
    protected $table="tbl_cancelled_tender";
    public $timestamps = false;

    public static function getAllCancelTenderDetails(){
        return self::select('tbl_cancelled_tender.*','tbl_master_tender.tender_no','tbl_master_tender.nit_no','tbl_master_tender.scheme_type','tbl_master_tender.capacity')
                    ->join('tbl_master_tender','tbl_master_tender.id','tbl_cancelled_tender.tender_id')
                    ->get()->toArray();
    }
    public static function getAllCancelTenderDetailsById($id){
        return self::select('tbl_cancelled_tender.*','tbl_master_tender.tender_no','tbl_master_tender.nit_no','tbl_master_tender.scheme_type',
                'tbl_master_tender.capacity','tbl_master_agency.agency_name','tbl_master_tender.tender_title')
                    ->leftjoin('tbl_master_tender','tbl_master_tender.id','tbl_cancelled_tender.tender_id')
                    ->leftjoin('tbl_master_agency','tbl_master_agency.id','tbl_master_tender.agency_id')
                    ->where('tbl_master_tender.sna_id',$id)
                    ->where('tbl_master_tender.tender_status',5)
                    ->get();
    }
    public static function getAllCancelTenderList(){
        return self::select(
                'tbl_cancelled_tender.*','tbl_master_tender.tender_no','tbl_master_tender.nit_no',
                'tbl_master_tender.scheme_type','tbl_master_tender.capacity','tbl_master_tender.tender_title',
                'state_implementing_agency_users.name as sna_name'
            )
            ->leftjoin('tbl_master_tender','tbl_master_tender.id','tbl_cancelled_tender.tender_id')
            ->leftjoin('state_implementing_agency_users','state_implementing_agency_users.id','tbl_master_tender.sna_id')
            ->get();
    }
}