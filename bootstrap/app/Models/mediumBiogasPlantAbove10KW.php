<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mediumBiogasPlantAbove10KW extends Model
{
    public $table="medium_plant_above10";
    public $timestamps = false;
    public static function getById($id)
    {
        $query = self::select(
            'medium_plant_above10.*')
            ->where('medium_plant_above10.id', $id);
            return $query->first();
    }
}