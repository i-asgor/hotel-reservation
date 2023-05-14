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
        $rooms = Room::get();
        $seats = Seat::get();
        return view('admin.room_reservations.create', compact('rooms','seats'));
    }

    public function store(Request $request)
    {
        $reservation = new RoomReservation;
        $reservation->room_id = $request->room_id;
        $reservation->seat_id = $request->seat_id;
        $reservation->check_in_date = $request->check_in_date;
        $reservation->check_out_date = $request->check_out_date;
        $reservation->guest_name = $request->guest_name;
        $reservation->guest_email = $request->guest_email;
        // dd($reservation);


        $reservation->save();
        return redirect()->route('room_reservations', $reservation);
    }

    public function show(RoomReservation $reservation)
    {
        return view('room_reservations.show', compact('reservation'));
    }

    public function edit(RoomReservation $reservation)
    {
        return view('admin.room_reservations.edit', compact('reservation'));
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
