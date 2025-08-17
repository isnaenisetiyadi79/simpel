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
        Schema::create('service_employee_work', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
            $table->foreign('work_id')
                ->references('id')
                ->on('works')
                ->onDelete('cascade');
            $table->foreign('employee_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            $table->timestamps();


            /* UNIQUE: MODEL 1
            1. Satu employee bisa punya banyak work, di banyak service.
            2. Tapi tidak boleh duplikat kombinasi persisnya.
            3. Cocok kalau sistemmu fleksibel (employee bisa kerja di beberapa service berbeda, dengan work yang sama).
            */
            $table->unique(['service_id', 'work_id', 'employee_id'], 'uniq_service_work_employee');

            /* UNIQUE: MODEL 2
            1.  Seorang employee hanya bisa punya satu jenis work.
            2.  Tapi work yang sama boleh dipakai di service berbeda.
            3.  Cocok kalau skill/pekerjaan (work) sifatnya melekat ke employee, bukan ke service.
            */
            // $table->unique(['employee_id', 'work_id'], 'uniq_employee_work');

            /* UNIQUE: MODEL 3
            1.  Satu service hanya boleh punya satu entry untuk employee tertentu.
            2.  Tapi employee bisa punya beberapa jenis work di service lain.
            3. Cocok kalau tujuanmu lebih ke siapa saja employee di service itu, bukan detail work-nya.
            */
            // $table->unique(['service_id', 'employee_id'], 'uniq_service_employee');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_employee_work');
    }
};
