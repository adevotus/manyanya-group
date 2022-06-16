<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return voids
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        \App\Models\Cargo::factory()->create();
        // $this->call(UserSeeder::class);
    }
}
