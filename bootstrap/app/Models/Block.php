<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{                           
    public static function getBlockByDistict($district_code)
	{
		return self::select('code','name')->where('district_code', $district_code)->orderby('name')->get();
	}
}