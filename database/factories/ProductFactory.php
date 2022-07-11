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
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(),
            'name' => $this->faker->unique()->name(),
            'production_date' => $this->faker->date(),
            'expiry_date' => $this->faker->date(),
            'price' => $this->faker->numberBetween(1, 100),
            'barcode_number' => $this->faker->unique()->numberBetween(1, 100),
            'unit' => $this->faker->unique()->word(),
            'is_available' => $this->faker->boolean(),
            'description' => $this->faker->text(),
        ];
    }
}
