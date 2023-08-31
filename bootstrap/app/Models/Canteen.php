<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canteen extends Model
{
    protected $fillable = [
        'code_no', 'item', 'item_indented', 'quantity_issued', 'user_id'
    ];

    protected $table = 'canteens';
}
