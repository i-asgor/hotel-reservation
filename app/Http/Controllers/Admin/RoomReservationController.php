<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomReservation;
use App\Models\Room;
use App\Models\Seat;

class RoomReservationController extends Controller
{
    public function index()
    {
        $reservations = RoomReservation::latest()->paginate(10);
        return view('admin.room_reservations.index', compact('reservations'));
    }

    public function create()
    {
        // $rooms = Room::get();
        // $seats = Seat::get();
        // $rooms = Room::orderBy('id','DESC')->paginate();
        $rooms = Room::with('seats')->get()->paginate();
        $seats = Seat::where('room_id',id)->get();
        return view('admin.room_reservations.create', compact('rooms','seats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_name' => 'required',
            'guest_email' => 'required|email',
        ]);

        // $reservation = new RoomReservation;
        // $reservation->room_id = $request->room_id;
        // $reservation->seat_id = $request->seat_id;
        // $reservation->check_in_date = $request->check_in_date;
        // $reservation->check_out_date = $request->check_out_date;
        // $reservation->guest_name = $request->guest_name;
        // $reservation->guest_email = $request->guest_email;
        // // dd($reservation);


        // $reservation->save();
        // return redirect()->route('room_reservations', $reservation);

        $reservation = $room->reservations()->create([
            'check_in_date' => $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'status' => 'booked',
        ]);

        return redirect()->route('reservation.confirmation', [
            'reservation_type' => 'room',
            'reservation_id' => $reservation->id,
        ]);
    }


    public function storeBook(Request $request)
    {
        $validatedData = $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_name' => 'required',
            'guest_email' => 'required|email',
        ]);

        // Create a new instance of RoomReservation
        $reservation = new RoomReservation();
        // Set the attributes of the reservation
        $reservation->check_in_date = $validatedData['check_in_date'];
        $reservation->check_out_date = $validatedData['check_out_date'];
        $reservation->guest_name = $validatedData['guest_name'];
        $reservation->guest_email = $validatedData['guest_email'];
    //    dd($reservation);

        // Save the reservation to the database
        $reservation->save();

        // Redirect the user to a success page or any other desired action
        return redirect()->route('room_reservations')->with('success', 'Reservation created successfully!');
    }

    
    public function edit($id)
    {
        $reservations = RoomReservation::findOrFail($id);
        return view('admin.room_reservations.edit', compact('reservations'));
    }

    public function update(Request $request, RoomReservation $reservation)
    {
        $reservation->room_id = $request->room_id;
        $reservation->seat_id = $request->seat_id;
        $reservation->check_in_date = $request->check_in_date;
        $reservation->check_out_date = $request->check_out_date;
        $reservation->guest_name = $request->guest_name;
        $reservation->guest_email = $request->guest_email;
        $reservation->save();
        return redirect()->route('room_reservations.show', $reservation);
    }

    public function delete(RoomReservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('room_reservations.index');
    }


    
}
