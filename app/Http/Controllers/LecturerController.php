<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceSession;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LecturerController extends Controller
{
    public function dashboard()
    {
        $lecturer = Auth::user()->lecturer;
        
        if (!$lecturer) {
            return view('lecturer.no_profile');
        }

        $schedules = \App\Models\Schedule::where('lecturer_id', $lecturer->id)->with('course')->get();
        $activeSessions = AttendanceSession::whereIn('schedule_id', $schedules->pluck('id'))
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->with('schedule.course')
            ->get();

        return view('lecturer.dashboard', compact('schedules', 'activeSessions'));
    }

    public function createSession(Request $request) 
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return view('lecturer.no_profile');
        }

        $courses = \App\Models\Schedule::where('lecturer_id', $lecturer->id)->with('course')->get();
        return view('lecturer.session.create', compact('courses'));
    }

    public function storeSession(Request $request)
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return view('lecturer.no_profile');
        }

        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'duration' => 'required|integer|min:1',
        ]);

        // Verify ownership
        $schedule = \App\Models\Schedule::where('id', $request->schedule_id)
            ->where('lecturer_id', $lecturer->id)
            ->first();

        if (!$schedule) {
            abort(403, __('Jadwal tidak ditemukan atau bukan milik Anda.'));
        }

        $token = Str::random(32);
        
        $session = AttendanceSession::create([
            'schedule_id' => $request->schedule_id,
            'date' => now()->toDateString(),
            'qr_code' => $token,
            'expires_at' => now()->addMinutes((int) $request->duration),
            'is_active' => true,
        ]);

        return redirect()->route('lecturer.session.qr', $session->id)->with('success', __('Attendance session created successfully.'));
    }

    public function showQr($sessionId)
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return view('lecturer.no_profile');
        }

        $session = AttendanceSession::with('schedule')->findOrFail($sessionId);
        
        // Ensure the lecturer owns this session
        if ($session->schedule->lecturer_id !== $lecturer->id) {
            abort(403);
        }

        $qrCode = QrCode::size(300)->generate($session->qr_code);

        return view('lecturer.session.qr', compact('session', 'qrCode'));
    }

    public function show($sessionId)
    {
        $lecturer = Auth::user()->lecturer;

        if (!$lecturer) {
            return view('lecturer.no_profile');
        }

        $session = AttendanceSession::with(['schedule.course', 'attendances.student.user'])
            ->findOrFail($sessionId);
        
        // Ensure the lecturer owns this session
        // Ensure the lecturer owns this session
        if ($session->schedule->lecturer_id !== $lecturer->id) {
             dd('DEBUG: Auth Error', 
                'Session Schedule Lecturer ID: ' . $session->schedule->lecturer_id, 
                'Current Lecturer ID: ' . $lecturer->id,
                'Types: ' . gettype($session->schedule->lecturer_id) . ' vs ' . gettype($lecturer->id)
            );
            // abort(403);
        }

        return view('lecturer.session.show', compact('session'));
    }
}
