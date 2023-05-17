@extends('layouts.app')

@section('content')

     <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Room List</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

     <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            {{--    --}}
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
                            <th>Room Capacity</th>
                            <th>Room Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{($loop->index+1)+ ($rooms->currentPage() - 1)*$rooms->perPage() }}</td>
                            

                            <td>{{$room->name}}</td> 
                            <td>{{$room->description}}</td> 
                            <td>{{ $room->seats_count }}</td> 
                            <td>
                                @if ($room->seats->isNotEmpty())
                                    {{ $room->seats->sum('price') }}
                                @endif  
                            </td> 
                            <td>
                                <a href="{{ route('rooms.seats.index', $room->id) }}" class="btn btn-primary">{{ __('View Seat') }}</a>
                                
                                <a href="{{ route('seats.create', $room->id) }}" class="btn btn-primary">{{ __('Add Seat') }}</a>
                                <a href="{{route('rooms.edit',$room->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="" class="btn btn-danger" data-href="{{route('rooms.delete',$room->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-left">
                         {{ $rooms->appends(request()->input())->links("pagination::bootstrap-4") }}
                  </div>
              </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@endsection


