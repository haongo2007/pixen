<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';

    protected $fillable = [
        'name', 'native_name', 'code', 'time_zones', 'calling_codes'
    ];
}
