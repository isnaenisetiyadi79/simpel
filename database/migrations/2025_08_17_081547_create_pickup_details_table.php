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
        Schema::create('pickup_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pickup_id');
            $table->unsignedBigInteger('order_detail_id');
            $table->decimal('qty',8,2)->default(1);
            $table->timestamps();
            $table->foreign('pickup_id')
            ->references('id')
            ->on('pickups')->onDelete('cascade');
            $table->foreign('order_detail_id')
            ->references('id')
            ->on('order_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_details');
    }
};
