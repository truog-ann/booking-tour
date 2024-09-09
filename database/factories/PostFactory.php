<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
           'title'=>fake()->text(10),
           'body'=>fake()->text(50),
           'tags'=>fake()->text(10),
           'user_id'=>fake()->numberBetween(1), 
        ];
    }
}
