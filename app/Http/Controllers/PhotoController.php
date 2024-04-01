<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index (){

        $photos = Photo::latest()->when(request()->search, function($tags){
            $photos = $tags->where('caption', 'like', '%'. request()->search . '%');
        })->paginate(5);        

        return view('pages.photo.index', compact('photos'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
            'caption' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/photos', $image->hashName());

        $tag = Photo::create([
            'image' => $image->hashName(),
            'caption' => $request->input('caption'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $tag,
            'message' => 'Data Has Been Created!'
        ]);

    }

    public function edit(Photo $photo){
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Photo',
            'data' => $photo,
        ]);
    }

    public function update(Request $request, Photo $photo){

    }

    public function destroy($id){
        //delete By ID
        $photo = Photo::findOrFail($id);
        $image = Storage::disk('local')->delete('public/photos/'.basename($photo->image));
        $photo->delete();
        
        if ($photo) {
            return response()->json([
                'success' => true,
                'message' => 'Data Has Been Deleted!',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Has Not Been Deleted!',
            ]);
        }

    }
}
