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
}