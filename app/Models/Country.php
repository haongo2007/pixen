<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    protected $fillable = [
        'iso', 'iso3', 'name', 'flag', 'nicename', 'numcode', 'phone_code'
    ];
}