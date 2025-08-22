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
        //
         Schema::table('pickups', function (Blueprint $table) {
            // ubah kolom pickup_date dari date → datetime
            $table->dateTime('pickup_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('pickups', function (Blueprint $table) {
            // rollback ke tipe awal (date)
            $table->date('pickup_date')->change();
        });
    }
};
