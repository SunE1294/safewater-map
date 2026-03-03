<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tubewell; // Importing the Tubewell model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Remove the comments from Tubewell factory to create 500 data points
        Tubewell::factory(500)->create();

        /* 2. We are NOT using User::factory() because the file is missing.
           If you need a test user, you can manually create one like this:
        */
        /*
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@safewater.com',
            'password' => bcrypt('password123'),
        ]);
        */
    }
}