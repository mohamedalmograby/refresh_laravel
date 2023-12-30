<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => $this->faker->unique()->uuid,
            'status' => $this->faker->randomElement(['pending', 'completed', 'shipped']),
            'total_amount' => $this->faker->randomFloat(2, 50, 500),
            'payment_status' => $this->faker->randomElement(['pending', 'paid']),
        ];
    }
}
