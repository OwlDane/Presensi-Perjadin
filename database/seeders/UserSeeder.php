<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'nip' => '123456789',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Create test users
        User::create([
            'name' => 'Budi Santoso',
            'nip' => '987654321',
            'password' => Hash::make('user'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'nip' => '456789123',
            'password' => Hash::make('user'),
            'role' => 'user',
        ]);
    }
}
