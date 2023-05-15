<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\Admin\RoomReservationController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SeatReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


 // Rooms
 Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
 Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
 Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
 Route::post('/rooms/edit/{id}', [RoomController::class, 'edit'])->name('rooms.edit');
 Route::post('/rooms/update/{id}', [RoomController::class, 'update'])->name('rooms.update');
 Route::post('/rooms/delete/{id}', [RoomController::class, 'delete'])->name('rooms.delete');
 Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');


 // Seat
 Route::get('rooms/{room}/seats', [SeatController::class, 'index'])->name('rooms.seats.index');
 Route::get('/rooms/{roomId}/seats/create', [SeatController::class, 'create'])->name('seats.create');
 Route::post('/rooms/{roomId}/seats', [SeatController::class, 'store'])->name('seats.store');
 Route::get('/seats/{id}/edit', [SeatController::class, 'edit'])->name('seats.edit');
 Route::put('/seats/{id}', [SeatController::class, 'update'])->name('seats.update');
 Route::delete('/seats/{id}', [SeatController::class, 'destroy'])->name('seats.delete');


  // Rooms
  Route::get('/room_reservations', [RoomReservationController::class, 'index'])->name('room_reservations');
  Route::get('/room_reservations/create', [RoomReservationController::class, 'create'])->name('room_reservations.create');
  Route::post('/room_reservations/store', [RoomReservationController::class, 'store'])->name('room_reservations.store');
  Route::get('/room_reservations/edit/{id}', [RoomReservationController::class, 'edit'])->name('room_reservations.edit');
  Route::post('/room_reservations/update/{id}', [RoomReservationController::class, 'update'])->name('room_reservations.update');
  Route::post('/room_reservations/delete/{id}', [RoomReservationController::class, 'delete'])->name('room_reservations.delete');
//   Route::get('/rooms/{room_id}/seats/available', [RoomReservationController::class, 'getAvailableSeats'])->name('rooms.seats.available');
    Route::get('/rooms/{room}/seats/available', [BookingController::class, 'getAvailableSeats'])->name('rooms.seats.available');
    Route::get('/rooms/available', [RoomController::class, 'availableRooms'])->name('rooms.available');



  // Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
  // Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

  Route::get('/seats/list', [SeatController::class, 'getSeatsByRoom'])->name('seats.list');

  Route::get('/booking', [BookingController::class, 'index'])->name('booking');
  Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
  Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
  


