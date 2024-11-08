<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubGroup>
 */
class SubGroupFactory extends Factory
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
            'group_id' => $this->faker->numberBetween(1, Group::count())
        ];
    }
}
