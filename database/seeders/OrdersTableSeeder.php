<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
         $faker = Faker::create();
        $customerIds = DB::table('customers')->pluck('id')->toArray();

        foreach (range(1, 20) as $i) {
            DB::table('orders')->insert([
                'customer_id' => $faker->randomElement($customerIds),
                'payment_status' => $faker->randomElement(['unpaid', 'paid', 'partially_paid']),
                'total_amount' => $faker->randomFloat(2, 100000, 2000000),
                'order_date' => $faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
                'note' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
