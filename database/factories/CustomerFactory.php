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
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'full_name' => $this->faker->name,
            'billing_address' => $this->faker->address,
            'default_shipping_address' => $this->faker->address,
            'country' => $this->faker->country,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
