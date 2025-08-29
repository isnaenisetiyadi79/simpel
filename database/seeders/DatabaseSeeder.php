<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([

        // ]);
        $admin = User::create([
            'name' => 'Simpel',
            'email' => 'simpel@gmail.com',
            'password' => Hash::make('simpel'),
        ]);

        $operator = User::create([
            'name' => 'Operator User',
            'email' => 'operator@yahoo.com',
            'password' => Hash::make('password'),
        ]);

        $siswa = User::create([
            'name' => 'Siswa User',
            'email' => 'siswa@google.com',
            'password' => Hash::make('password'),
        ]);
        $owner = User::create([
            'name' => 'Owner User',
            'email' => 'owner@google.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            RoleSeeder::class,
            // CustomersTableSeeder::class,
            // ServicesTableSeeder::class,
            // OrdersTableSeeder::class,
            // OrderDetailsTableSeeder::class,
            // WorksTableSeeder::class,
            // EmployeesTableSeeder::class,
        ]);
        $admin->roles()->attach(Role::where('slug', 'admin')->first());
        $operator->roles()->attach(Role::where('slug', 'operator')->first());
        $siswa->roles()->attach(Role::where('slug', 'kasir')->first());
        $owner->roles()->attach(Role::where('slug', 'owner')->first());

        // Role::factory()->create([
        //     ['name' => 'Administrator', 'slug' => 'admin'],
        //     ['name' => 'Operator', 'slug' => 'operator'],
        //     ['name' => 'Siswa', 'slug' => 'siswa'],
        // ]);
    }
}
