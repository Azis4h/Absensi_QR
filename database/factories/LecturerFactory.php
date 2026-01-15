<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'lecturer']),
            'nip' => $this->faker->unique()->numerify('19##########'),
            'department' => $this->faker->randomElement(['Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Bisnis Digital']),
        ];
    }
}
