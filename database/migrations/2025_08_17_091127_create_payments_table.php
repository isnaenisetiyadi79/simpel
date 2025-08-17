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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('pickup_id')->nullable();
            $table->float('amount');
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
