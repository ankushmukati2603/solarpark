<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Beneficiary extends Authenticatable
{
    //
    protected $table = 'beneficiary';
    public $timestamps = false;
    protected $fillable = [
        'contact_number',
        'email',
        'name',
    ];

public static function getMnreUsers(){
       
    $data=self::select('beneficiary.*','states.name as state_name','districts.name as district_name'
    )
    ->join('states','states.code','beneficiary.state_id')
    ->join('districts','districts.code','beneficiary.district_id')
    // ->join('sub_districts','sub_districts.code','beneficiary.sub_district_id')
    // ->join('villages','villages.code','beneficiary.village')
    ->orderby('beneficiary.id','DESC')
    ->get();
   
    return $data;
}

}