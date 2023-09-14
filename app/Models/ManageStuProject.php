<?php
 
 namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageStuProject extends Model
{

    protected $table = 'master_stu';
    public $timestamps = false;

    public static function getStuProjectDetails($id){
       
        $data=self::select('master_stu.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_districts_name',
        'villages.name as village_name'
        )
        ->join('states','states.code','master_stu.state')
        ->join('districts','districts.code','master_stu.district')
        ->join('sub_districts','sub_districts.code','master_stu.sub_district')
        ->join('villages','villages.code','master_stu.village')
        ->where('master_stu.user_id',$id)
        ->get();
       
        return $data;
   }
}