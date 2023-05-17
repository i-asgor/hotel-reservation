<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'seat_id',
        'quantity',
        'check_in_date',
        'check_out_date',
        'guest_name',
        'guest_email',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function seatReservation()
    {
        return $this->belongsTo(SeatReservation::class, 'seat_reservation_id');
    }

    
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_reservation_rooms')->withPivot('price')->withTimestamps();
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'room_reservation_seats')
            ->withPivot(['id', 'status'])
            ->withTimestamps();
    }
    public function RoomReservationSeats()
    {
        return $this->hasMany(RoomReservationSeat::class, 'room_reservation_id','id');
    }

    public function totalPrice()
    {
        $totalPrice = 0;

        foreach ($this->RoomReservationSeats as $seat) {
            $totalPrice += $seat->price;
        }

        return $totalPrice;
    }


    protected $appends = ['total_price'];


}
