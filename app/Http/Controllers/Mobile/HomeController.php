<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Trip;
use App\Models\User;
use App\Models\AirPort;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Request_send;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function intro()
    {
        return view('home.intro');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $trips = Trip::where('begin_time','>=',Carbon::now()->toDateTimeString())->where('disable',0)->get();
        $packages = Package::where('begin_time','>=',Carbon::now()->toDateTimeString())->where('disable',0)->get();
        $page = 'Pixen';
        $page_slug = 'pixen';
        return view('home.search', compact('trips','packages','page','page_slug'));
    }

    public function searching(Request $request)
    {
        $id_country = $request->id;
        $packages = Package::where('disable',0)
                    ->where('begin_place',$id_country)
                    ->where('begin_time','>=',Carbon::now()->toDateTimeString())
                    ->where('disable',0)
                    ->orwhere('arrival_place',$id_country)
                    ->get();
        $trips = Trip::where('disable',0)
                    ->where('begin_place',$id_country)
                    ->where('begin_time','>=',Carbon::now()->toDateTimeString())
                    ->where('disable',0)
                    ->orwhere('arrival_place',$id_country)
                    ->get();
        return view('component.search', compact('packages','trips'));
    }

    public function airport_autocomplete(Request $request){
        if($request->ajax()) {
            $results = DB::select("
                select `air_port`.*, `country`.`flag_path` 
                from `air_port` 
                inner join `country` on `air_port`.`iso_country` = `country`.`code` 
                where `air_port`.`name` LIKE ?
                or REPLACE(`air_port`.`municipality`, ' ', '') LIKE ? 
                or `air_port`.`iso_country` LIKE ? 
                or `air_port`.`code` LIKE ?
                limit 15
            ", ['%'.$request->name.'%','%'.$request->name.'%','%'.$request->name.'%','%'.$request->name.'%']);
            return $results;
        }
    }
    public function country_autocomplete(Request $request){
        if($request->ajax()) {
            $results = DB::select("
                select *
                from `country`
                where REPLACE(`name`, ' ', '') LIKE ? 
                or `iso` LIKE ?
                or `name` LIKE ? 
                or `nicename` LIKE ? 
                limit 15
            ", ['%'.$request->name.'%','%'.$request->name.'%','%'.$request->name.'%','%'.$request->name.'%']);
            foreach ($results as $key => $value) {
                $value->flag = str_replace('{iso}', $value->iso, $value->flag);
            }
            return $results;
        }
    }
    public function rating(Request $request)
    {   
        $user = User::find($request->user_id);
        $user->rate_count = $user['rate_count'] + 1;
        $user->rate_total = $user['rate_total'] + $request->rating;
        $user->save();
        return 'ok';
    }
    public function setting(){
        return view('setting.index');
    }
    public function decline($id,$redirect,$to)
    {
        Request_send::find($id)->update(['status' => 0]);
        return redirect()->route($redirect.'.show',['id' => $to])->with('success',__('Decline requests successfully.'));
    }
}
