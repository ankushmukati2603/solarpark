<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    //
    protected $table = 'wards';
    public static function getwardByPanchayats($localbody_code)
	{
		return self::select('ward_number','code','ward_name')->where('localbody_code',$localbody_code)->orderby('ward_name')->get();
	}
}