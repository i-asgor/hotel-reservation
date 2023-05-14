<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('seats')->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('admin.rooms.show', compact('room'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $room = new Room([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'capacity' => $request->input('capacity'),
            'price' => $request->input('price'),
        ]);
        $room->save();

        return redirect()->route('rooms')->with('success', 'Room created successfully.');
    }
}
