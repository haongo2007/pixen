<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'reply';

    protected $fillable = ['user_id', 'feedback_id', 'comments'];
}
