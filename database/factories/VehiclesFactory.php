<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vehicle_name' => fake()->word(),
            'vehicle_number' => 'GA 0' . rand(1,9) ." ". rand(0000,9999),
            'vehicle_color' => fake()->colorName(),
            'category_id' => rand(1,5),
        ];
    }
}
