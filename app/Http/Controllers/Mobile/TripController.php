<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Requests\TripRequest;
use App\Models\Trip;
use App\Models\Package;
use App\Models\Invoice;
use App\Models\Request_send;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Notifications;
use Validator;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $tripsWaiting = Trip::getWaiting($user->id);
        $tripsComplete = Trip::getComplete($user->id);
        return view('trip.index', compact('tripsWaiting', 'tripsComplete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($packageId = '')
    {
        if ($packageId) {
            $package = Package::find($packageId);
            return view('trip.create_to_pickup',compact('package'));
        }
        return view('trip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'begin_place' => 'required',
                'arrival_place' => 'required',
                'begin_time' => 'required|date',
                'arrival_time' => 'required|date|after:begin_time',
                'size' => 'required',
            ]);
            if ($validator->passes()) {
                $user_id = Auth::user()->id;
                $request->request->add(['user_id' => $user_id]);
                Trip::create($request->all());
                $request->session()->flash('success', __('Trip successfully created.'));
                $request->session()->flash('pickup', 'active');
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
     * Display the specified resource.
     *
     * @param  \App\Model\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        $redirect_link = route('search');
        return view('trip.detail', compact('trip','redirect_link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function disable(Request $request)
    {
        $data = $request->all();
        $trip = Trip::findOrFail($data['id']);
        if (!empty($trip)) {
            Trip::whereId($data['id'])->update(array('disable' => $data['disable']));
        }
    }
    public function request($tripId)
    {
        $user_id = Auth::user()->id;
        
        $trip = Trip::find($tripId);

        if ($trip->user_id == $user_id) {
            return redirect()->route('search')->with('error',__('You are the owner of a package that cannot be requested.'));
        }
        return view('trip.request',compact('trip'));
        
    }

    public function requestSave(Request $request)
    {
        try {
            $trip_info = Trip::find($request->trip_id);

            $package = Package::create([
                'user_id' => Auth::user()->id,
                'begin_place' => $trip_info->begin_place, 
                'arrival_place' => $trip_info->arrival_place,
                'begin_time' => $trip_info->begin_time,
                'arrival_time' => $trip_info->arrival_time,
                'size' => $request->size,
                'description' => $request->description,
                'disable' => 1
            ]);
            Request_send::create([
                'user_send' => Auth::user()->id, 
                'user_recei' => $request->user_id, 
                'trip_id' => $request->trip_id,
                'package_id' => $package->id,
                'status' => 1
            ]);
            Notifications::create([
                'id_relation' => $request->trip_id,
                'name_relation' => 'request to trip',
                'message' => 'send request pickup for your trip',
                'redirection' => route('trip.show',['id' => $request->trip_id]),
                'from_user' => Auth::user()->id,
                'to_user' => $trip_info->user_id
            ]);
            return redirect()->route('search')->with('success',__('Requests successfully.'));
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route('trip.show',['id'=>$request->trip_id])->with('error',__('System error.'));
        }
    }
    public function requestdetail($idrq)
    {
        $request = Request_send::find($idrq);
        $redirect_link = route('trip.show',['id' => $request->trip_id]);
        return view('trip.request.detail',compact('request','redirect_link'));
    }
    public function create_invoice(Request $request, $id='')
    {   
        $rq_if = Request_send::findOrFail($id);
        $price = intval(str_replace(',', '', $request->price));
        $invoice = [
            'title' => 'payment for parcel #'.$rq_if->id.' going from '.$rq_if->Trip->hasOne_begin_place->name.' to '.$rq_if->Trip->hasOne_arrival_place->name,
            "id_request" => $id,
            "type" => 'send',
            "price" =>  $price,
            "paid" => 0
        ];
        $invoice = Invoice::create($invoice);
        Trip::whereId($rq_if->trip_id)->update(['disable' => 1]);
        Notifications::create([
            'id_relation' => $invoice->id,
            'name_relation' => 'paid for trip',
            'message' => 'has accepted your request #'.$rq_if->id,
            'redirection' => route('payment.detail',['id' => $invoice->id]),
            'from_user' => $rq_if->user_recei,
            'to_user' => $rq_if->user_send
        ]);
        return redirect()->route('payment.detail',['id' => $invoice->id]);
    }
}
