<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image_url' => $this->getRandomLoremPicsumUrl(),
        ];
    }

    /**
     * Get a random Lorem Picsum image URL.
     *
     * @return string
     */
    protected function getRandomLoremPicsumUrl(): string
    {
        $width = 640;
        $height = 480;

        return "https://picsum.photos/id/{$this->faker->numberBetween(1, 500)}/{$width}/{$height}";
    }
}
