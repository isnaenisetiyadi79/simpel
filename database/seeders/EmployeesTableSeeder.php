<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('employees')->insert([
            [
                'name' => 'Deby Wahyudi',
                'phone' => '085278726272',
                'email' => 'deby@gmail.com',
                'address' => 'Olontigi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yoga Pratama',
                'phone' => '087262625252',
                'email' => 'yoga@gmail.com',
                'address' => 'Sumbersari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
