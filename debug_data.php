<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Lecturer;
use App\Models\Schedule;

echo "--- USERS (Lecturer Role) ---\n";
foreach (User::where('role', 'lecturer')->get() as $u) {
    echo "ID: {$u->id}, Name: {$u->name}, Email: {$u->email}, Profile: " . ($u->lecturer ? "EXISTS (ID: {$u->lecturer->id})" : "MISSING") . "\n";
}

echo "\n--- SCHEDULES ---\n";
foreach (Schedule::with(['course', 'lecturer.user'])->get() as $s) {
    echo "ID: {$s->id}, Course: {$s->course->name}, Lecturer Profile ID: {$s->lecturer_id}, Assigned To: " . ($s->lecturer->user->name ?? 'UNKNOWN') . "\n";
}
