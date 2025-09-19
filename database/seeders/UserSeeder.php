<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin Default
        User::updateOrCreate(
            ['email' => 'admin@site.com'],
            [
                'name' => 'Admin Levia',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // User Default
        User::updateOrCreate(
            ['email' => 'user@site.com'],
            [
                'name' => 'User Levia',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
