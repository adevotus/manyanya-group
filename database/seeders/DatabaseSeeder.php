<?php

namespace Database\Seeders;

use App\Models\Post;
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
        Post::factory(20)->create();
        $this->call(LaratrustSeeder::class);
        // $this->call(ExpenseSeeder::class);
    }
}
