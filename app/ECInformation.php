<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ECInformation extends Model
{ 
    protected $fillable = [
        'name',
        'telephone',
        'email',
        'website',
        'is_ecno_available',
        'streetaddress',
        'city',
        'state',
        'pincode',
        'ec_reg_no',
    ];
    
}
