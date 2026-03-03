<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tubewell>
 */
class TubewellFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'lat' => $this->faker->latitude(20.5, 26.5),
        'lng' => $this->faker->longitude(88.5, 92.5),
        'status' => $this->faker->randomElement(['safe', 'danger', 'untested']),
        'area_name' => $this->faker->city(),
        'is_verified' => true,
    ];
}
}
