<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $orderIds = DB::table('orders')->pluck('id')->toArray();
        $serviceIds = DB::table('services')->pluck('id')->toArray();

        foreach (range(1, 50) as $i) {
            $length = $faker->randomFloat(2, 1, 10);
            $width = $faker->randomFloat(2, 1, 10);
            $qty = $faker->randomFloat(2,1,10);
            $qty_asli = $faker->randomFloat(4, 1, 20);
            $qty_final = $qty_asli + $faker->randomFloat(4, -1, 1);
            $price = $faker->randomFloat(2, 50000, 300000);
            $subtotal = $qty_final * $price;

            DB::table('order_details')->insert([
                'order_id' => $faker->randomElement($orderIds),
                'service_id' => $faker->randomElement($serviceIds),
                'description' => $faker->sentence,
                'length' => $length,
                'width' => $width,
                'qty' => $qty,
                'qty_asli' => $qty_asli,
                'qty_final' => $qty_final,
                'price' => $price,
                'subtotal' => $subtotal,
                'process_status' => $faker->randomElement(['pending', 'process', 'done']),
                'pickup_status' => $faker->randomElement(['pending', 'completed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
