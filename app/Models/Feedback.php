<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = ['user_id', 'user_feedback', 'title', 'description', 'rating'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function userFeedback()
    {
        return $this->belongsTo('App\Models\User', 'user_feedback');
    }

    public static function getFeebackUser($userId)
    {
        return Feedback::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(Config::get('constants.options.pagination'));
    }
}
