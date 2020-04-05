<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\StorageFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile/edit';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);
    }
    /*
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'min:10', 'max:13'],
            'country' => ['required', 'string', 'max:100'],
            'birthday' => ['required'],
            'idc' => 'required','|image|mimes:jpeg,png,jpg,gif,svg|max:512'
    */
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User;
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        /*$user->first_name = $data['fname'];
        $user->last_name = $data['lname'];
        $user->phone = $data['phone'];
        $user->birthday = $data['birthday'];
        $user->country = $data['country'];*/
        $user->save();

        /*$storage_file = new StorageFile;
        $request = app('request');
        $path = $request->file('idc')->storeAs(
            'public/idcard/'.$user->id, $request->file('idc')->hashName()
        );
        $storage_file->name = $request->file('idc')->hashName();
        $storage_file->path = 'idcard/'.$user->id.'/'.$request->file('idc')->hashName();
        $storage_file->target_id = $user->id;
        $storage_file->target_type = 'user_identify';
        $storage_file->save();*/

//        $storage_file_avt = new StorageFile;
//        $storage_file_avt->name = 'default.png';
//        $storage_file_avt->path = 'example/default.png';
//        $storage_file_avt->target_id = $user->id;
//        $storage_file_avt->target_type = 'user_avatar';
//        $storage_file_avt->save();

        return $user;

    }
}
