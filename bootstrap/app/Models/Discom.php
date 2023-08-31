<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discom extends Model
{
    public $table="discom_tbl";
    protected $fillable = [
        'id_agency_tbl ',
        'active',
        'portal_link',
        'portal_link_non_subsidy',
        'discom_name',
        'statecd',
        'file',
    ];
}