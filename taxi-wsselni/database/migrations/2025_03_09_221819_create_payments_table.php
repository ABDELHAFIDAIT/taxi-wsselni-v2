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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_reservation')->unique();
            $table->foreign('id_reservation')->references('id')->on('reservations');
            $table->decimal('amount', 8, 2);
            $table->char('currency', 3)->default('MAD');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->enum('status', ['pending', 'passed', 'canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
