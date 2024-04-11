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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('address');
            $table->string('contact_number');
            $table->date('due_date');
            $table->unsignedBigInteger('order_details_id');
            $table->unsignedBigInteger('production_details_id');

            $table->foreign('order_details_id')->references('id')->on('order_details');
            $table->foreign('production_details_id')->references('id')->on('production_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
