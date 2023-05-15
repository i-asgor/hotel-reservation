@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Available Seats in Room {{ $room->name }}</h2>
        <p>Check-in Date: {{ $checkInDate }}</p>
        <p>Check-out Date: {{ $checkOutDate }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Seat Number</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seats as $seat)
                    <tr>
                        <td>{{ $seat->number }}</td>
                        <td>{{ $seat->price }}</td>
                        <td>{{ $seat->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
