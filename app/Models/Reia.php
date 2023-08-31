<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Reia extends Authenticatable
{
    use Notifiable;

    protected $guard = 'reia';
    //public table $table="reia_users";

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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}