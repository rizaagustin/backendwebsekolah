<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Photo;
use App\Models\Video;
class HomeController extends Controller
{
    public function index(){
        $categories = Category::count();
        $posts = Post::count();
        $users = User::count();
        $photos = Photo::count();
        $videos = Video::count();

        return view('pages.home', compact('categories', 'posts', 'users', 'photos', 'videos'));
    }
}
