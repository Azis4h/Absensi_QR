@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-5 animate-fade-in">
        <div class="col-md-8">
            <h1 class="display-5 h2 mb-2">{{ __('Halo, Bapak/Ibu Dosen!') }}</h1>
            <p class="text-muted">{{ __('Kelola sesi absensi dan pantau kehadiran mahasiswa Anda di sini.') }}</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('lecturer.session.create') }}" class="btn btn-primary btn-lg shadow-sm">
                <i class="bi bi-plus-circle me-2"></i>{{ __('Buka Sesi Baru') }}
            </a>
        </div>
    </div>

    <!-- Active Sessions Section -->
    <div class="row mb-5 animate-fade-in" style="animation-delay: 0.1s">
        <div class="col-12">
            <h4 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-soft-success p-2 rounded-3 me-3"><i class="bi bi-broadcast text-success"></i></span>
                {{ __('Sesi Aktif Sekarang') }}
            </h4>
        </div>
        @forelse($activeSessions as $session)
            <div class="col-md-4">
                <div class="glass-card border-0 p-4">
                    <span class="badge bg-success mb-3">{{ __('Sedang Berlangsung') }}</span>
                    <h5 class="fw-bold mb-1">{{ $session->schedule->course->name }}</h5>
                    <p class="text-muted small mb-4">
                        <i class="bi bi-clock me-1"></i> {{ __('Berakhir jam') }}: {{ $session->expires_at->format('H:i') }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ route('lecturer.session.qr', $session->id) }}" class="btn btn-outline-success flex-grow-1">
                            <i class="bi bi-qr-code me-2"></i>{{ __('QR') }}
                        </a>
                        <a href="{{ route('lecturer.session.show', $session->id) }}" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-people me-2"></i>{{ __('Hadir') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="glass-card p-5 text-center text-muted">
                    <i class="bi bi-cloud-slash fs-1 d-block mb-3 opacity-25"></i>
                    {{ __('Tidak ada sesi absensi yang sedang berjalan.') }}
                </div>
            </div>
        @endforelse
    </div>

    <!-- Schedules Section -->
    <div class="row animate-fade-in" style="animation-delay: 0.2s">
        <div class="col-12">
            <h4 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-soft-primary p-2 rounded-3 me-3"><i class="bi bi-calendar-week text-primary"></i></span>
                {{ __('Jadwal Mengajar Anda') }}
            </h4>
        </div>
        <div class="col-12">
            <div class="glass-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">{{ __('Mata Kuliah') }}</th>
                                <th class="py-3">{{ __('Waktu & Ruangan') }}</th>
                                <th class="py-3 text-center">{{ __('Aksi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $schedule->course->name }}</div>
                                        <div class="small text-muted">{{ $schedule->course->code }}</div>
                                    </td>
                                    <td>
                                        <div><i class="bi bi-calendar3 me-2 text-primary"></i>{{ __($schedule->day) }}</div>
                                        <div class="small text-muted"><i class="bi bi-geo-alt me-2"></i>{{ $schedule->start_time }} - {{ $schedule->end_time }} | {{ $schedule->room }}</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('lecturer.session.create', ['schedule_id' => $schedule->id]) }}" class="btn btn-soft-primary btn-sm px-4">
                                            {{ __('Buka Absensi') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
