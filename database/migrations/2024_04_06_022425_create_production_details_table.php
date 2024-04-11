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
        Schema::create('production_details', function (Blueprint $table) {
            $table->id('production_details_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->unsignedBigInteger('printer_id')->nullable();
            $table->string('status')->default('Pending');
            $table->string('note')->nullable();

            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('artist_id')->references('employee_id')->on('employees');
            $table->foreign('printer_id')->references('id')->on('equipment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_details');
    }
};
