<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
        
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(3);
        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "List Data Foto"
            ],
            "data" => $photos
        ], 200);
    }
    
    /**
     * PhotoHomePage
     *
     * @return void
     */
    public function PhotoHomePage()
    {
        $photos = Photo::latest()->take(6)->get();
        return response()->json([
            "response" => [
                "status"    => 200,
                "message"   => "List Data Foto Homepage"
            ],
            "data" => $photos
        ], 200);
    }


}
