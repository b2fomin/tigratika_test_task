<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'amount' => $this->faker->numberBetween(0, 100),
            'source' => $this->faker->word,
            'lazer' => $this->faker->numberBetween(100, 1000),
            'welding' => $this->faker->numberBetween(100, 1000),
            'electricity' => $this->faker->numberBetween(100, 1000)
        ];
    }
}
