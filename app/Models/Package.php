<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
{
	private $modelPath = "App\Models\\";

    protected $table = 'packages';

    protected $fillable = ['user_id', 'description', 'begin_place', 'arrival_place', 'arrival_time', 'begin_time', 'size', 'disable'];

    public function hasOneUser()
    {
    	return $this->HasOne($this->modelPath."User",'id','user_id');
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
    public function hasOne_begin_place($value='')
    {
        return $this->HasOne($this->modelPath."AirPort",'id','begin_place');
    }

    public function hasOne_arrival_place($value='')
    {
        return $this->HasOne($this->modelPath."AirPort",'id','arrival_place');
    }

    public static function searchResult($param)
    {
        $result = Package::where('disable', 0);

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

        return $result->orderBy('arrival_time', 'ASC')->paginate(10);
    }

    public static function getPackageWaiting($userId)
    {
        return Package::where('user_id', $userId)
            ->whereDate('arrival_time', ">=", Carbon::now())
            ->where('disable', 0)
            ->get();
    }

    public static function getPackageExpired($userId)
    {
        return Package::where('user_id', $userId)
            ->where(function($query){
                $query->whereDate('arrival_time', "<", Carbon::now())
                    ->orWhere('disable', 1);
            })
            ->get();
    }

    public function requests()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'package_id')->where('status','>', 0);
    }
    public function Myrequests()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'package_id')->where([['user_recei',Auth::user()->id],['status','>', 0]]);
    }
    public function count_request()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'package_id')->count();
    }
    public function are_you()
    {
        return $this->hasMany($this->modelPath.'Request_send', 'package_id')->where([ ['user_send',Auth::user()->id] ])->count();
    }
}
