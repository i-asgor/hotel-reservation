<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_reservation_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_reservation_id');
            $table->unsignedBigInteger('room_id');
            $table->integer('quantity')->default(1);
            $table->float('price')->nullable();
            $table->timestamps();
    
            $table->foreign('room_reservation_id')->references('id')->on('room_reservations')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservation_rooms');
    }
};
