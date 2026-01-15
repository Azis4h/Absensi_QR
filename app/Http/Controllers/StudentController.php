<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceSession;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return view('student.no_profile');
        }
        $attendances = \App\Models\Attendance::where('student_id', $student->id)
            ->with('attendanceSession.schedule.course')
            ->orderBy('scanned_at', 'desc')
            ->get();

        return view('student.dashboard', compact('attendances'));
    }

    public function scan()
    {
        return view('student.scan');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'qr_token' => 'required',
        ]);

        $session = AttendanceSession::where('qr_code', $request->qr_token)->first();

        if (!$session) {
            return back()->withErrors(['qr_token' => __('Invalid or expired QR code.')]);
        }

        if (!$session->is_active || now()->greaterThan($session->expires_at)) {
            return back()->withErrors(['qr_token' => __('Invalid or expired QR code.')]);
        }

        // Check Enrollment (KRS)
        $student = Auth::user()->student;
        $courseId = $session->schedule->course_id;
        
        if (!$student->courses()->where('course_id', $courseId)->exists()) {
             return redirect()->route('student.dashboard')->with('error', __('Anda tidak terdaftar di mata kuliah ini (KRS).'));
        }

        // Check if already attended
        $existing = Attendance::where('attendance_session_id', $session->id)
            ->where('student_id', Auth::user()->student->id)
            ->first();

        if ($existing) {
            return redirect()->route('student.dashboard')->with('info', __('You have already recorded your attendance for this session.'));
        }

        Attendance::create([
            'attendance_session_id' => $session->id,
            'student_id' => Auth::user()->student->id,
            'scanned_at' => now(),
            'status' => 'present',
        ]);

        return redirect()->route('student.dashboard')->with('success', __('Attendance recorded successfully.'));
    }
}
