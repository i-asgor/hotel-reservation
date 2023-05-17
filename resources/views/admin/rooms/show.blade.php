@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Display available rooms -->
<h2>Available Rooms</h2>
<ul>
    @foreach ($availableRooms as $room)
        <li>
            Room ID: {{ $room->id }}
            Room Name: {{ $room->name }}
            <!-- Display available seats for the room -->
            <ul>
                @foreach ($room->seats as $seat)
                    <li>
                        Seat ID: {{ $seat->id }}
                        Seat Name: {{ $seat->name }}
                        <!-- Add a form to book the room and seat -->
                        <form action="{{ route('room_reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                            <input type="number" name="quantity" value="1">
                            <input type="date" name="check_in_date">
                            <input type="date" name="check_out_date">
                            <input type="text" name="guest_name" placeholder="Guest Name">
                            <input type="email" name="guest_email" placeholder="Guest Email">
                            <button type="submit">Book</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

<!-- Display available seats -->
<h2>Available Seats</h2>
<ul>
    @foreach ($availableSeats as $seat)
        <li>
            Seat ID: {{ $seat->id }}
            Seat Name: {{ $seat->name }}
            <!-- Display available rooms for the seat -->
            <ul>
                @foreach ($seat->rooms as $room)
                    <li>
                        Room ID: {{ $room->id }}
                        Room Name: {{ $room->name }}
                        <!-- Add a form to book the seat and room -->
                        <form action="{{ route('room_reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <input type="hidden" name="seat_id" value="{{ $seat->id }}">
                            <input type="number" name="quantity" value="1">
                            <input type="date" name="check_in_date">
                            <input type="date" name="check_out_date">
                            <input type="text" name="guest_name" placeholder="Guest Name">
                            <input type="email" name="guest_email" placeholder="Guest Email">
                            <button type="submit">Book</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>

    </div>
@endsection
