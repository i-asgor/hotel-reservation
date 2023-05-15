<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomReservation;
use App\Models\RoomReservationRoom;
use App\Models\Room;
use App\Models\Seat;

class BookingController extends Controller
{
    public function index()
    {
        // $roomIds = json_decode($reservation->room_id);

        $reservations = RoomReservation::latest()->paginate(10);
        // $rooms = Room::whereIn('id', $roomIds)->get();


        return view('admin.bookings.index', compact('reservations'));
    }
    public function create()
    {
        $rooms = Room::all();
        $seats = Seat::all();

        return view('admin.bookings.create', compact('rooms', 'seats'));
    }

    public function seatBookingForm()
    {
        $rooms = Room::all();
        return view('seat-booking', compact('rooms'));
    }

    public function getSeats(Request $request)
    {
        $seats = Seat::where('room_id', $request->room_id)->get();
        $output = '';
        foreach ($seats as $seat) {
            $output .= '<option value="' . $seat->id . '">' . $seat->seat_number . '</option>';
        }
        return response()->json($output);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_id.*' => 'required|exists:rooms,id',
            'seat_id.*' => 'nullable|exists:seats,id',
            'quantity' => 'required|integer|min:1',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
        ]);

        $reservation = new RoomReservation();
        $reservation->room_id = json_encode($validatedData['room_id']);      
        $reservation->seat_id = json_encode($validatedData['seat_id']);      
        $reservation->quantity = $validatedData['quantity'];
        // if (isset($validatedData['quantity'])) {
        //     $reservation->quantity = $validatedData['quantity'];
        // }
        $reservation->check_in_date = $validatedData['check_in_date'];
        $reservation->check_out_date = $validatedData['check_out_date'];
        $reservation->guest_name = $validatedData['guest_name'];
        $reservation->guest_email = $validatedData['guest_email'];
        $reservation->status = 'booked';

        // dd($reservation);

        $reservation->save();
        // dd($reservation->toSql(), $reservation->getBindings());


        if (isset($validatedData['room_id']) && is_array($validatedData['room_id'])) {
            $rooms = Room::whereIn('id', $validatedData['room_id'])->get();
            foreach ($rooms as $room) {
              $reservation->rooms()->attach($room->id, [
                'price' => $room->price,
              ]);
            }
          }
          
          if (isset($validatedData['seat_id']) && is_array($validatedData['seat_id'])) {
            $seats = Seat::whereIn('id', $validatedData['seat_id'])->get();
            foreach ($seats as $seat) {
              $reservation->seats()->attach($seat->id, [
                'price' => $seat->price,
              ]);
            }
          }
          

        return redirect()->route('booking')->with('success', 'Reservation created successfully!');
    }



    public function getAvailableSeats(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $room = Room::findOrFail($validatedData['room_id']);
        $availableSeats = $room->seats()->whereDoesntHave('reservations', function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('check_in_date', '<', $request->input('check_out_date'))
                    ->where('check_out_date', '>', $request->input('check_in_date'));
            })->orWhere(function ($query) use ($request) {
                $query->where('check_in_date', '>=', $request->input('check_in_date'))
                    ->where('check_in_date', '<', $request->input('check_out_date'));
            })->orWhere(function ($query) use ($request) {
                $query->where('check_out_date', '>', $request->input('check_in_date'))
                    ->where('check_out_date', '<=', $request->input('check_out_date'));
            });
        })->get();

        return response()->json($availableSeats);
    }

}
