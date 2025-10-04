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
        Schema::table('payments', function (Blueprint $table) {
            // tambahkan kolom user_id + foreign key
            $table->unsignedBigInteger('user_id')->nullable()->after('pickup_id');
             // tambahkan kolom pickup_date (datetime)
            $table->dateTime('payment_date')->nullable()->after('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
             // drop foreign key + kolom
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'payment_date']);
        });
    }
};
