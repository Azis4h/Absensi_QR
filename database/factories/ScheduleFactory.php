<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->time('H:i');
        return [
            'course_id' => Course::factory(),
            'lecturer_id' => Lecturer::factory(),
            'day' => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'start_time' => $startTime,
            'end_time' => date('H:i', strtotime($startTime) + 7200), // +2 hours
            'room' => $this->faker->bothify('R-###'),
        ];
    }
}
