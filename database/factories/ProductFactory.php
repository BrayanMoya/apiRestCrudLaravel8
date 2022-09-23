<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        return [
            'notes' => $faker->sentence(),
            'cost' => $faker->randomFloat(2, 10000, 500000),
            'stock' => $faker->randomNumber(3)
        ];
    }
}
