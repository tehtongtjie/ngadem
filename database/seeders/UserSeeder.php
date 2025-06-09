<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
User::create([
    'name' => 'Teknisi',
    'email' => 'teknisi@gmail.com',
    'password' => Hash::make('password'),
    'role' => 'teknisi', 
]);

User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'Customer',
    'email' => 'customer@gmail.com',
    'password' => Hash::make('password'),
    'role' => 'customer',
]);

    }
}
