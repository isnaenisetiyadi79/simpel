<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $units = ['pcs', 'meter', 'cm', 'pack', 'kg', 'box'];

        foreach (range(1, 5) as $i) {
            DB::table('services')->insert([
                'name' => ucfirst($faker->words(rand(1, 3), true)),
                'description' => $faker->sentence(10),
                'price' => $faker->randomFloat(2, 50000, 500000),
                'is_package'  => $faker->boolean(30), // 30% kemungkinan paket
                'unit'        => $faker->randomElement($units),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
