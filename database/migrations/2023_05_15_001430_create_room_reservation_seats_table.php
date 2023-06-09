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
        Schema::create('room_reservation_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_reservation_id');
            $table->unsignedBigInteger('seat_id');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('room_reservation_id')->references('id')->on('seat_reservations')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservation_seats');
    }
};
