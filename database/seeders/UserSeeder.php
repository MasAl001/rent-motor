<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Admin Rental',
            'email' => 'admin@rentalmotor.test',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::firstOrCreate([
            'name' => 'Owner Rental',
            'email' => 'owner@rentalmotor.test',
            'password' => bcrypt('owner123'),
            'role' => 'owner',
            'email_verified_at' => now(),
        ]);
    }
}
