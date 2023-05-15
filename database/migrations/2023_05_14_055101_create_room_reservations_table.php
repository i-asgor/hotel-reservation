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
        // Schema::create('room_reservations', function (Blueprint $table) {
        //     $table->id();
        //     // $table->unsignedBigInteger('room_id');
        //     $table->json('room_id')->nullable()->after('id');
        //     // $table->unsignedBigInteger('seat_id')->nullable();
        //     $table->integer('quantity')->default(1); 
        //     $table->date('check_in_date');
        //     $table->date('check_out_date');
        //     $table->string('guest_name');
        //     $table->string('guest_email');
        //     $table->enum('status', ['booked', 'checked_in', 'checked_out'])->default('booked');
        //     $table->timestamps();

        //     $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        //     $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        // });

        Schema::create('room_reservations', function (Blueprint $table) {
            $table->id();
            $table->text('room_id')->nullable();
            $table->text('seat_id')->nullable();
            $table->integer('quantity')->default(1);
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('guest_name');
            $table->string('guest_email');
            $table->enum('status', ['booked', 'checked_in', 'checked_out'])->default('booked');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_reservations');
    }
};
