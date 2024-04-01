<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class VideoController extends Controller
{
    public function index (){

        $videos = Video::latest()->when(request()->search, function($videos){
            $videos = $videos->where('title', 'like', '%'. request()->search . '%');
        })->paginate(5);        

        return view('pages.video.index', compact('videos'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'embed' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $video = Video::create([
            'title' => $request->input('title'),
            'embed' => $request->input('embed')
        ]);

        return response()->json([
            'success' => true,
            'data' => $video,
            'message' => 'Data Has Been Created!'
        ]);

    }

    public function edit(Video $video){
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Video',
            'data' => $video,
        ]);
    }

    public function update(Request $request, Video $video){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'embed' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $video = $video->update([
            'title' => $request->input('title'),
            'embed' => $request->input('embed') 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Updated!',
            'data' => $video
        ]);
    }

    public function destroy($id){
        //delete By ID
        Video::where('id',$id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Deleted!',
        ]);
    }

}
