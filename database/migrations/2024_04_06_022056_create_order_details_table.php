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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('apparel');
            $table->string('jersey_cut')->nullable();
            $table->string('neck_type')->nullable();
            $table->string('short_type')->nullable();
            $table->string('polo_type')->nullable();
            $table->string('polo_collar')->nullable();
            $table->string('fabric')->nullable();
            $table->string('design_image')->nullable();
            $table->string('price')->nullable();
            $table->string('total_price')->nullable();

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
        Schema::dropIfExists('order_details');
    }
};
