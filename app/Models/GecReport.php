<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GecReport extends Model
{
    //
    public $table="gec_report";
    public $timestamps = false;

    public static function getMnreUsers(){
       
        $data=self::select('progress_report.*','states.name as state_name','districts.name as district_name')
        ->join('states','states.code','progress_report.state')
        ->join('districts','districts.code','progress_report.district')
       
        ->get();
       
        return $data;
    }
    public static function getReportForMnreUsers(){
       
        $data=self::select('progress_report.*','states.name as state_name','districts.name as district_name')
        ->join('states','states.code','progress_report.state')
        ->join('districts','districts.code','progress_report.district')
        ->where('progress_report.final_submission',1)
        ->get();
       
        return $data;
    }
}