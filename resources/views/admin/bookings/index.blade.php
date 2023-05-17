@extends('layouts.app')

@section('content')

     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-4">
                <h1 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Room Reservation List</h1>
            </div>
            <div class="col-sm-8">
              <ol class="breadcrumb float-sm-right">
              <form action="{{ route('rooms.search') }}" method="POST">
                  @csrf
                  <label for="check_in_date">Check-in Date:</label>
                  <input type="date" name="check_in_date" required>
                  <label for="check_out_date">Check-out Date:</label>
                  <input type="date" name="check_out_date" required>
                  <button type="submit"  class="btn btn-primary">Room Reservation Search</button>
              </form>
                <!-- <a href="{{ route('booking.create') }}" class="btn btn-primary">Add Room Reservation</a> -->
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
          <h2>All Rooms</h2>
          <ul>
              @foreach($rooms as $room)
                  <li>{{ $room->name }}</li>
              @endforeach
          </ul>
          <hr>          
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="bd bd-gray-300 rounded table-responsive">
                <table class="table mg-b-0">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Room ID</th>
                            <th>Seat ID </th>
                            <th>Quantity </th>
                            <th>Price </th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Guest Name</th>
                            <th>Guest Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                        <tr>
                            <td>{{($loop->index+1)+ ($reservations->currentPage() - 1)*$reservations->perPage() }}</td>                            

                            <td>{{$reservation->room_id}}</td> 
                            <td>{{$reservation->seat_id}}</td> 
                            <td>{{$reservation->quantity}}</td> 
                            <td>
                              {{-- {{ $reservation->seats()->count() * ($reservation->room->price ?? 0) }} --}}
                              {{-- {{ $reservation->seats()->count() * optional($reservation->room)->price }} --}}
                              <!-- {{ $reservation->room ? $reservation->room->price : 'N/A' }} -->
                              {{ $reservation->totalPrice() }}
                            </td> 
                            <td>{{$reservation->check_in_date}}</td> 
                            <td>{{$reservation->check_out_date}}</td> 
                            <td>{{$reservation->guest_name}}</td> 
                            <td>{{$reservation->guest_email}}</td> 
                            <td>{{$reservation->status}}</td> 
                            <td>
                                <a href="{{route('room_reservations.edit',$reservation->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="" class="btn btn-danger" data-href="{{route('room_reservations.delete',$reservation->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-left">
                         {{ $reservations->appends(request()->input())->links("pagination::bootstrap-4") }}
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection

