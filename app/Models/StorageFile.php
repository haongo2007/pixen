<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageFile extends Model
{
    protected $table = 'storage_file';

    protected $fillable = ['name', 'target_id', 'target_type', 'path'];
}
