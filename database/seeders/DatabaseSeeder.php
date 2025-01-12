<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();

        User::factory()->create([
            'name' => 'Anthony Jennings',
            'email' => 'antjennings@example.com',
            'password' => 'P@ssw0rd'
        ]);
        User::factory()->create([
            'name' => 'Daniel Padilla',
            'email' => 'danipads@example.com',
            'password' => 'P@ssw0rd'
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'P@ssw0rd'
        ]);
        
    }
}
