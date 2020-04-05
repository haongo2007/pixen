<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Yajra\Datatables\Facades\Datatables;

class PackageController extends Controller
{
    public function index(Package $package,Request $request)
    {
        if(Request()->ajax()) {
            return $datatables = datatables()->of($package->select('*'))
            ->addColumn('avatar', function($row) {
                return '<img src="'.asset($row->hasOneUser->avatarImage()).'" width="60" height="60" class="img-circle" >';
            })
            ->addColumn('username', function($row) {
                return $row->hasOneUser->getName();
            })
            ->addColumn('from', function($row) {
                return '<span>'.$row->hasOne_begin_place->name.'</span>'.$row->get_flag($row->begin_place);
            })
            ->addColumn('to', function($row) {
                return '<span>'.$row->hasOne_arrival_place->name.'</span>'.$row->get_flag($row->arrival_place);
            })
            ->addColumn('requested', function($row) {
                return $row->count_request();
            })
            ->addColumn('status', function($row) {
                if($row->disable == 1){
                    return '<span class="badge badge-pill badge-danger">Disable</span>';
                }
                    return '<span class="badge badge-pill badge-info">Enable</span>';
                
            })
            ->rawColumns(['avatar','status','from','to'])
            ->make(true);
        }
        return view('admin.package.index',['packages' => $package->paginate(5)]);
    }

    public function detail($id)
    {
        $package = Package::find($id);

        return view('admin.package.detail', compact('package'));
    }
}
