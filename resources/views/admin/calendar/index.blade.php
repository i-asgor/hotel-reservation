@extends('layouts.app')

@section('content')
    <div id="calendar"></div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['dayGrid'],
            events: [
                @foreach($rooms as $room)
                    {
                        title: 'Room {{ $room->name }}',
                        @if ($room->check_in_date && $room->check_out_date)
                            start: '{{ $room->check_in_date->toDateString() }}',
                            end: '{{ $room->check_out_date->toDateString() }}',
                        @else
                            start: null,
                            end: null,
                        @endif
                        color: 'green',
                    },
                @endforeach

                @foreach($seats as $seat)
                    {
                        title: 'Seat {{ $seat->name }}',
                        @if ($seat->check_in_date && $seat->check_out_date)
                            start: '{{ $seat->check_in_date->toDateString() }}',
                            end: '{{ $seat->check_out_date->toDateString() }}',
                        @else
                            start: null,
                            end: null,
                        @endif
                        color: 'blue',
                    },
                @endforeach
            ],
        });

        calendar.render();
    });
</script>

@endsection
