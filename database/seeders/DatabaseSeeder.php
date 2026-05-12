<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin PCR',
            'email' => 'admin@pcr.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
