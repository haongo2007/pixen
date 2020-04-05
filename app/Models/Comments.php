<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    private $modelPath = "App\Models\\";
    
    protected $fillable = [
        'message', 'user_id', 'request_id'
    ];
    public function user()
    {
        return $this->belongsTo($this->modelPath.'User', 'user_id');
    }
}
