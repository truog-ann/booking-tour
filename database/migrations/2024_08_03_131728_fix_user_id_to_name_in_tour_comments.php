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
        Schema::table('tour_comments', function (Blueprint $table) {
            //
            $table->dropConstrainedForeignId('user_id');
            $table->string('name')->nullable()->after('tour_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_comments', function (Blueprint $table) {
            //
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dropColumn('name');

        });
    }
};
