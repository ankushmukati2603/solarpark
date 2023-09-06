<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StuReport extends Model
{
    //
    public $table="stu_report";
    public $timestamps = false;

    public static function getMnreUsers($user_id){
       
        $data=self::select('stu_report.*','states.name as state_name','districts.name as district_name')
        ->join('states','states.code','stu_report.state_id')
        ->join('districts','districts.code','stu_report.district_id')
        ->orderBy('stu_report.entry_date', 'desc')
        ->where('stu_report.user_id', $user_id)
        ->get();
       
        return $data;
    }
    public static function getAllStuReports(){
        return self::select('stu_report.*','states.name as state_id','districts.name as district_id','sub_districts.name as sub_district_id','stu_users.name as user_id')
            ->join('states','states.code','stu_report.state_id')
            ->join('districts','districts.code','stu_report.district_id')
            ->join('sub_districts','sub_districts.code','stu_report.sub_district_id')
            ->leftjoin('stu_users','stu_users.id','stu_report.user_id')
            ->where('stu_report.final_submission',1)
            ->get();
    }
    public static function getStuReportById($id){
        return self::select('stu_report.*','states.name as state_id','districts.name as district_id','sub_districts.name as sub_district_id','stu_users.name as user_id')
            ->join('states','states.code','stu_report.state_id')
            ->join('districts','districts.code','stu_report.district_id')
            ->join('sub_districts','sub_districts.code','stu_report.sub_district_id')
            ->leftjoin('stu_users','stu_users.id','stu_report.user_id')
            ->where('stu_report.id',$id)
            ->first();

    }
    // public static function getReportForMnreUsers($id){
       
    //     $data=self::select('stu_report.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_district_id')
    //     ->join('states','states.code','stu_report.state')
    //     ->join('districts','districts.code','stu_report.district_id')
    //     ->join('sub_districts','sub_districts.code','stu_report.sub_district_id')
    //     ->where('stu_report.final_submission',1)
    //     ->where('stu_report.user_id',$id)
    //     ->get();
    //     // dd( $data);
    //     return $data;
    // }
}