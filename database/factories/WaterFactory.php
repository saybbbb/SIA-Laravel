<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Water>
 */
class WaterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pump_name' => $this->faker->randomElement(['A', 'B']),
            'total_water_used' => $this->faker->randomFloat(2, 100, 1000),
            'last_maintenance' => $this->faker->date(),
            'health_check' => $this->faker->randomElement(['Normal', 'Warning']),
        ];
    }
}
