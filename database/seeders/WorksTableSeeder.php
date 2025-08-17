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
                'description' => 'Upah tukang desain',
                'default_pay' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cetak',
                'description' => 'Upah tukang cetak',
                'default_pay' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
