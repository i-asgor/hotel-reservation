<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;

class SeatController extends Controller
{
    public function index($roomId)
    {
        $room = Room::findOrFail($roomId);
        $seats = Seat::where('room_id', $roomId)->latest()->paginate(10);

        return view('admin.seats.index', compact('seats','room'));
    }
    
    public function create($roomId)
    {
        $room = Room::findOrFail($roomId);
        return view('admin.seats.create', compact('room'));
    }

    public function store(Request $request, $roomId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'price' => 'required|numeric|min:0',
        ]);

        $room = Room::findOrFail($roomId);

        $seat = new Seat([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'room_id' => $room->id,
        ]);
        // dd($seat->room_id);
        $seat->save();

        return redirect()->route('rooms.seats.index', $room->id)->with('success', 'Seat created successfully.');
    }

    public function edit($id)
    {
        $seats = Seat::findOrFail($id);
        return view('admin.seats.edit', compact('seats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'price' => 'required|numeric|min:0',
        ]);

        
        
        $seat = Seat::findOrFail($id);
        $roomId = $seat->room_id;
        $seat->name = $request->input('name');
        $seat->description = $request->input('description');
        $seat->price = $request->input('price');
        
        // dd($seat);

        $seat->save();

        return redirect()->route('rooms.seats.index', $roomId)->with('success', 'Seat updated successfully.');
    }

    public function destroy($id)
    {
        $seat = Seat::findOrFail($id);
        $roomId = $seat->room_id;
        $seat->delete();

        return redirect()->route('rooms.show', $roomId)->with('success', 'Seat deleted successfully.');
    }
}