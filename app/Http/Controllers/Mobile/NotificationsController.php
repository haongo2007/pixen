<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index()
    {
    	$noti = Notifications::where('to_user',Auth::user()->id)->orderBy('id','desc')->limit(15)->get();
    	return view('notifications.index',compact('noti'));
    }
}
