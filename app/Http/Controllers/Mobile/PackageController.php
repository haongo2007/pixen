<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Requests\PackageCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Request_send;
use App\Models\Trip;
use App\Models\AirPort;
use App\Models\Invoice;
use App\Models\Notifications;
use App\Http\Requests\PackageRqRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;

class PackageController extends Controller
{
    /**
     * My package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    	$package = Package::getPackageWaiting(Auth::user()->id);
        $package_expired = Package::getPackageExpired(Auth::user()->id);
    	return view('package.index',compact('package','package_expired'));
    }

    /**
     * Create package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($tripId = '')
    {
        if ($tripId) {
            $trip = Trip::find($tripId);
            return view('package.create_to_send',compact('trip'));
        }
        return view('package.create');
    }

    /**
     * Search package
     *
     * @param PackageCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'begin_place' => 'required',
                'arrival_place' => 'required',
                'begin_time' => 'required|date',
                'arrival_time' => 'required|date',
                'size' => 'required',
            ]);
            if ($validator->passes()) {
                $user_id = Auth::user()->id;
                $request->request->add(['user_id' => $user_id]);
                $package = Package::create($request->all());
                $request->session()->flash('success', __('Package successfully created.'));
                $request->session()->flash('send', 'active');
                return response()->json(['success'=>'200']);
            }
            return response()->json(['error'=>$validator->errors()]);
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back()->withError('System error!')->withInput();
        }
    }

    /**
     * Show package
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $redirect_link = route('search');
    	$package = Package::find($id);
    	return view('package.detail',compact('package','redirect_link'));
    }

    /**
     * Show request package
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function request($packageId)
    {
        $package = Package::find($packageId);
        $user_id = Auth::user()->id;
        if ($package->user_id == $user_id) {
            return redirect()->route('search')->with('error',__('You are the owner of a package that cannot be requested.'));
        }
        return view('package.request',compact('package'));
        
    }

    /**
     * Save request package
     *
     * @param RequestedPackageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestSave(Request $request)
    {   
        try {
            $package_info = Package::find($request->package_id);

            $trip = Trip::create([
                'user_id' => Auth::user()->id,
                'begin_place' => $package_info->begin_place, 
                'arrival_place' => $package_info->arrival_place,
                'begin_time' => $package_info->begin_time,
                'arrival_time' => $package_info->arrival_time,
                'size' => $request->size,
                'description' => $request->description,
                'disable' => 1
            ]);
            Request_send::create([
                'user_send' => $request->user_id, 
                'user_recei' => Auth::user()->id, 
                'package_id' => $package_info->id,
                'trip_id' => $trip->id,
                'status' => 1
            ]);
            Notifications::create([
                'id_relation' => $request->package_id,
                'name_relation' => 'request to package',
                'message' => 'send request your package want to send',
                'redirection' => route('package.show',['id' => $request->package_id]),
                'from_user' => Auth::user()->id,
                'to_user' => $package_info->user_id
            ]);
            return redirect()->route('search')->with('success',__('Requests successfully.'));
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route('package.show',['id'=>$request->package_id])->with('error',__('System error.'));
        }
        
    }

    public function requestdetail($idrq)
    {
        $request = Request_send::find($idrq);
        $redirect_link = route('package.show',['id' => $request->package_id]);
        return view('package.request.detail',compact('request','redirect_link'));
    }

    /**
     * create invoice
     *
     * @param Request $request
     */
    public function create_invoice(Request $request,$id)
    {
        $rq_if = Request_send::findOrFail($id);
        $price = intval(str_replace(',', '', $request->price));
        $invoice = [
            'title' => 'payment for parcel #'.$rq_if->id.' going from '.$rq_if->Package->hasOne_begin_place->name.' to '.$rq_if->Package->hasOne_arrival_place->name,
            "id_request" => $id,
            "type" => 'pickup',
            "price" =>  $price,
            "paid" => 0
        ];
        $invoice = Invoice::create($invoice);
        Package::whereId($rq_if->package_id)->update(['disable' => 1]);
        Notifications::create([
            'id_relation' => $invoice->id,
            'name_relation' => 'paid for trip',
            'message' => 'has accepted your request #'.$rq_if->id,
            'redirection' => route('payment.detail',['id' => $invoice->id]),
            'from_user' => $rq_if->user_send,
            'to_user' => $rq_if->user_recei
        ]);
        return redirect()->route('payment.detail',['id' => $invoice->id]);
    }
    
}
