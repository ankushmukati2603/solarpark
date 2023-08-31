<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallBiogasPlant extends Model
{
    //
    public $table="consumers";
    public $timestamps = false;
    protected $fillable = [
                  'application_id',
                  'name',
                  'phone',
                  'email',
                  'category',
                  'state_id',
                  'district_id',
                  'sub_district_id',
                  'block',
                  'village',
                  'localbody_type',
                  'panchayat', 
    ];
    static function getSmallBiogasData(){
        //return self::
        return self::select('small_plant.*','states.name as state_name')
                    ->join('states','states.code','small_plant.state_id')
                    ->get();
    }
    public static function getById($id){
        
        $data=self::select('small_plant.*','states.name as state_name','districts.name as district_name','sub_districts.name as sub_districts_name','blocks.name as blocks_name','villages.name as village_name'
        ,'localbodies.localbody_name as localbody_name','wards.ward_name')
        ->join('states','states.code','small_plant.state_id')
        ->join('districts','districts.code','small_plant.district_id')
        ->join('sub_districts','sub_districts.code','small_plant.sub_district_id')
        ->join('blocks','blocks.code','small_plant.block')
        ->join('villages','villages.code','small_plant.village')
        ->join('localbodies','localbodies.code','small_plant.panchayat')
        ->join('wards','wards.code','small_plant.ward_no')
        ->where('small_plant.id',$id);
        return $data->first();
        
    }
}