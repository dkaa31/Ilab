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
        User::create(['name' => 'admin', 'email' => 'admin@neskar.com', 'status' => 'active', 'role' => 'admin', 'password' => 'admin']);
        User::create(['name' => 'guru', 'email' => 'guru@neskar.com', 'status' => 'active', 'role' => 'guru', 'password' => 'guru']);
        User::create(['name' => 'murid', 'email' => 'murid@neskar.com', 'status' => 'active', 'role' => 'murid', 'password' => 'murid']);
    }
}
