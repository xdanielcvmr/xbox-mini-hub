<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Usuário normal
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('senha123'),
            'is_admin' => false,
        ]);
    }
}
