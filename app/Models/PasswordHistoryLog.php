<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordHistoryLog extends Model
{
     public $table="password_history_log";
     public $timestamps = false;
     protected $fillable = [
        'user_type',
        'user_id',
        'password',
        'created_by',
        'created_date',        
    ];

}
