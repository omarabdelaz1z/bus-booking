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
        // Create one test user
        User::factory(1)->create();

        $this->call([
            StationSeeder::class,
            BusTripSeeder::class,
        ]);
    }
}
