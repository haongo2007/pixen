<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index(User $user ,Request $request)
    {
        if(Request()->ajax()) {
            return $datatables = datatables()->of($user->select('*'))
            ->addColumn('avatar', function($row) {
                return '<img src="'.asset($row->avatarImage()).'" alt="'.$row->name.'" width="60" height="60" class="img-circle" />';
            })
            ->addColumn('username', function($row) {
                return $row->getName();
            })
            ->editColumn('phone', function($row) {
                if($row->finished_profile > 0){
                    return '(+'.$row->country['calling_codes'].') '.$row->phone;
                }else{
                    return '';
                }
            })
            ->addColumn('country', function($row) {
                if($row->finished_profile > 0){
                    return '<span>'.$row->country['name'].'</span><img class="smallflag" src="'.asset('storage/'.$row->country['flag_path']).'" alt="flag" width="25"/>';
                }else{
                    return '';
                }
                
            })
            ->addColumn('state', function($row) {
                if($row->isOnline() && $row->id == $row->isOnline()){
                    return '<span class="badge badge-pill badge-success">Online</span>';
                }else{
                    return '<span class="badge badge-pill badge-danger">Offline</span>';
                }
            })
            ->rawColumns(['avatar','state','country'])
            ->make(true);
        }
        return view('admin.user.index',['user' => $user->paginate(5)]);
    }

    public function detail($id)
    {
        $user = User::find($id);

        return view('admin.user.detail', compact('user'));
    }

    public function changepassword(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'new_password'     => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $user = User::find($data['id']);

        if (!\Hash::check($data['current_password'], $user->password)) {
            return response()->json(['error' => ['You have entered wrong password']]);

        }
        else {
            $user->password = bcrypt($data['new_password']);
            $user->save();
            return response()->json(['success'=>'Successfully changed password.']);

        }
    }
}
