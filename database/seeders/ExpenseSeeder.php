<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Cargo;
use App\Models\Expense;
use App\Models\Payment;
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

    public $mode = [
        'full',
        'installment'
    ];

    public $agent = [
        'bank',
        'cash',
        'agent'
    ];

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i < 100; $i++) {
            $user = User::create([
                'name'  => $faker->userName(),
                'email' => $faker->unique()->safeEmail(),
                'fname' => $faker->firstName(),
                'lname' => $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);

            $user->attachRole('driver');

            Activity::create([
                'action' => 'ADD USER',
                'description' => 'User ' . $user->name . ' with email ' . $user->email . ' was added successful',
                'user_id' => 4,
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            $date = Carbon::tomorrow()->subDays(rand(0, (365 * 6)));
            $vehicle = Vehicle::create([
                'name'  => $this->vehicle[array_rand($this->vehicle)],
                'platenumber'  => $faker->creditCardNumber(),
                'reg_number'  => $faker->uuid(),
                'condition'  => 'new',
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Activity::create([
                'action' => 'ADD VEHICLE',
                'description' => 'Vehicle ' . $vehicle->name . ' with plate number ' . $vehicle->platenumber . ' was added',
                'user_id' => 5,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        for ($i = 1; $i < 5000; $i++) {
            $date = Carbon::tomorrow()->subDays(rand(0, (365 * 6)));

            $expense = Expense::create([
                'description'  => $faker->sentence(),
                'amount'  => $faker->numberBetween(10000, 1000000),
                'user_id' =>  rand(1, 50),

                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Activity::create([
                'action' => 'ADD EXPENSE SPENT',
                'description' => 'Expense with amount ' . $expense->amount . ' was added',
                'user_id' =>  rand(1, 50),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        for ($i = 1; $i < 10001; $i++) {
            $date = Carbon::tomorrow()->subDays(rand(0, (365 * 6)));

            $cargo = Cargo::create([
                'customername' => $faker->name(),
                'customerphone' => $faker->phoneNumber(),
                'customeremail' =>  $faker->unique()->safeEmail(),
                'name' => $this->mizigo[array_rand($this->mizigo)],
                'amount' => rand(30000, 100000),
                'weight' =>  rand(10, 100),
                'total' =>  0,
                'status' =>  true,
                'invoice' => $faker->uuid(),
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Activity::create([
                'action' => 'ADD CARGO',
                'description' => 'cargo ' . $cargo->name . ' with weight ' . $cargo->weight . ' for customer ' . $cargo->customername . ' and  phone number ' . $cargo->customerphone . ' was added',
                'user_id' => 4,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        for ($i = 1; $i < 10001; $i++) {
            $date =  Carbon::tomorrow()->subDays(rand(0, (365 * 6)));

            $mode = $this->mode[array_rand($this->mode)];
            $agent = $this->agent[array_rand($this->agent)];

            $cargo = Cargo::where('id', $i)->first();

            $route = Route::create([
                'route' => $faker->country() . '-' . $faker->country(),
                'fuel' => rand(1000, 10000),
                'trip' => $this->trip[array_rand($this->trip)],
                'date' => $date,
                'drive_allowance' => rand(50000, 200000),
                'cargo_id' => $i,
                'driver_id' => rand(10, 100),
                'vehicle_id' => rand(1, 50),
                'price' => $cargo->amount * $cargo->weight,
                'mode' => $mode,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Activity::create([
                'action' => 'ADD ROUTE',
                'description' => 'Route ' . $route->route . ' was added',
                'user_id' =>  4,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            if ($mode  === 'full') {
                Payment::create([
                    'description' => 'Full',
                    'price' => $route->price,
                    'installed' => 0,
                    'remaining' => 0,
                    'route_id' => $route->id,
                    'payment_method' => $agent,
                ]);

                Activity::create([
                    'action' => 'ADD PAYMENT',
                    'description' => 'Full Payment of TZS ' . $route->price . 'for route ' . $route->route . ' was successful paid',
                    'user_id' =>  3,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            } else {
                $installed = rand(50000, 250000);

                Payment::create([
                    'description' => 'Advanced Installment',
                    'price' => $route->price,
                    'installed' => $installed,
                    'remaining' => $route->price - $installed,
                    'route_id' => $route->id,
                    'payment_method' => $agent,
                ]);

                Activity::create([
                    'action' => 'ADD PAYMENT',
                    'description' => 'Advanced Payment of TZS ' . $installed . 'for route ' . $route->route . ' was successful paid the remaining amount is TZS ' .
                        ($route->price - $installed),
                    'user_id' =>  3,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
