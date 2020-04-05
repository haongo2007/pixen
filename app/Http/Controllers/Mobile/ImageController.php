<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\StorageFile;
use App\Models\User;
use App\Models\Country;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function UploadImageProfile(Request $request)
    {
        $uid = Auth::user()->id;
        /* base64 decode */
        $image = $request->image;
        $types = $request->type;

        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);

        $check_storagefile = StorageFile::where([['target_type',$types],['target_id',$uid]])->count();
        if ($check_storagefile > 0) {
            /* update */
            $storage = StorageFile::where([['target_type',$types],['target_id',$uid]])->first();
            $oldfile = 'public/'.$storage->path;
            if (Storage::exists($oldfile)) {
                Storage::delete($oldfile);
            }
            // upload new file
            $image_name = time().'.png';
            $path = 'public/'.$types.'/'.Auth::user()->id.'/'.$image_name;
            Storage::put($path, $image);
            $storage->update(
                [
                    'name' => $image_name,
                    'path' => $types.'/'.$uid.'/'.$image_name,
                    'target_id' => $uid,
                    'target_type' => $types,
                ]
            );
            return '200';
        }else{
            /* create */
            $image_name = time().'.png';
            $storage = new StorageFile;
            $path = 'public/'.$types.'/'.$uid.'/'.$image_name;

            Storage::put($path, $image);
            $storage->name = $image_name;
            $storage->path = $types.'/'.$uid.'/'.$image_name;
            $storage->target_id = $uid;
            $storage->target_type = $types;
            $storage->save();
            return '200';
        }
    }
    public function CropImage(Request $request)
    {   

        $url = $request->link;
        $contents = file_get_contents($url);
        $name = 'public/flags/'.substr($url, strrpos($url, '/') + 1);
        Storage::put($name, $contents);

        /* resize */
        /*$p = 'storage/flags/'.substr($url, strrpos($url, '/') + 1);
        $img = Image::make($p)->resize(50, 50);
        $img->save($p);*/
        $country = new Country;
        $country->name = $request->name;
        $country->flag_path = 'flags/'.substr($url, strrpos($url, '/') + 1);
        $country->name_native = $request->name_native;
        $country->code = $request->code;
        $country->time_zones = $request->time_zones[0];
        $country->calling_codes = $request->calling_codes[0];

        $country->save();
    }
}
