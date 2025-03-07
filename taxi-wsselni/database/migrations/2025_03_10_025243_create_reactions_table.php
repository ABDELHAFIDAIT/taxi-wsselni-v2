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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('rating');
            $table->string('comment');
            $table->unsignedInteger('id_driver');
            $table->unsignedInteger('id_passenger');
            $table->foreign('id_driver')->references('id')->on('users');
            $table->foreign('id_passenger')->references('id')->on('users');
            $table->enum('status',['accepted','pending','refused'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
