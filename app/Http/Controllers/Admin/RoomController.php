<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::withCount('seats')->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }


    public function search(Request $request)
    {
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');
        $rooms = Room::all();
        $seats = Seat::all();
        
        // Query to find available rooms within the specified date range
        $availableRooms = Room::whereDoesntHave('reservations', function ($query) use ($checkInDate, $checkOutDate) {
            $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in_date', '<=', $checkOutDate)
                    ->where('check_out_date', '>=', $checkInDate);
            });
        })->get();

        $availableSeats = Seat::whereDoesntHave('reservations', function ($query) use ($checkInDate, $checkOutDate) {
            $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in_date', '<=', $checkOutDate)
                    ->where('check_out_date', '>=', $checkInDate);
            });
        })->get();
        
        
        return view('admin.bookings.create', compact('availableRooms','availableSeats', 'checkInDate', 'checkOutDate','rooms', 'seats'));
    }

    public function show(Room $room)
    {
        $isAvailable = $this->isRoomAvailable($room);

        return view('admin.rooms.show', compact('room', 'isAvailable'));
    }

    private function isRoomAvailable(Room $room)
    {
        $checkInDate = now()->format('Y-m-d');
        $checkOutDate = now()->addDays(1)->format('Y-m-d');

        $reservationCount = DB::table('room_reservations')
            ->where('room_id', $room->id)
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in_date', '<=', $checkOutDate)
                    ->where('check_out_date', '>=', $checkInDate);
            })
            ->count();

        return $reservationCount == 0;
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


    // public function checkReservations($roomId)
    // {
    //     $room = Room::findOrFail($roomId);
    //     $reservations = $room->reservations()->where('status', 'booked')->get();

    //     return view('admin.rooms.reservations', compact('room', 'reservations'));
    // }


    public function checkAvailability($id, Request $request)
    {
        $room = Room::findOrFail($id);
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        // Check if the room is available for the specified date range
        $isAvailable = !$room->reservations()->where(function ($query) use ($startDate, $endDate) {
            $query->where('check_in_date', '<=', $endDate)
                ->where('check_out_date', '>=', $startDate);
        })->exists();
        
        return view('admin.rooms.check-availability', compact('room', 'startDate', 'endDate', 'isAvailable'));
    }



    public function getRoomAvailability()
    {
        $rooms = Room::all();

        $events = [];

        foreach ($rooms as $room) {
            // Retrieve the availability information for each room and format it as an event
            // You can customize this logic based on how you store the availability data in your database

            $availability = $room->availability; // Assuming you have a relationship to retrieve the availability

            foreach ($availability as $availabilityDate) {
                $event = [
                    'title' => $room->name,
                    'start' => $availabilityDate->start_date->toDateString(),
                    'end' => $availabilityDate->end_date->toDateString(),
                ];

                $events[] = $event;
            }
        }

        return response()->json($events);
    }

    



}
