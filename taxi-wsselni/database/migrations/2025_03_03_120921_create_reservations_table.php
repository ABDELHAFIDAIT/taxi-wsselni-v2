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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_passenger');
            $table->foreign('id_passenger')->references('id')->on('users');
            $table->unsignedInteger('id_driver');
            $table->foreign('id_driver')->references('id')->on('drivers');
            $table->timestamp('date_reservation');
            $table->enum('status', ['pending', 'accepted', 'refused']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
