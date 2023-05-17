<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;
use App\Models\RoomReservationSeat;

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


    public function getAvailableSeats(Room $room)
    {
        // Get the available seats for the room
        $availableSeats = $room->availableSeats();

        // Return the available seats as JSON
        return response()->json(['seats' => $availableSeats]);
    }


    public function list(Request $request)
    {
        $seats = Seat::where('room_id', $request->room_id)->get();
        $html = '<option value="">-- Select Seat --</option>';
        foreach ($seats as $seat) {
            $html .= '<option value="' . $seat->id . '">' . $seat->name . ' (Price: $' . $seat->price . ')</option>';
        }
        return $html;
    }



    // public function checkAvailability($id, Request $request)
    // {
    //     $seat = Seat::findOrFail($id);

    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    
    //     // Check if the seat is booked for the specified date range
    //     $isBooked = SeatReservation::where('seat_id', $seat->id)
    //         ->where(function ($query) use ($startDate, $endDate) {
    //             $query->where(function ($query) use ($startDate, $endDate) {
    //                 $query->where('created_at', '<=', $startDate)
    //                     ->where('updated_at', '>=', $startDate);
    //             })->orWhere(function ($query) use ($startDate, $endDate) {
    //                 $query->where('created_at', '<=', $endDate)
    //                     ->where('updated_at', '>=', $endDate);
    //             })->orWhere(function ($query) use ($startDate, $endDate) {
    //                 $query->where('created_at', '>=', $startDate)
    //                     ->where('updated_at', '<=', $endDate);
    //             });
    //         })
    //         ->exists();
    
    //     return view('seats.check-availability', compact('seat', 'startDate', 'endDate', 'isBooked'));
    // }

    public function checkAvailability($id, Request $request)
    {
        $seat = Seat::findOrFail($id);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Check if the seat is available for the specified date range
        $isAvailable = !$seat->reservations()->where(function ($query) use ($startDate, $endDate) {
            $query->where('check_in_date', '<=', $endDate)
                ->where('check_out_date', '>=', $startDate);
        })->exists();
        
        return view('admin.seats.check-availability', compact('seat', 'startDate', 'endDate', 'isAvailable'));
    }


    public function getSeatsByRoom($id)
    {
        $room = Room::findOrFail($id);
        $seats = $room->seats()->pluck('name', 'id');
        return $seats;
    }





}
