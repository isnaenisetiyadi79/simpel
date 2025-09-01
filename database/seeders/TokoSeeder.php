<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TokoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tokos')->insert([
            'name' => 'Toko Sukses Selalu',
            'slogan' => 'Belanja Hemat, Harga Bersahabat',
            'phone_number' => '081234567890',
            'address' => 'Jl. Merdeka No. 123, Palu, Sulawesi Tengah',
            'note' => 'Buka setiap hari jam 08:00 - 21:00',
            'printer_width' => 80,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
