<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Support\Collection;

class CalendarController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $seats = Seat::all();

        return view('admin.calendar.index', compact('rooms', 'seats'));
    }


}
