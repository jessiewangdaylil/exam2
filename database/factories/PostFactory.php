<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(20),
            'content' => $this->faker->realText(50),
            'status' => $this->faker->randomElement(['draft','published']),
            'pic' => $this->faker->imageUrl(640,480),
            'sort' => rand(0,20),
            'enabled' => $this->faker->randomElement([true,false]),
        ];
    }
}
