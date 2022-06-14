<?php

namespace Database\Factories;

use App\Models\Cargo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'customername' => $this->faker->name(),
            'customerphone' => $this->faker->phoneNumber(),
            'customeremail' => $this->faker->email(),
            'name'  => $this->faker->city(),
            'amount'  => random_int(1000000, 9000000),
            'weight'  => random_int(100, 1000),
            'invoice' => $this->faker->randomLetter(),
            'payment' => 'office',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Cargo $cargo) {
            $cargo->update([
                'updated_at' => Carbon::today()->subDays(rand(0, (365 * 6))),
            ]);
        });
    }
}
