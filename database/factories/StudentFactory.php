<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'student']),
            'nim' => $this->faker->unique()->numerify('2021####'),
            'major' => $this->faker->randomElement(['Informatika', 'Sistem Informasi', 'Teknik Komputer']),
            'class_year' => $this->faker->numberBetween(2020, 2023),
        ];
    }
}
