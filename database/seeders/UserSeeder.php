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
        // Create admin user (login dengan email + password di Filament)
        User::create([
            'name' => 'Admin',
            'nip' => '123456789',
            'email' => 'admin@perjadin.local',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create test users (login dengan NIP + Nama di user page)
        User::create([
            'name' => 'Budi Santoso',
            'nip' => '987654321',
            'email' => 'budi@perjadin.local',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'nip' => '456789123',
            'email' => 'siti@perjadin.local',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
