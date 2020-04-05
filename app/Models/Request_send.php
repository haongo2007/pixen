<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Request_send extends Model
{
    protected $table = 'request_send';

    private $modelPath = "App\Models\\";

    protected $fillable = ['user_send','user_recei','trip_id','package_id','status'];

    
    /* get info user send */
    public function User_send_rq()
    {
        return $this->belongsTo($this->modelPath.'User', 'user_send');
    }
    public function Name_user()
    {
        if ($this->User_send_rq->first_name) {
            return $this->User_send_rq->first_name . ' ' . $this->User_send_rq->last_name;
        }else{
            return 'User Name';
        }
    }
    /* get avatar user sent */
    public function Avatar_user()
    {
        if ($this->User_send_rq->avatar) {
            return 'storage/' . $this->User_send_rq->avatar->path;
        }
        return 'images/default.jpg';
    }

    /* get info user pickup */
    public function User_pickup_rq()
    {
        return $this->belongsTo($this->modelPath.'User', 'user_recei');
    }
    public function Name_user_pickup()
    {
        if ($this->User_pickup_rq->first_name) {
            return $this->User_pickup_rq->first_name . ' ' . $this->User_pickup_rq->last_name;
        }else{
            return 'User Name';
        }
    }
    /* get avatar user sent */
    public function Avatar_user_pickup()
    {
        if ($this->User_pickup_rq->avatar) {
            return 'storage/' . $this->User_pickup_rq->avatar->path;
        }
        return 'images/default.jpg';
    }

    /* get info trip and package */
    public function Package()
    {
        return $this->belongsTo($this->modelPath.'Package', 'package_id');
    }
    public function Trip()
    {
        return $this->belongsTo($this->modelPath.'Trip', 'trip_id');
    }
    public function Getcomments()
    {
        return $this->hasMany($this->modelPath.'Comments', 'request_id')->orderBy('id', 'desc')->take(10);
    }
}
