@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Make a Booking</h1>

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <div class="form-group">
                <label for="room_id">Select Room(s)</label>
                <select class="form-control select2" id="room_id" name="room_id[]" multiple>
                    <option value="" disabled>Select Room</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="seat_id">Select Seat(s)</label>
                <select class="form-control select2" id="seat_id" name="seat_id[]" multiple>
                    <option value="" disabled>Select Seat</option>
                    @foreach($seats as $seat)
                        <option value="{{ $seat->id }}">{{ $seat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1">
            </div>

            <div class="form-group">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" id="check_in_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" id="check_out_date" class="form-control">
            </div>

            <div class="form-group">
                <label for="guest_name">Guest Name</label>
                <input type="text" name="guest_name" id="guest_name" class="form-control">
            </div>

            <div class="form-group">
                <label for="guest_email">Guest Email</label>
                <input type="email" name="guest_email" id="guest_email" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Book</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#room_id').on('change', function() {
                var roomId = $(this).val();
                if (roomId) {
                    $.ajax({
                        url: '{{ route("seats.list") }}',
                        data: { room_id: roomId },
                        success: function(response) {
                            $('#seat_id').prop('disabled', false);
                            $('#seat_id').html(response);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log('Error:', textStatus);
                        }
                    });
                } else {
                    $('#seat_id').html('<option value="">-- Select Seat --</option>');
                    $('#seat_id').prop('disabled', true);
                }
            });
        });
    </script>
@endsection