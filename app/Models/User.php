<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Cache;

class User extends Authenticatable
{
    use Notifiable, Filterable, Sortable;

    private $modelPath = "App\Models\\";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name', 'last_name', 'phone', 'country_id', 'birthday', 'description', 'finished_profile','google_id','rate_count','rate_total'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    public function avatar()
    {
        return $this->hasOne($this->modelPath.'StorageFile','target_id','id')->where('target_type','avatar');
    }
    public function country()
    {
        return $this->hasOne($this->modelPath.'Country','id','country_id');
    }
    public function idcard()
    {
        return $this->hasOne($this->modelPath.'StorageFile','target_id','id')->where('target_type','identity');
    }

    public function belongsToStorage()
    {
        return $this->HasMany($this->modelPath."StorageFile",'target_id','id');
    }

    public function getName()
    {
        if ($this->first_name) {
            return $this->first_name . ' ' . $this->last_name;
        }else{
            return 'User Name';
        }
    }

    public function hasManyTrips()
    {
        return $this->HasMany($this->modelPath."Trip",'user_id','id')->whereDate('arrival_time',">=",Carbon::now())->where('disable',0);
    }

    public function hasManyPackage()
    {
        return $this->HasMany($this->modelPath."Package",'user_id','id');
    }
    public function hasManyRequestPickup()
    {
        return $this->HasMany($this->modelPath."Request_pickup",'user_id','id');
    }
    public function hasManyRequestSend()
    {
        return $this->HasMany($this->modelPath."Request_send",'user_send','id');
    }

    public function hasManyRequestRecei()
    {
        return $this->HasMany($this->modelPath."Request_send",'user_recei','id');
    }
    public function avatarImage()
    {
        if ($this->avatar) {
            return 'storage/' . $this->avatar->path;
        }
        return 'images/default.jpg';
    }

    public function idcardImage()
    {
        if ($this->idcard) {
            return 'storage/' . $this->idcard->path;
        }
        return 'images/idcard.png';
    }

    public function feedbacks()
    {
        return $this->HasMany($this->modelPath."Feedback",'user_id','id');
    }

    public function filterName($query, $value)
    {
        return $query->where('first_name', 'LIKE', '%' . $value . '%');
    }
    
}
