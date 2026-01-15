@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-5 animate-fade-in">
        <div class="col-12">
            <h1 class="display-5 h2 mb-2">{{ __('Admin Dashboard') }}</h1>
            <p class="text-muted">{{ __('Selamat datang kembali, Admin! Kelola seluruh sistem di sini.') }}</p>
        </div>
    </div>
    
    <div class="row g-4 animate-fade-in" style="animation-delay: 0.1s">
        <div class="col-md-3">
            <div class="glass-card h-100 p-4">
                <div class="bg-soft-primary p-3 rounded-circle d-inline-block mb-3">
                    <i class="bi bi-people text-primary fs-3"></i>
                </div>
                <h5 class="fw-bold">{{ __('Mahasiswa') }}</h5>
                <p class="text-muted small mb-4">{{ __('Kelola data akademik dan akun mahasiswa.') }}</p>
                <a href="{{ route('admin.students.index') }}" class="btn btn-primary w-100">{{ __('Kelola') }}</a>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="glass-card h-100 p-4">
                <div class="bg-soft-success p-3 rounded-circle d-inline-block mb-3">
                    <i class="bi bi-person-badge text-success fs-3"></i>
                </div>
                <h5 class="fw-bold">{{ __('Dosen') }}</h5>
                <p class="text-muted small mb-4">{{ __('Kelola penugasan dan akun pengajar.') }}</p>
                <a href="{{ route('admin.lecturers.index') }}" class="btn btn-primary w-100">{{ __('Kelola') }}</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card h-100 p-4">
                <div class="bg-soft-warning p-3 rounded-circle d-inline-block mb-3">
                    <i class="bi bi-book text-warning fs-3"></i>
                </div>
                <h5 class="fw-bold">{{ __('Mata Kuliah') }}</h5>
                <p class="text-muted small mb-4">{{ __('Daftarkan mata kuliah baru ke sistem.') }}</p>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-primary w-100">{{ __('Kelola') }}</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="glass-card h-100 p-4">
                <div class="bg-soft-info p-3 rounded-circle d-inline-block mb-3">
                    <i class="bi bi-calendar-event text-info fs-3"></i>
                </div>
                <h5 class="fw-bold">{{ __('Jadwal') }}</h5>
                <p class="text-muted small mb-4">{{ __('Atur jadwal perkuliahan dosen.') }}</p>
                <a href="{{ route('admin.schedules.index') }}" class="btn btn-primary w-100">{{ __('Kelola') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
