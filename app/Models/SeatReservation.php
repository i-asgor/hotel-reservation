<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatReservation extends Model
{
    use HasFactory;

    protected $fillable = ['check_in_date', 'check_out_date', 'guest_name', 'guest_email', 'status'];

    

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'room_reservation_seat', 'room_reservation_id', 'seat_id')->withPivot('price');
    }

    
}
