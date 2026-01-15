<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required',
            'credits' => 'required|integer',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', __('Course created successfully.'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required',
            'credits' => 'required|integer',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', __('Course updated successfully.'));
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', __('Course deleted successfully.'));
    }
}
