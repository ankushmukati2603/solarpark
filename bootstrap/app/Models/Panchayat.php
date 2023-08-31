<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    //
    protected $table = 'localbodies';
    public static function getPanchayatsBystates($panchayat_id,$state_id)
	{
		return self::select('code','localbody_name')->where('state_code', $state_id)->where('localbody_type',$panchayat_id)->orderby('localbody_name')->get();
	}
}