<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

   

    protected $fillable = ['room_id', 'name', 'description', 'price', 'image'];

    // public function reservations()
    // {
    //     return $this->belongsToMany(SeatReservation::class)->withPivot('price');
    // }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }


    public function reservations()
    {
        return $this->belongsToMany(RoomReservation::class, 'room_reservation_seats')->withPivot('quantity')->withTimestamps();
    }

}
