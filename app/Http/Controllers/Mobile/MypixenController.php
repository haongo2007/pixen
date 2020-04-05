<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Trip;

class MypixenController extends Controller
{
    public function index($value='')
    {
    	$user_id = Auth::user()->id;
        $trips = Trip::where('user_id',$user_id)->get();
        $packages = Package::where('user_id',$user_id)->get();
        
        $page = 'My Pixen';
        $page_slug = 'my_pixen';
        return view('mypixen/index', compact('trips','packages','page','page_slug'));
    }
    public function PackageDetail($id)
    {
        $redirect_link = route('mypixen');
    	$package = Package::find($id);
    	return view('package.detail',compact('package','redirect_link'));
    }
    public function TripDetail($id)
    {
        $redirect_link = route('mypixen');
    	$trip = Trip::find($id);
    	return view('trip.detail',compact('trip','redirect_link'));
    }
}
