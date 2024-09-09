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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('promotion');
            $table->text('description');
            $table->foreignId('province_id')->constrained()->on('provinces');
            $table->foreignId('district_id')->constrained()->on('districts');
            $table->foreignId('ward_id')->constrained()->on('wards');
            $table->string('address');
            $table->boolean('status');
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
        Schema::dropIfExists('hotels');
    }
};
