<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Gecd extends Authenticatable
{
    
    public $table="gecd_users";
    public $timestamps = false;

}