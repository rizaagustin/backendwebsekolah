<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index (){

        $categories = Category::latest()->when(request()->search, function($tags){
            $categories = $tags->where('name', 'like', '%'. request()->search . '%');
        })->paginate(5);        

        return view('pages.category.index', compact('categories'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $tag = category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->input('name'), '-') 
        ]);

        return response()->json([
            'success' => true,
            'data' => $tag,
            'message' => 'Data Has Been Created!'
        ]);

    }

    public function edit(Category $category){
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Tag',
            'data' => $category,
        ]);
    }

    public function update(Request $request, Category $category){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags,name,'.$category->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-') 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Updated!',
            'data' => $category
        ]);
    }

    public function destroy($id){
        //delete By ID
        Category::where('id',$id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Deleted!',
        ]);
    }

}
