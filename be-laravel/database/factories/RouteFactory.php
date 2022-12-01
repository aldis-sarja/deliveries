<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    private static $carNumbers = ['FK-1111', 'FK-2222'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'car_number' => self::$carNumbers[array_rand(self::$carNumbers)],
            'status' => random_int(1, 3),
            'driver_name' => $this->faker->name()
        ];
    }
}
