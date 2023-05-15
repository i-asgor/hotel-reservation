<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function availableSeats()
    {
        // Get the reservations for the room
        $reservations = $this->reservations()->where('check_out_date', '>', today())->get();

        // Get the reserved seat IDs
        $reservedSeatIds = $reservations->pluck('seat_id')->toArray();

        // Get the available seats for the room
        $availableSeats = $this->seats()->whereNotIn('id', $reservedSeatIds)->get();

        return $availableSeats;
    }


    // public function reservations()
    // {
    //     return $this->belongsToMany(RoomReservation::class)
    //                 ->withPivot('price')
    //                 ->withTimestamps();
    // }

    public function reservations()
    {
        return $this->belongsToMany(RoomReservation::class)
                    ->withPivot('price')
                    ->withTimestamps();
    }


    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price'
    ];
}
