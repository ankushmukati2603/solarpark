<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarProject extends Model
{
    public $table="solar_project";
    public $timestamps = false;
    protected $fillable = [
        'developer_id',
        'unique_id',
        'shareholding',
        'latitude',
        'longitude',
        'area_of_land_holding',
        'type_project',
        'tarrif',
        'capacity',
        'discom_id',
        'quantam_of_sale_of_power',
        'ppa_tenure',
    ];

    static function getSolarData(){
        //return self::
        return self::select('solar_project.*','energy.energy_type','developer_details.name_of_developer','discom_tbl.discom_name','districts.name as district_name','states.name as state_name')
                    // Jo column tables se fetch krna hai
                    ->join('energy', 'energy.id', 'solar_project.energy_id')
                    // Jis table pr join lagana hai or dono table ki common field/value mention krni
                    ->join('developer_details','developer_details.id','solar_project.developer_id')
                    ->join('discom_tbl','discom_tbl.id','solar_project.discom_id')
                    ->join('districts','districts.code','solar_project.district_id')
                    ->join('states','states.code','solar_project.state_id')
                    ->get();
    }
}