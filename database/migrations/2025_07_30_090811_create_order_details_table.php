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
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('service_id');
            $table->text('description')->nullable();
            $table->decimal('length',8,2)->default(0);
            $table->decimal('width',8,2)->default(0);
            $table->decimal('qty',8,2)->default(0);
            $table->decimal('qty_asli', 12,4)->default(0);
            $table->decimal('qty_final', 12,4)->default(0);
            $table->decimal('price',12,2)->default(0);
            $table->decimal('subtotal', 14,2)->default(0);
            $table->enum('process_status', ['pending','process','done'])->default('pending');
            $table->enum('pickup_status',['pending','partially','completed'])->default('pending');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
