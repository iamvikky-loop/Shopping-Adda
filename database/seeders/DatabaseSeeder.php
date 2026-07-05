<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Categories
        $this->call([
            CategorySeeder::class,
            // SubCategorySeeder::class, // Uncomment after creating it
            // BrandSeeder::class,
            // AttributeSeeder::class,
            // ProductSeeder::class,
            // BannerSeeder::class,
        ]);

        // Create Test User (only if it doesn't exist)
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );
    }
}