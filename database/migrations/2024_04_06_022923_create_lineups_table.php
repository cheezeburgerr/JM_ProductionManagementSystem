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
        Schema::create('lineups', function (Blueprint $table) {
            $table->id();
            $table->string('player_name');
            $table->string('player_details');
            $table->string('classification');
            $table->string('gender');
            $table->string('upper_size')->nullable();
            $table->string('short_size')->nullable();
            $table->string('short_name')->nullable();
            $table->unsignedBigInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineups');
    }
};
