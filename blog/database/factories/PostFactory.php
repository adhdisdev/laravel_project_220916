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
            'title' => $this->faker->sentence(5),
            'tags' => implode(',', array_rand(array_flip(['PHP','LARAVEL','BULMA','CSS','SCSS','HTML','DEVLOG']), 3)),
            'body' => $this->faker->sentence(50),
        ];
    }
}
