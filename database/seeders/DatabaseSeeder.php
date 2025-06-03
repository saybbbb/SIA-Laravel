<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SupplierSeeder::class,
            WaterSeeder::class,
        ]);

        // Seed Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // use a strong password!
            'role' => 'admin',
            'status' => 'approved',  // admin should be approved by default
        ]);

        // Seed Staff user
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'status' => 'pending',  // you can also seed as approved or pending for test
        ]);
    }
}
