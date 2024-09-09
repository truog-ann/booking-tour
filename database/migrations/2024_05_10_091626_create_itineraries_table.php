<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

            Schema::create('itineraries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tour_id')->constrained()->on('tours');
                $table->integer('day');
                $table->string('title');
                $table->text('itinerary');
                $table->timestamps();
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
