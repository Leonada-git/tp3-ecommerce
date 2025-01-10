<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->word,
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'descriptions' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products', true),
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
            'category' => $this->faker->word,
            'create_date' => $this->faker->date(),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
