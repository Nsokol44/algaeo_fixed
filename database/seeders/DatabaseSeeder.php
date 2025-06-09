<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a specific test user only if it doesn't already exist
        User::firstOrCreate(
            ['email' => 'test@example.com'], // Attributes to find
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Set a default password for the user
                'email_verified_at' => now(), // Optional: Mark email as verified
            ] // Attributes to create if not found
        );

        // Call other seeders here to populate their respective tables
        $this->call([
            // Example: If you have a dedicated UserSeeder for more dummy users
            // UserSeeder::class,

            // Call the FieldMetricsSeeder to populate dummy data for field metrics/graphs
            FieldMetricsSeeder::class,
        ]);
    }
}
