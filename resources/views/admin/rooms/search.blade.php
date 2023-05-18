@extends('layouts.app')


@section('content')
<h2>Search Results</h2>
<p>Check-in Date: {{ $checkInDate }}</p>
<p>Check-out Date: {{ $checkOutDate }}</p>
<ul>
    @foreach($availableRooms as $room)
        <li>{{ $room->name }}</li>
    @endforeach
</ul>



@endsection