<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Schedule;

echo "\n--- LECTURER ACCOUNTS ---\n";
foreach (User::where('role', 'lecturer')->get() as $u) {
    echo "Name: {$u->name} (ID: {$u->id}) - Profile ID: " . ($u->lecturer->id ?? 'NONE') . "\n";
}

echo "\n--- ALL SCHEDULES ---\n";
foreach (Schedule::with(['course', 'lecturer.user'])->get() as $s) {
    echo "Course: {$s->course->name} | Day: {$s->day} | Assigned To: " . ($s->lecturer->user->name ?? 'UNKNOWN') . " (Lecturer ID: {$s->lecturer_id})\n";
}
