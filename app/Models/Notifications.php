<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    private $modelPath = "App\Models\\";
    
    protected $fillable = [
        'id_relation', 'name_relation', 'message', 'redirection', 'from_user', 'to_user'
    ];
    public function From_user()
    {
        return $this->belongsTo($this->modelPath.'User', 'from_user');
    }

    public function To_user()
    {
        return $this->belongsTo($this->modelPath.'User', 'to_user');
    }
}
