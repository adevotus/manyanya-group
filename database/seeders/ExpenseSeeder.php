<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Expense;
use App\Models\Route;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Vehicle;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $vehicle = [
        'Toyota',
        'Tesla',
        'Ford',
        'Scania',
        'Honda',
    ];

    public $mizigo = [
        'Ndizi',
        'Mbao',
        'Matunda',
        'Ngombe',
        'Nguruwe',
        'Mafuta',
        'Vinywaji',
        'Madini',
        'Mchanga',
    ];

    public $trip = [
        'Go',
        'return'
    ];

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i < 1001; $i++) {
            $user = User::create([
                'name'  => $faker->userName(),
                'email' => $faker->unique()->safeEmail(),
                'fname' => $faker->firstName(),
                'lname' => $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);

            $user->attachRole('driver');
        }

        for ($i = 1; $i < 1001; $i++) {
            Vehicle::create([
                'name'  => $this->vehicle[array_rand($this->vehicle)],
                'platenumber'  => $faker->creditCardNumber(),
                'reg_number'  => $faker->uuid(),
                'condition'  => 'new',
                'created_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 6))),
                'updated_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 5))),
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            Expense::create([
                'description'  => $faker->sentence(),
                'amount'  => $faker->numberBetween(10000, 1000000),
                'created_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 6))),
                'updated_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 5))),
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            Cargo::create([
                'customername' => $faker->name(),
                'customerphone' => $faker->phoneNumber(),
                'customeremail' =>  $faker->unique()->safeEmail(),
                'name' => $this->mizigo[array_rand($this->mizigo)],
                'amount' => rand(30000, 100000),
                'weight' =>  rand(1, 100),
                'total' =>  0,
                'invoice' => $faker->uuid(),
                'created_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 6))),
                'updated_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 5))),
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            $date =  Carbon::today()->subDays(rand(0, (365 * 6)));

            Route::create([
                'route' => $faker->country() . '-' . $faker->country(),
                'fuel' => rand(1000, 10000),
                'trip' => $this->trip[array_rand($this->trip)],
                'date' => $date,
                'drive_allowance' => rand(50000, 200000),
                'cargo_id' => $i,
                'driver_id' => $i + 5,
                'vehicle_id' => $i,
                'price' => (Cargo::where('id', $i)->first())->amount,
                'mode' => 'full',
                'payment_method' => 'bank',
                'created_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 1))),
                'updated_at' => Carbon::tomorrow()->subDays(rand(0, (365 * 1))),
            ]);
        }
    }
}
