<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'users_family_name' => 'Test',
            'users_given_name' => 'Admin',
            'email' => 'sysadmin@example.com',
            'password' => Hash::make('password'),
            'users_role' => 'admin',
            'email_verified_at' => now()
        ]);
    }
}