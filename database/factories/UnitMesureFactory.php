<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnitMesure>
 */
class UnitMesureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text,
            'category_unit_mesure_id' => $this->faker->randomNumber(1, 10),
            'created_by' => $this->faker->randomNumber(1, 10),
        ];
    }
}
