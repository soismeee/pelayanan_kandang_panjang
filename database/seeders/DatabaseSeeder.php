<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id' => intval((microtime(true) * 10000)),
            'name' => 'administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'verified' => "1",
            'status' => 'active',
        ]);
    }
}
