<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
