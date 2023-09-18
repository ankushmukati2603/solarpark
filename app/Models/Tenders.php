<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenders extends Model
{
    //
    protected $table="tbl_master_tender";
    public $timestamps = false;
    protected $fillable = [
        'tender_status', 'mnre_status','mnre_remarks'
    ];
    public static function getTenderDetailsById($tender_id){
        return self::select(
                'tbl_master_tender.*',
                'tbl_cancelled_tender.*',
                'tbl_reverse_auction.*',
                'tbl_master_tender.capacity as tenderCapcity',
                'tbl_cancelled_tender.capacity as c_capacity'
            )
            ->leftjoin('tbl_cancelled_tender', 'tbl_cancelled_tender.tender_id', 'tbl_master_tender.id' )
            ->leftjoin('tbl_reverse_auction','tbl_reverse_auction.tender_id','tbl_master_tender.id')
            ->where('tbl_master_tender.id',$tender_id)
            ->first();
    }
    public static function getAllTendersSNAWise($sna_id){
        return self::select(
                'tbl_master_tender.nit_date',
                'tbl_master_tender.rfs_date',
                'tbl_master_tender.pre_bid_meeting_date',
                'tbl_master_tender.bid_submission_date',
                'tbl_master_tender.id as tid',
                'tbl_master_tender.scheme_type',
                'tbl_master_tender.capacity',
                'tbl_master_agency.agency_name',
                'states.name as state',
                'tbl_cancelled_tender.cancel_date',
                'tbl_reverse_auction.ra_date',
                'tbl_reverse_auction.ra_capacity',
                'tbl_master_tender.capacity as tenderCapcity',
                'tbl_cancelled_tender.capacity as c_capacity',
                'tbl_master_tender.tender_status'
            )
            ->leftjoin('tbl_master_agency','tbl_master_agency.id','tbl_master_tender.agency_id')
            ->leftjoin('states','states.code','tbl_master_agency.state')
            ->leftjoin('tbl_cancelled_tender','tbl_cancelled_tender.tender_id','tbl_master_tender.id')
            ->leftjoin('tbl_reverse_auction','tbl_reverse_auction.tender_id','tbl_master_tender.id')
            ->where('tbl_master_tender.sna_id',$sna_id)
            ->where('tbl_master_tender.tender_status','>',2)
            ->where('tbl_master_tender.tender_status','!=',5)
            ->groupby('tbl_master_tender.id')
            ->get()->toArray();
    }

    public static function getTenderById($tender_id){
        return self::select(
                'tbl_master_tender.*',
                'tbl_master_agency.agency_name',
                'states.name as state',
                'tbl_master_sub_agency.agency_name as sub_agency_name'
            )
            ->leftjoin('tbl_master_agency','tbl_master_tender.agency_id','tbl_master_agency.id')
            ->leftjoin('tbl_master_sub_agency','tbl_master_tender.agency_sub_id','tbl_master_sub_agency.id')
            ->leftjoin('states','states.code','tbl_master_agency.state')
            ->where('tbl_master_tender.id',$tender_id)
            ->first()->toArray();
    }

    public static function getCapacityTenderedList(){
        return self::select(
            'tbl_master_tender.*',
            'state_implementing_agency_users.name as sna_name'
        )
        ->leftjoin('state_implementing_agency_users','state_implementing_agency_users.id','tbl_master_tender.sna_id')
        ->get();
    }
}