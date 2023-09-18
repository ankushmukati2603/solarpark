<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageSolarPark extends Model
{

    protected $table = 'master_solarpark';
    public $timestamps = false;


    public static function getSolarParkDevDetails($id){
       
        $data=self::select('master_solarpark.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_districts_name','villages.name as village_name'
        )
        ->join('states','states.code','master_solarpark.state')
        ->join('districts','districts.code','master_solarpark.district')
        ->join('sub_districts','sub_districts.code','master_solarpark.sub_district')
        ->join('villages','villages.code','master_solarpark.village')
        ->where('master_solarpark.user_id',$id)
        ->paginate(10);
       
        return $data;
   }

    public static function getAllSolarPrk(){
       
        $data=self::select(
            'master_solarpark.*','states.name as state_name','districts.name as district_name',
            'sub_districts.name as sub_districts_name','villages.name as village_name',
            'beneficiary.name as beneficiary_name'
        )
        ->leftjoin('states','states.code','master_solarpark.state')
        ->leftjoin('districts','districts.code','master_solarpark.district')
        ->leftjoin('sub_districts','sub_districts.code','master_solarpark.sub_district')
        ->leftjoin('villages','villages.code','master_solarpark.village')
        ->leftjoin('beneficiary','beneficiary.id','master_solarpark.user_id')
        ->get();
       
        return $data;
   }

}