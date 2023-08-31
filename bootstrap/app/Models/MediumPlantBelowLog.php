<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediumPlantBelowLog extends Model
{
    public $table="medium_plant_upto10_log";
   // public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_state_id',
        'application_id',
        'organization_name',
        'organization_address',
        'project_name',
        'project_address',
        'applications_details',
        'capacity',
        'cattles_details',
        'other_sources',
        'manufacturer_name',
        'required_daily_power',
        'biogas_generation',
        'no_of_plants',
        'operational_hours',
        'actual_cost',
        'project_cost',
        'amount_of_cfa',
        'undertaking',
        'status',
        'sna_remarks',
        'mnre_remarks_by_sna', 
    ];

    static function getByIdSNALog($id){
    return self::where('application_id',$id)->orderBy('id', 'desc')->first();
    }
}
