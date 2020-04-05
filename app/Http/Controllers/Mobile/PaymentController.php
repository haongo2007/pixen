<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PaymentController extends Controller
{
    /**
     * Get list feeback of user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $id_send = [];
        foreach (Auth::user()->hasManyRequestSend->toArray() as $key => $value) {
            array_push($id_send, $value['id']);
        }
        $id_recei = [];
        foreach (Auth::user()->hasManyRequestRecei->toArray() as $key => $value) {
            array_push($id_recei, $value['id']);
        }

        $recei = Invoice::whereIn('id_request',$id_recei)->orderBy('id','desc')->get();
        $send = Invoice::whereIn('id_request',$id_send)->orderBy('id','desc')->get();
    	return view('payment.index',compact('send','recei'));
    }
    public function detail($id)
    {
        $invoice = Invoice::find($id);
        $redirect_link = route('payment');
    	return view('payment.detail',compact('invoice','redirect_link'));
    }
    public function success($id)
    {
        if (session('success')) {
            $invoice = Invoice::find($id);
            $redirect_link = route('payment');
            return view('payment.success',compact('invoice','redirect_link'));
        }else{
            return redirect()->route('payment');
        }
    }
}
