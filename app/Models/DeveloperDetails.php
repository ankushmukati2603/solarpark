<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeveloperDetails extends Model
{
    //
    public $table="developer_details";
    public $timestamps = false;
    protected $fillable = [
        'developer_id',
        'name_of_developer',
        'state_id',
        'district_id',
        'address',
        'contact_person_name',
        'contact_no',
        'email',
        'energy_id',
        
       
    ];
}