<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class SliderController extends Controller
{
    public function index (){

        $sliders = Slider::latest()->paginate(5);        

        return view('pages.slider.index', compact('sliders'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'image' => 'required|image',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/sliders', $image->hashName());

        $slider = Slider::create([
            'image' => $image->hashName(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $slider,
            'message' => 'Data Has Been Created!'
        ]);

    }


    public function destroy($id){
        //delete By ID
        $photo = Slider::findOrFail($id);
        $image = Storage::disk('local')->delete('public/sliders/'.basename($photo->image));
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
