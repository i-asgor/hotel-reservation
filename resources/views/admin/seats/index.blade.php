@extends('layouts.app')

@section('content')

     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Seat List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <a href="{{ route('seats.create', $room->id) }}" class="btn btn-primary">Add Seat</a>
              </ol>
            </div>
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
                            <th>Name</th>
                            <th>Description </th>
                            <th>Seat Price</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Search</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seats as $seat)
                        <tr>
                            <td>{{($loop->index+1)+ ($seats->currentPage() - 1)*$seats->perPage() }}</td>
                            

                            <td>{{$seat->name}}</td> 
                            <td>{{$seat->description}}</td> 
                            <td>{{$seat->price}}</td> 

                                <form action="{{ route('seats.check-availability', ['id' => $seat->id]) }}" method="GET">
                                  <td>
                                    {{-- <label for="start_date">Start Date:</label> --}}
                                    <input type="date" id="start_date" name="start_date" required>
                                  </td>
                                  <td>
                                    {{-- <label for="end_date">End Date:</label> --}}
                                    <input type="date" id="end_date" name="end_date" required>
                                  </td>
                                    
                                    
                                    <td>
                                      <button type="submit" class="btn btn-primary">Check Availability</button>
                                    </td>
                                </form>   
                            <td>
                                {{-- <a href="{{ route('seats.check-availability', $seat->id) }}">Check Availability</a> --}}
                                {{-- <a href="{{ route('seats.check-availability', ['id' => $seat->id, 'created_at' => $startDate, 'updated_at' => $endDate]) }}">Check Availability</a> --}}                           

                                <a href="{{route('seats.edit',$seat->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="" class="btn btn-danger" data-href="{{route('seats.delete',$seat->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-left">
                         {{ $seats->appends(request()->input())->links("pagination::bootstrap-4") }}
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection

