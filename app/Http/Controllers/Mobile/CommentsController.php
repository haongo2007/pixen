<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{
    public function add(Request $request)
    {
    	try {
    		$cm = Comments::create([
	    		'message' => $request->mess,
	    		'user_id' => $request->uid,
	    		'request_id' => $request->rid,
	    	]);
	    	return view('component.comment',compact('cm'));
    	} catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'System error!');
        }
    }
    public function delete(Request $request)
    {
        try {
            Comments::find($request->id)->delete();
            return 200;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'System error!');
        }
    }
    public function update(Request $request)
    {
        try {
            $cm = Comments::find($request->id);
            $cm->update([
                'message' => $request->mess,
            ]);
            return 200;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back()->with('error', 'System error!');
        }
    }
}
