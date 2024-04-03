<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'shop_name' => fake()->company(),
            'shop_theme' => fake()->colorName(),
            'biography' => fake()->sentence(20),
            'user_id' => DB::table('users')->inRandomOrder()->first()->id,
        ];
    }
}
