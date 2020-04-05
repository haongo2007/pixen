<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

	private $modelPath = "App\Models\\";

    protected $fillable = ['price', 'paid', 'id_request', 'type','title'];

    public function hasOne_request_send()
    {
        return $this->belongsTo($this->modelPath.'Request_send','id_request');
    }
}
