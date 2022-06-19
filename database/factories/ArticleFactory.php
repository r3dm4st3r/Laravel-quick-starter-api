<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            DB::table('articles')->insert([
                'title' => $this->faker->sentence,
                'slug' => $this->faker->slug,
                'info' => $this->faker->sentence(10),
                'content' => $this->faker->sentence(50),
                'created_at' => now(),
                'updated_at' => now()
            ])
        ];
    }
}
