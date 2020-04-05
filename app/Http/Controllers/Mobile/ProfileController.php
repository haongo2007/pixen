<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StorageFile;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdatePasswordRequest;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('setting.profile.edit');
    }

    /**
     * @param UserUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request,$id)
    {
        try {
            $user = User::find($id);
            
            /*if ($request->hasFile('idcard') && $request->idcard->isValid()) {
                $storage_file = StorageFile::where('target_id',$id)->where('target_type' ,'user_identify')->first();

                //remove file
                $oldfile = 'public/'.$storage_file->path;
                if (Storage::exists($oldfile)) {
                    Storage::delete($oldfile);
                }
                // upload new file
                $request->file('idcard')->storeAs(
                    'public/idcard/'.$user->id, $request->file('idcard')->hashName()
                );

                $storage_file->update(
                    [
                        'name' => $request->file('idcard')->hashName(),
                        'path' => 'idcard/'.$user->id.'/'.$request->file('idcard')->hashName(),
                        'target_id' => $user->id,
                        'target_type' => 'user_identify',
                    ]
                );
            }
            if ($request->hasFile('avatar') && $request->avatar->isValid()) {
                $avartaImage = StorageFile::where('target_id', $id)->where('target_type', 'user_avatar')->first();
                //remove file
                $oldfile = 'public/'.$avartaImage->path;
                if (Storage::exists($oldfile)) {
                    Storage::delete($oldfile);
                }
                // upload new file
                $request->file('avatar')->storeAs(
                    'public/avatar/' . $user->id, $request->file('avatar')->hashName()
                );
                // save to db
                $avartaImage->update(
                    [
                        'name' => $request->file('avatar')->hashName(),
                        'path' => 'avatar/' . $user->id . '/' . $request->file('avatar')->hashName(),
                        'target_id' => $user->id,
                        'target_type' => 'user_avatar',
                    ]
                );
            }*/
            $user->finished_profile = 1;
            $user->email = $request->email;
            $user->first_name = $request->fname;
            $user->last_name = $request->lname;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->country_id = $request->country;
            $user->description = $request->description;
            $user->save();
            return redirect()->route('setting');
        }
        catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'System error!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */

    public function show($id)
    {
        $user = User::find($id);
        return view('setting.profile.show',compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function changepassword()
    {
        return view('setting.profile.password');
    }

    /**
     * @param UserUpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
    */

    public function password(UserUpdatePasswordRequest $request)
    {
        try {
            User::find(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return redirect()->route('setting');
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'System error!');
        } 
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function privacy()
    {
        return view('setting.profile.privacy');
    }
}
