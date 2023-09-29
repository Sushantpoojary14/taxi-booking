<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fullname' => fake()->name(),
            'location' => fake()->word(),
            'coordinate' => rand(100, 500),
            'distance' => rand(00, 150),
            'time_taken' => fake()->time(),
            'phone' => fake()->phoneNumber(),
            'customer_token' => rand(0001, 5000),
            'invoice_id'=> fake()->word(),
            'amount' => rand(500, 5000),
            'total_amount' =>rand(100, 5000),
            'relation_id' => rand(1, 100),
            'payment_mode' => fake()->word(),
            'booking_time' => fake()->time(),
            'booking_date' => fake()->dateTimeThisMonth()
        ];
    }
}
