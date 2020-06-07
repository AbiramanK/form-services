<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteInformation extends Model
{

    protected $fillable = [
            'clinic_name', 
            'telephone', 
            'email', 
            'website', 
            'ec_available', 
            'streetaddress', 
            'city', 
            'state', 
            'pincode',
            'accept'
         
    ];
    
}