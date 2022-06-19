<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tags>
 */
class TagsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            DB::table('tags')->insert([
                'name' => $this->faker->words(1, true),
                'slug' => $this->faker->unique()->words(1, true),
                'created_at' => now(),
                'updated_at' => now()
            ])
        ];
    }
}
