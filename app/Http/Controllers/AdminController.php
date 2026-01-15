<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Lecturer;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Include methods for managing Students, Lecturers, Courses, Schedules
}
