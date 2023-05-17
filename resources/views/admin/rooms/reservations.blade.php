@extends('layouts.app')

@section('content')
    <h1>Room Reservations</h1>
    <h2>Room: {{ $room->name }}</h2>

    @if ($reservations->isEmpty())
        <p>No reservations found for this room.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Reservation ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Guest Name</th>
                    <th>Guest Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->check_in_date }}</td>
                        <td>{{ $reservation->check_out_date }}</td>
                        <td>{{ $reservation->guest_name }}</td>
                        <td>{{ $reservation->guest_email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
