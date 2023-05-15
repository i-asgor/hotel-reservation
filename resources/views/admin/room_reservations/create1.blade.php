@extends('layouts.app')

@section('content')

     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Room Add</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Room</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            {{-- <form method="post" action="{{ route('room_reservations.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <h2>Rooms</h2>
                    @foreach($rooms as $room)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="rooms[]" value="{{ $room->id }}" id="room{{ $room->id }}">
                        <label class="form-check-label" for="room{{ $room->id }}">
                            {{ $room->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <h2>Rooms</h2>
                      @foreach($rooms as $room)
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="rooms[]" value="{{ $room->id }}" id="room{{ $room->id }}">
                          <label class="form-check-label" for="room{{ $room->id }}">
                              {{ $room->name }}
                          </label>
                      </div>
                      @endforeach
                  </div>
                  <div class="col-md-6">
                      <h2>Seats</h2>
                      @foreach($seats as $seat)
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="seats[]" value="{{ $seat->id }}" id="seat{{ $seat->id }}">
                          <label class="form-check-label" for="seat{{ $seat->id }}">
                              {{ $seat->name }}
                          </label>
                      </div>
                      @endforeach
                  </div>
              </div>
                    <div class="col-md-8">
                        <div class="form-group">
                          <label for="room">Select Room:</label>
                          <select class="form-control select2" name="room_id" id="room_id">
                              <option value="">-- Select Room --</option>
                              @foreach($rooms as $room)
                                  <option value="{{ $room->id }}">{{ $room->name }}</option>
                              @endforeach
                          </select>
                            @error('room_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  

                        <div class="form-group">
                          <label for="room">Select Seat:</label>
                            <select name="seat_id" id="seat_id" class="form-control select2" disabled>
                              <option value="">-- Select Seat --</option>
                            </select>
                            @error('seat_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input type="number" class="form-control" name="quantity" required>
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                          <label for="check_in_date">Check-in Date:</label>
                          <input type="date" class="form-control" name="check_in_date" required>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  

                        <div class="form-group">
                          <label for="check_out_date">Check-out Date:</label>
                          <input type="date" class="form-control" name="check_out_date" required>
                            @error('capacity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="guest_name">Guest Name:</label>
                            <input type="text" class="form-control" name="guest_name" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        <div class="form-group">
                          <label for="guest_email">Guest Email:</label>
                          <input type="email" class="form-control" name="guest_email" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>  
                        
                    </div>
                    
                </div>
        
        
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add') }}
                        </button>
                    </div>
                </div>
            </form> --}}

            <form method="POST" action="{{ route('bookings.store') }}">
              @csrf
              <div class="row">
                  {{-- <div class="col-md-6">
                      <h2>Rooms</h2>
                      @foreach($rooms as $room)
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="rooms[]" value="{{ $room->id }}" id="room{{ $room->id }}">
                          <label class="form-check-label" for="room{{ $room->id }}">
                              {{ $room->name }}
                          </label>
                      </div>
                      @endforeach
                  </div>
                  <div class="col-md-6">
                      <h2>Seats</h2>
                      @foreach($seats as $seat)
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="seats[]" value="{{ $seat->id }}" id="seat{{ $seat->id }}">
                          <label class="form-check-label" for="seat{{ $seat->id }}">
                              {{ $seat->name }}
                          </label>
                      </div>
                      @endforeach
                  </div> --}}

                  <div class="form-group">
                    <label for="room_id">Room</label>
                    <select name="room_id" id="room_id" class="form-control">
                      <option value="">-- Select Room --</option>
                      @foreach($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                      @endforeach
                    </select>
                  </div>
                
                  <div class="form-group">
                    <label for="seat_id">Seat</label>
                    <select name="seat_id" id="seat_id" class="form-control" disabled>
                      <option value="">-- Select Seat --</option>
                    </select>
                  </div>
                
                  <!-- Hidden fields for room_id and seat_id -->
                  <input type="hidden" name="room_id" id="room_id_input" value="">
                  <input type="hidden" name="seat_id" id="seat_id_input" value="">
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



          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection


@section('javascript')



<script>
// $(document).ready(function() {
//   $('#room_id').on('change', function() {
//     var roomId = $(this).val();
//     if (roomId) {
//       $.ajax({
//         url: '{{ route("seats.list") }}',
//         data: { room_id: roomId },
//         success: function(response) {
//           $('#seat_id').html(response);
//         },
//         error: function(xhr, textStatus, errorThrown) {
//           console.log('Error:', textStatus);
//         }
//       });
//     } else {
//       $('#seat_id').html('<option value="">-- Select Seat --</option>');
//     }
//   });
// });



// $(document).ready(function() {
//   $('#room_id').on('change', function() {
//     var roomId = $(this).val();
//     if(roomId){
//       $.ajax({
//         url: '{{ route("seats.list") }}',
//         type: 'POST',
//         contentType: 'application/json',
//         data: JSON.stringify({ room_id: roomId }),
//         success: function(response) {
//           $('#seat_id').html(response);
//         },
//         error: function(xhr, textStatus, errorThrown) {
//           console.log('Error:', textStatus);
//         }
//       });
//       console.log(roomId);
     
//     }else {
//       $('#seat_id').html('<option value="">-- Select Seat --</option>');
//     }
//   })
    
// });


<script>
  $(document).ready(function() {
    $('#room_id').on('change', function() {
      var roomId = $(this).val();
      if (roomId) {
        $.ajax({
          url: '{{ route("seats.list") }}',
          data: { room_id: roomId },
          success: function(response) {
            $('#seat_id').html(response);
            $('#seat_id').prop('disabled', false);
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

    $('#seat_id').on('change', function() {
      var seatId = $(this).val();
      $('#seat_id_input').val(seatId);
      $('#room_id_input').val($('#room_id').val());
    });
  });
</script>

  </script>
  

@endsection


