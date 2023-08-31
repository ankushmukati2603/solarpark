<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageSolarPark extends Model
{
    //
    protected $table = 'master_solarpark';
    public $timestamps = false;


    public static function getSolarParkDevDetails(){
       
        $data=self::select('master_solarpark.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_districts_name','villages.name as village_name'
        )
        ->join('states','states.code','master_solarpark.state')
        ->join('districts','districts.code','master_solarpark.district')
        ->join('sub_districts','sub_districts.code','master_solarpark.sub_district')
        ->join('villages','villages.code','master_solarpark.village')->get();
       
        return $data;
    }

}