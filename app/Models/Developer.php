<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    //
    public $table="developer_master";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'sna_id',
        'name',
        'email',
        'contact_no',
        'address',
        'state_id',
        'district_id',
        'sub_district_id',
        'village',
        'created_at',
        'updated_at',
    ];
}