<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        Role::create(['name' => 'Operator', 'slug' => 'operator']);
        Role::create(['name' => 'Owner', 'slug' => 'owner']);
        Role::create(['name' => 'Kasir', 'slug' => 'kasir']);
    }
}
