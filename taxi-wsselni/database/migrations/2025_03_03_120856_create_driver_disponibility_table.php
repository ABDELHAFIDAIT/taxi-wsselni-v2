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
        Schema::create('driver_disponibility', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_driver');
            $table->foreign('id_driver')->references('id')->on('users');
            $table->unsignedInteger('id_disponibility');
            $table->foreign('id_disponibility')->references('id')->on('disponibility');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_disponibility');
    }
};
