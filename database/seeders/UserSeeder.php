<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $role = [
        'superadministrator',
        'manager',
        'muhasibu',
        'driver'
    ];
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => Str::random(8),
                'email' => Str::random(20) . '@example.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
            $user->attachRole($this->role[array_rand($this->role)]);
        }
    }
}
