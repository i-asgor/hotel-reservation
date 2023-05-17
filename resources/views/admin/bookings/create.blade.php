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
                    @foreach($availableRooms  as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="seat_id">Select Seat(s)</label>
                <select class="form-control select2" id="seat_id" name="seat_id[]" multiple>
                    <option value="" disabled>Select Seat</option>
                    <!-- @foreach($availableSeats as $seat)
                        <option value="{{ $seat->id }}">{{ $seat->name }}</option>
                    @endforeach -->
                </select>
            </div>

            <!-- <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" min="1">
            </div> -->

            <div class="form-group">
                <label for="check_in_date">Check-in Date</label>
                <input type="date" name="check_in_date" id="check_in_date" value="{{ $checkInDate }}" readonly class="form-control">
            </div>

            <div class="form-group">
                <label for="check_out_date">Check-out Date</label>
                <input type="date" name="check_out_date" id="check_out_date" value="{{ $checkOutDate }}" readonly class="form-control">
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

@endsection


@section('javascript')

<script>
  $(document).ready(function () {
    var selectedSeats = {}; // Object to store selected seats for each room

    $('#room_id').on('change', function () {
        var roomIds = $(this).val();
        if (roomIds && roomIds.length > 0) {
            var seatDropdown = $('#seat_id');
            seatDropdown.empty();

            roomIds.forEach(function (roomId) {
                // Check if any previously selected seats exist for the current room
                var previousSeats = selectedSeats[roomId] || [];

                $.ajax({
                    url: '{{ route("seats.by.room", ":id") }}'.replace(':id', roomId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            var option = $('<option>').val(key).text(value);
                            seatDropdown.append(option);
                        });

                        // Restore previously selected seats for the current room
                        previousSeats.forEach(function (seatId) {
                            seatDropdown.find('option[value="' + seatId + '"]').prop('selected', true);
                        });
                    }
                });

                // Store the selected seats for the current room
                seatDropdown.on('change', function () {
                    selectedSeats[roomId] = $(this).val();
                });
            });
        } else {
            $('#seat_id').empty();
            selectedSeats = {};
        }
    });
});


</script>




@endsection