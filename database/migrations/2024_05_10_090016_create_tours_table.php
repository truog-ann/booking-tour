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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->integer('day');
            $table->text('description');
            $table->integer('price');
            $table->integer('promotion');
            $table->integer('views');
            $table->foreignId('province_id')->constrained()->on('provinces');
            $table->foreignId('district_id')->constrained()->on('districts');
            $table->foreignId('ward_id')->constrained()->on('wards');
            $table->boolean('is_active');
            $table->softDeletes();
            $table->timestamps();


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
