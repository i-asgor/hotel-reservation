@extends('layout.app')

@section('content')
<h2>Available Rooms</h2>

@if ($availableRooms->isEmpty())
    <p>No rooms available for the selected dates.</p>
@else
    <ul>
        @foreach ($availableRooms as $room)
            <li>{{ $room->name }} - {{ $room->price }}</li>
        @endforeach
    </ul>
@endif


@endsection