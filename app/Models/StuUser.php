<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class StuUser extends Authenticatable
{

    public $table="stu_users";
    public $timestamps = false;
   protected $guard = 'stu-users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'name',
        'contact_person',
        'phone',
        'nodal',
        'address',
        'state_id',
        'district_id',
        'pincode',
        'website',
        'email',
        'short_info',
        'logo',
        'state_implementing_agency_id',
        'password',
        'date_of_reg'
    ];

    public static function getStuUsers(){
   
        $data=self::select(
            'stu_users.*',
            'states.name as state_name',
            'districts.name as district_name',
            
        )
        ->join('states','states.code','stu_users.state_id')
        ->join('districts','districts.code','stu_users.district_id')
        // ->join('sub_districts','sub_districts.code','state_implementing_agency_users.sub_district_id')
        // ->join('villages','villages.code','state_implementing_agency_users.village')
        ->get();
    
        return $data;
    } 
    
}