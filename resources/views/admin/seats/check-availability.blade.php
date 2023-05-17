@extends('layouts.app')

@section('content')
    <h1>Check Seat Availability</h1>

    <p>Seat: {{ $seat->name }}</p>
    <p>Selected Date Range: {{ $startDate }} - {{ $endDate }}</p>

    @if($isAvailable)
        <p>This seat is available for booking.</p>
    @else
        <p>This seat is already booked for the selected date range.</p>
    @endif
@endsection
