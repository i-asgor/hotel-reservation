<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\SeatReservation;

class SeatReservationController extends Controller
{
    public function create(Seat $seat)
    {
        return view('seat-reservation', compact('seat'));
    }

    public function store(Seat $seat, Request $request)
    {
        $data = $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_name' => 'required',
            'guest_email' => 'required|email',
        ]);

        $reservation = $seat->reservations()->create([
            'check_in_date' => $data['check_in_date'],
            'check_out_date' => $data['check_out_date'],
            'guest_name' => $data['guest_name'],
            'guest_email' => $data['guest_email'],
            'status' => 'booked',
        ]);

        return redirect()->route('reservation.confirmation', [
            'reservation_type' => 'seat',
            'reservation_id' => $reservation->id,
        ]);
    }
}
