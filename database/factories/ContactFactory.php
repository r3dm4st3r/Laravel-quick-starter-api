<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            DB::table('contacts')->insert([
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'country' => $this->faker->country,
                'website' => $this->faker->url,
                'app' => $this->faker->company,
                'appInfo' => $this->faker->jobTitle,
                'message' => $this->faker->sentence,
                'created_at' => now(),
                'updated_at' => now()
            ])
        ];
    }
}
