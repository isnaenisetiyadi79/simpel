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
        Schema::create('pickup_detail_employee_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pickup_detail_id');
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('employee_id');
            $table->decimal('pay_default',8,2)->default(0);
            $table->boolean('is_paid')->default(false)
            ->comment('untuk menandai pembayaran one_time atau tidak,
             false untuk yang work bukan one_time');
            $table->timestamps();
            $table->foreign('pickup_detail_id')
            ->references('id')
            ->on('pickup_details')
            ->onDelete('cascade');
            $table->foreign('work_id')
            ->references('id')
            ->on('works')
            ->onDelete('cascade');
            $table->foreign('employee_id')
            ->references('id')
            ->on('employees')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_detail_employee_works');
    }
};
