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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->boolean('is_package')
            ->default(false)
            ->comment('Centang jika layanan paket, tidak pakai dimensi panjang x lebar');
            $table->string('unit', 50)
            ->nullable()
            ->comment('Satuan layanan, contoh: pcs, meter, cm, pack, kg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
