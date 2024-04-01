<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->when(request()->search, function($events) {
            $events = $events->where('title', 'like', '%'. request()->search . '%');
        })->paginate(10);

        return view('pages.event.index', compact('events'));
    }

    public function create(){

        return view('pages.event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required',
            'location'  => 'required',
            'date'      => 'required'
        ]);

        $event = Event::create([
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title'), '-'),
            'content'   => $request->input('content'),
            'location'  => $request->input('location'),
            'date'      => $request->input('date')
        ]);

        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('event.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('event.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Event $event)
    {
        return view('pages.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required',
            'location'  => 'required',
            'date'      => 'required'
        ]);

        $event = Event::findOrFail($event->id);
        $event->update([
            'title'     => $request->input('title'),
            'slug'      => Str::slug($request->input('title'), '-'),
            'content'   => $request->input('content'),
            'location'  => $request->input('location'),
            'date'      => $request->input('date')
        ]);

        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('event.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('event.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        if ($event) {
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
