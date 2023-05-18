<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;
use App\Models\RoomReservation;
use Illuminate\Support\Collection;

class CalendarController extends Controller
{
    public function index()
    {
        // $rooms = Room::all();
        // $seats = Seat::all();
        $reservations = RoomReservation::all();        

        $events = [];

        foreach ($reservations as $reservation) {
            $event = [
                'title' => $reservation->guest_name,
                'start' => $reservation->check_in_date,
                'end' => $reservation->check_out_date,
                'url' => route('reservation.show', $reservation->id),
                'backgroundColor' => '#3c8dbc',
                'borderColor' => '#3c8dbc'
            ];
            $events[] = $event;
            // dd($events);
        }

        return view('admin.calendar.index', compact('events'));
    }

    


    public function getReservationEvents()
    {
        $reservations = RoomReservation::all();

        return response()->json($reservations);
    }

    public function show($id)
    {
        $reservation = RoomReservation::find($id);

        if (!$reservation) {
            // Handle reservation not found error, such as redirecting or displaying an error message
        }

        return view('admin.calendar.show', compact('reservation'));
    }


}
