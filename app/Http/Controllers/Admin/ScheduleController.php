<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['course', 'lecturer'])->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.schedules.create', compact('courses', 'lecturers', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', __('Jadwal berhasil ditambahkan.'));
    }

    public function edit(Schedule $schedule)
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.schedules.edit', compact('schedule', 'courses', 'lecturers', 'days'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', __('Jadwal berhasil diperbarui.'));
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', __('Jadwal berhasil dihapus.'));
    }
}
