<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceSession;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LecturerController extends Controller
{
    public function dashboard()
    {
        // Get lecturer's schedules
        return view('lecturer.dashboard');
    }

    public function createSession(Request $request) 
    {
        $courses = \App\Models\Schedule::where('lecturer_id', Auth::user()->lecturer->id)->with('course')->get();
        return view('lecturer.session.create', compact('courses'));
    }

    public function storeSession(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'duration' => 'required|integer|min:1',
        ]);

        $token = Str::random(32);
        
        $session = AttendanceSession::create([
            'schedule_id' => $request->schedule_id,
            'date' => now()->toDateString(),
            'qr_code' => $token,
            'expires_at' => now()->addMinutes($request->duration),
            'is_active' => true,
        ]);

        return redirect()->route('lecturer.session.qr', $session->id);
    }

    public function showQr($sessionId)
    {
        $session = AttendanceSession::findOrFail($sessionId);
        
        // Ensure the lecturer owns this session
        if ($session->schedule->lecturer_id !== Auth::user()->lecturer->id) {
            abort(403);
        }

        $qrCode = QrCode::size(300)->generate($session->qr_code);

        return view('lecturer.session.qr', compact('session', 'qrCode'));
    }
}
