<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    //getBlockBySubDistict
   
    public static function getVillagesBySubDisticts($sub_district_code)
	{
		return self::select('code','name')->where('sub_district_code', $sub_district_code)->orderby('name')->get();
	}
}