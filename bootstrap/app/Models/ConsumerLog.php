<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsumerLog extends Model
{
    public $table="consumers_log";
   // public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_state_id',
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
        'ward_no',
        'house_no',
        'post',
        'toilet_linked',
        'existing_biogas_plant',
        'slurry_filter_unit',
        'cattle_available',
        'number_of_cattles',
        'comment',
        'sna_remarks',
        'status',
    ];

    static function getByIdSNALog($id){
    return self::where('application_id',$id)->orderBy('id', 'desc')->first();
    }
}
