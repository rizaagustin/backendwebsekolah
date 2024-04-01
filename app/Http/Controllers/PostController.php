<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->when(request()->search, function($posts) {
            $posts = $posts->where('title', 'like', '%'. request()->search . '%');
        })->paginate(10);

        return view('pages.post.index', compact('posts'));
    }

    public function create(){
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();
        return view('pages.post.create', compact('tags', 'categories'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title'         => 'required|unique:posts',
            'category_id'   => 'required',
            'content'       => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image'       => $image->hashName(),

            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title'), '-'),
            'category_id' => $request->input('category_id'),
            'content'     => $request->input('content')  
        ]);

        //assign tags
        $post->tags()->attach($request->input('tags'));
        $post->save();

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
        }

    }

    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('pages.post.edit', compact('post', 'tags', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title'         => 'required|unique:posts,title,'.$post->id,
            'category_id'   => 'required',
            'content'       => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $post = Post::findOrFail($post->id);
            $post->update([
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content'     => $request->input('content')  
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/posts/'.$post->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post = Post::findOrFail($post->id);
            $post->update([
                'image'       => $image->hashName(),
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content'     => $request->input('content')  
            ]);

        }

        //assign tags
        $post->tags()->sync($request->input('tags'));

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('post.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('post.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id){
        //delete By ID
        $photo = Post::findOrFail($id);
        $image = Storage::disk('local')->delete('public/posts/'.basename($photo->image));
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
