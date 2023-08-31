<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReverseAuction extends Model
{
    //
    protected $table="tbl_reverse_auction";
    public $timestamps = false;

    public static function getAllRADetails(){
        return self::select('tbl_reverse_auction.*','tbl_master_tender.tender_no','tbl_master_tender.nit_no','tbl_master_tender.scheme_type','tbl_master_tender.capacity')
                    ->join('tbl_master_tender','tbl_master_tender.id','tbl_reverse_auction.tender_id')
                    ->get()->toArray();
    }

}