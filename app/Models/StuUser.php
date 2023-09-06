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
    
}