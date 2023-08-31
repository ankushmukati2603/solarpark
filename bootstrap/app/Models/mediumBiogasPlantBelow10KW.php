<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mediumBiogasPlantBelow10KW extends Model
{
    //
    public $table="medium_plant_upto10";
    public $timestamps = false;
    public static function getById($id){
        
        $data=self::select('medium_plant_upto10.*')
        ->where('medium_plant_upto10.id',$id);
        return $data->first();
        
    }
}