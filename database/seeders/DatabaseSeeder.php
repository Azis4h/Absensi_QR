<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Data Utama (Specific Accounts)
        
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Specific Lecturer
        $lecturerUser = User::create([
            'name' => 'Lecturer User',
            'email' => 'lecturer@example.com',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
        ]);
        $specificLecturer = Lecturer::create([
            'user_id' => $lecturerUser->id,
            'nip' => '123456789',
            'department' => 'Informatika',
        ]);

        // Specific Student
        $studentUser = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
        Student::create([
            'user_id' => $studentUser->id,
            'nim' => '20210001',
            'major' => 'Teknik Informatika',
            'class_year' => '2021',
        ]);


        // 2. Generate Dummy Data using Factories

        // Create 10 Courses
        $courses = \App\Models\Course::factory(10)->create();

        // Create 5 Additional Lecturers
        $lecturers = \App\Models\Lecturer::factory(5)->create();

        // Create 20 Additional Students
        \App\Models\Student::factory(20)->create();
        
        // Include the specific lecturer in the pool for scheduling
        $allLecturers = $lecturers->push($specificLecturer);

        // Create Schedules
        // For each course, create 1-2 schedules with random lecturers
        foreach ($courses as $course) {
            \App\Models\Schedule::factory(rand(1, 2))->create([
                'course_id' => $course->id,
                'lecturer_id' => $allLecturers->random()->id,
            ]);
        }
        
        // 3. Enrollment (KRS)
        // Enroll specific student to all courses for easier testing
        $specificStudent = \App\Models\Student::where('user_id', $studentUser->id)->first();
        $specificStudent->courses()->attach($courses);

        // Enroll other students to random 3-5 courses
        $allStudents = \App\Models\Student::all();
        foreach ($allStudents as $student) {
            if($student->id === $specificStudent->id) continue;
            $student->courses()->attach($courses->random(rand(3, 5)));
        }
    }
}
