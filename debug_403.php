<?php

use App\Models\AttendanceSession;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Manually login a lecturer if possible, or just check the data relationships directly
// Since we can't easily fake Auth::user() without a request, let's just look at the data consistency

$session = AttendanceSession::with('schedule')->latest()->first();

if (!$session) {
    echo "No attendance sessions found.\n";
    exit;
}

echo "Latest Session ID: " . $session->id . "\n";
echo "Schedule ID: " . $session->schedule_id . "\n";

$schedule = $session->schedule;
if (!$schedule) {
    echo "Schedule not found for this session.\n";
    exit;
}

echo "Schedule Lecturer ID: " . $schedule->lecturer_id . " (Type: " . gettype($schedule->lecturer_id) . ")\n";

$lecturer = Lecturer::find($schedule->lecturer_id);
if ($lecturer) {
    echo "Lecturer Found: ID " . $lecturer->id . " (Type: " . gettype($lecturer->id) . ")\n";
    echo "Lecturer User ID: " . $lecturer->user_id . "\n";
} else {
    echo "Lecturer NOT found.\n";
}

// Check for any type mismatch issues
if ($schedule->lecturer_id !== $lecturer->id) {
    echo "MISMATCH DETECTED: \$schedule->lecturer_id !== \$lecturer->id\n";
} else {
    echo "Match confirmed: \$schedule->lecturer_id === \$lecturer->id\n";
}
