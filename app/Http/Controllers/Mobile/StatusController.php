<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Feedback;
use App\Models\PackageRequest;
use App\Models\TripRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $requestTraveler = TripRequest::getTraveler($user->id);
        $requestTransportFromYou = TripRequest::getFromYou($user->id);

        $requestApplicant = PackageRequest::getApplicant($user->id);
        $requestPackageFromYou = PackageRequest::getFromYou($user->id);

        return view('status.index', compact('requestTraveler', 'requestTransportFromYou', 'requestApplicant', 'requestPackageFromYou'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $data = $request->all();
        if ($data['type'] == 'trip') {
            $request = TripRequest::findOrFail($data['id']);
        }
        else {
            $request = PackageRequest::findOrFail($data['id']);
        }

        if (!empty($request)) {
            if ($data['type'] == 'trip') {
                TripRequest::whereId($data['id'])->update(array('status' => $data['status']));
            }
            else {
                PackageRequest::whereId($data['id'])->update(array('status' => $data['status']));
            }

            return Response::json(array(
                'success' => true
            ));
        }
        return Response::json(array(
            'success' => false
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedback(Request $request)
    {
        $data = $request->all();
        try {
            if ($data['type'] == 'Trip') {
                $request = TripRequest::findOrFail($data['request-id']);
            }
            else {
                $request = PackageRequest::findOrFail($data['request-id']);
            }
            if (!empty($request)) {
                // update status request
                if ($data['type'] == 'Trip') {
                    TripRequest::whereId($data['request-id'])->update(array('status' => Config::get('constants.status.confirmed')));
                    $data['user_id'] = $request->trip->user_id;
                }
                else {
                    PackageRequest::whereId($data['request-id'])->update(array('status' => Config::get('constants.status.confirmed')));
                    $data['user_id'] = $request->package->user_id;
                }


                // create feedback
                unset($data['_token']);
                unset($data['request-id']);
                $data['user_feedback'] = Auth::user()->id;
                Feedback::create($data);

                return Response::json(array(
                    'success' => true
                ));
            }
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
        }
        return Response::json(array(
            'success' => false
        ));
    }
}
