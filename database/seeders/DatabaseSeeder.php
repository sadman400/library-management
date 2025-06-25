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
        // Create a default admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
        ]);
        
        // Call seeders in order of dependencies
        $this->call([
            CategorySeeder::class,
            BookSeeder::class,
            UsertypeSeeder::class,
            MemberSeeder::class,
            BookIssuanceDetailSeeder::class,
            BookReturnDetailSeeder::class,
        ]);
    }
}
