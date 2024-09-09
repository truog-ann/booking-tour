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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code');
            $table->string('user_name');
            $table->string('email');
            $table->string('phone');
            $table->string('tour_name');
            $table->integer('tour_price');
            $table->string('tour_address');
            $table->string('hotel_name');
            $table->integer('hotel_price');
            $table->text('hotel_address');
            $table->integer('book_price');
            $table->integer('promotion_price');
            $table->integer('total_price');
            $table->string('people');
            $table->date('start');
            $table->date('end');
            $table->integer('status_tour');
            $table->integer('status_payment');
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
