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
        Schema::create('hotel_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->on('hotels');
            $table->foreignId('service_id')->constrained()->on('services');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_service');
    }
};
