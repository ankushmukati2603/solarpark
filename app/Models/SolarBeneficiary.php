<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarBeneficiary extends Model
{
    protected $table = 'beneficiary';
    public $timestamps = false;
    protected $fillable = [
        'contact_no',
        'email',
        'name',
    ];
}