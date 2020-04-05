<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Trip extends Model
{
    private $modelPath = "App\Models\\";

    protected $table = 'trips';

    protected $fillable = ['user_id', 'begin_place', 'arrival_place', 'begin_time', 'arrival_time', 'disable','size','description'];

    public function user()
    {
        return $this->belongsTo($this->modelPath.'User', 'user_id');
    }

    public static function getWaiting($userId)
    {
        return Trip::where('arrival_time', '>=', Carbon::now())->where('disable', 0)->where('user_id', $userId)->get();
    }

    public static function getComplete($userId)
    {
        return Trip::where('user_id', $userId)
            ->where(function($query){
                $query->whereDate('arrival_time', "<", Carbon::now())
                    ->orWhere('disable', 1);
            })
            ->get();
    }
    public function get_flag($id)
    {
        $air_port = AirPort::where('air_port.id',$id)
        ->join('country', 'air_port.iso_country', '=', 'country.code')
        ->first();
        return '<img class="smallflag" width="25" src="'.asset('storage/'.$air_port->flag_path).'">';
    }
    public function get_country_name($id)
    {
        $air_port = AirPort::where('air_port.id',$id)
        ->join('country', 'air_port.iso_country', '=', 'country.code')
        ->first();
        return $air_port->name;
    }
    public static function searchResult($param)
    {
        $result = Trip::where('disable', 0);

        if (!empty($param['begin_place'])) {
            $result->where('begin_place', '=', $param['begin_place']);
        }

        if (!empty($param['arrival_place'])) {
            $result->where('arrival_place', '=', $param['arrival_place']);
        }

        if (!empty($param['arrival_time'])) {
            $result->where('arrival_time', '>=', date('Y-m-d', strtotime($param['arrival_time'])));
        }

        $result->where('arrival_time', '>=', date('Y-m-d'));


        return $result->orderBy('arrival_time', 'ASC')->paginate(Config::get('constants.options.pagination'));
    }
    public function hasOneUser()
    {
        return $this->HasOne($this->modelPath."User",'id','user_id');
    }
    public function requests()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'trip_id')->where('status','>', 0);
    }
    public function Myrequests()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'trip_id')->where([['user_send',Auth::user()->id],['status','>', 0]]);
    }
    public function hasOne_begin_place($value='')
    {
        return $this->HasOne($this->modelPath."AirPort",'id','begin_place');
    }
    public function hasOne_arrival_place($value='')
    {
        return $this->HasOne($this->modelPath."AirPort",'id','arrival_place');
    }
    public function count_request()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'trip_id')->count();
    }
    public function are_you()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'trip_id')->where([ ['user_pickup',Auth::user()->id] ])->count();
    }
}
