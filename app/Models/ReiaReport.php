<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReiaReport extends Model
{
    //
    public $table="reia_report";
    public $timestamps = false;
    public static function getReiaReport(){
        $data=self::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name','tbl_master_bidder.bidder_name')
        ->join('states','states.code','reia_report.state_id')
        ->join('districts','districts.code','reia_report.district_id')
         ->join('schemes','schemes.id','reia_report.scheme_id')
         ->join('tbl_master_bidder','tbl_master_bidder.id','reia_report.bidder_id')
        ->get();
        return $data;
    }
}