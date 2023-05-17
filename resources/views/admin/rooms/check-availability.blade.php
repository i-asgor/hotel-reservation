@extends('layouts.app')

@section('content')
    <h1>Check Room Availability</h1>

    <p>Room: {{ $room->name }}</p>
    <p>Selected Date Range: {{ $startDate }} - {{ $endDate }}</p>

    @if($isAvailable)
        <p>This room is available for booking.</p>
    @else
        <p>This room is already booked for the selected date range.</p>
    @endif
@endsection
