<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:students',
            'major' => 'required|string',
            'class_year' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'major' => $request->major,
                'class_year' => $request->class_year,
            ]);
        });

        return redirect()->route('admin.students.index')->with('success', __('Student created successfully.'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->user_id,
            'nim' => 'required|string|unique:students,nim,' . $student->id,
            'major' => 'required|string',
            'class_year' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $student) {
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $student->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $student->update([
                'nim' => $request->nim,
                'major' => $request->major,
                'class_year' => $request->class_year,
            ]);
        });

        return redirect()->route('admin.students.index')->with('success', __('Student updated successfully.'));
    }

    public function destroy(Student $student)
    {
        DB::transaction(function () use ($student) {
            $user = $student->user;
            $student->delete();
            $user->delete();
        });

        return redirect()->route('admin.students.index')->with('success', __('Student deleted successfully.'));
    }
}
