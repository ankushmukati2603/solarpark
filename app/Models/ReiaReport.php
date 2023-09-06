<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReiaReport extends Model
{
    //
    public $table="reia_report";
    public $timestamps = false;
    public static function getReiaReport($user_id){
       return self::select('reia_report.*','states.name as state_name','districts.name as district_name','schemes.scheme_name')
            ->leftjoin('states','states.code','reia_report.state_id')
            ->leftjoin('districts','districts.code','reia_report.district_id')
            ->leftjoin('schemes','schemes.id','reia_report.scheme_id')
            ->orderBy('reia_report.created_date', 'desc')
            ->where('reia_report.user_id', $user_id)
            ->get();
    }

    public static function getAllReiaReport(){
        return self::select('reia_report.*','states.name as state_id','districts.name as district_id','schemes.scheme_name as scheme_id','reias.name as reia_name')
            ->leftjoin('states','states.code','reia_report.state_id')
            ->leftjoin('districts','districts.code','reia_report.district_id')
            ->leftjoin('schemes','schemes.id','reia_report.scheme_id')
            ->leftjoin('reias','reias.id','reia_report.reia_id')
            ->where('reia_report.final_submission', 1)
            ->orderBy('reia_report.created_date', 'desc')
            ->get();
    }

    public static function getReiaReportById($reia_id){

        return self::select('reia_report.*','states.name as state_id','districts.name as district_id','schemes.scheme_name as scheme_id','reias.name as reia_name')
            ->leftjoin('states','states.code','reia_report.state_id')
            ->leftjoin('districts','districts.code','reia_report.district_id')
            ->leftjoin('schemes','schemes.id','reia_report.scheme_id')
            ->leftjoin('reias','reias.id','reia_report.reia_id')
            ->where('reia_report.id',$reia_id)
            ->first();
    }
}