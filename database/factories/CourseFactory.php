<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = [
            'Pemrograman Web', 'Algoritma dan Struktur Data', 'Basis Data', 
            'Jaringan Komputer', 'Sistem Operasi', 'Kecerdasan Buatan', 
            'Rekayasa Perangkat Lunak', 'Manajemen Proyek TI', 'Keamanan Siber', 
            'Pemrograman Mobile', 'Grafika Komputer', 'Pengolahan Citra Digital',
            'Sistem Informasi Manajemen', 'Interaksi Manusia dan Komputer', 'Etika Profesi',
            'Matematika Diskrit', 'Kalkulus', 'Statistika dan Probabilitas',
            'Bahasa Inggris', 'Pancasila'
        ];

        return [
            'code' => $this->faker->unique()->bothify('MK-####'),
            'name' => $this->faker->randomElement($courses),
            'credits' => $this->faker->numberBetween(2, 4),
        ];
    }
}
