<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->date();
        return [
            'name' => fake()->name(),
            'department' => fake()->name(),
            'start_date' => fake()->date(),
            'end_date' => fake()->dateTimeBetween($start, now()), //should be after start
            'status' => fake()->name(),
        ];
    }
}
