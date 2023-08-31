<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Energy extends Model
{
    //
    public $table="energy";
    public $timestamps = false;
    protected $fillable = [
        'energy_type',
        
    ];
}