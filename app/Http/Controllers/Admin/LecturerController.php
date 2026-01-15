<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::with('user')->get();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nip' => 'required|string|unique:lecturers',
            'department' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'lecturer',
            ]);

            Lecturer::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'department' => $request->department,
            ]);
        });

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer created successfully.'));
    }

    public function edit(Lecturer $lecturer)
    {
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $lecturer->user_id,
            'nip' => 'required|string|unique:lecturers,nip,' . $lecturer->id,
            'department' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $lecturer) {
            $lecturer->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $lecturer->user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $lecturer->update([
                'nip' => $request->nip,
                'department' => $request->department,
            ]);
        });

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer updated successfully.'));
    }

    public function destroy(Lecturer $lecturer)
    {
        DB::transaction(function () use ($lecturer) {
            $user = $lecturer->user;
            $lecturer->delete();
            $user->delete();
        });

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer deleted successfully.'));
    }
}
