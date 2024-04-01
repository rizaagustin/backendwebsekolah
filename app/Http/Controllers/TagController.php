<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function index (){

        $tags = Tag::latest()->when(request()->search, function($tags){
            $tags = $tags->where('name', 'like', '%'. request()->search . '%');
        })->paginate(5);        

        return view('pages.tag.index', compact('tags'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $tag = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->input('name'), '-') 
        ]);

        return response()->json([
            'success' => true,
            'data' => $tag,
            'message' => 'Data Has Been Created!'
        ]);

    }

    public function edit(Tag $tag){
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Tag',
            'data' => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags,name,'.$tag->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tag = $tag->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-') 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Updated!',
            'data' => $tag
        ]);
    }

    public function destroy($id){
        //delete By ID
        Tag::where('id',$id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Deleted!',
        ]);
    }

}

