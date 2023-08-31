<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediumBiogasPlantAbove10KWLog extends Model
{
     public $table="medium_plant_above10_log";
   // public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_state_id',
        'application_id',
        'organization_name',
        'beneficiary_address',
        'gps',
        'contact_number',
        'state_agency_name',
        'category',
        'generated_power',
        'required_biogas',
        'plant_size',
        'cattles',
        'other_sources',
        'agricultural_waste',
        'raw_material_file',
        'latrine_attached_no',
        'users_no',
        'land_for_plant',
        'commissioning_procurement_detail',
        'power_documents',
        'engine_type',
        'engine_capacity',
        'biogas_engine_file',
        'plant_cost',
        'manure_management',
        'electricity_cost',
        'project_funding',
        'maintenance_funds',
        'undertaking_nodal_ajency',
        'mechanism_to_transfer',
        'manure_management',
        'electricity_cost',
        'project_funding',
        'maintenance_funds',
        'status',
        'sna_remarks',
        'mnre_remarks_by_sna', 
    ];

    static function getByIdSNALog($id){
    return self::where('application_id',$id)->orderBy('id', 'desc')->first();
    }
}
