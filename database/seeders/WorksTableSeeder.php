<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('works')->insert([
            [
                'name' => 'Desain',
                'description' => 'Desain Baliho kemudian cetak',
                'default_pay' => 45000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cetak',
                'description' => 'Cetak Saja',
                'default_pay' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
