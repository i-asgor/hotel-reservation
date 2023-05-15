<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReservationRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_reservation_id',
        'price',
    ];

    // public function rooms()
    // {
    //     return $this->belongsToMany(Room::class)
    //                 ->withPivot('price')
    //                 ->withTimestamps();
    // }
}
