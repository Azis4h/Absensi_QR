@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-5 animate-fade-in">
        <div class="col-12 text-center text-md-start">
            <h1 class="display-5 h2 mb-2">{{ __('Halo, Selamat Datang!') }}</h1>
            <p class="text-muted">{{ __('Silakan scan QR Code dosen untuk mencatat kehadiranmu hari ini.') }}</p>
        </div>
    </div>

    <!-- Scan Action Card -->
    <div class="row mb-5 justify-content-center animate-fade-in" style="animation-delay: 0.1s">
        <div class="col-md-6">
            <div class="glass-card p-5 text-center border-0 shadow-lg" style="background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), rgba(14, 165, 233, 0.05));">
                <div class="bg-soft-primary p-4 rounded-circle d-inline-block mb-4">
                    <i class="bi bi-qr-code-scan text-primary display-4"></i>
                </div>
                <h3 class="fw-bold mb-3">{{ __('Siap Absensi?') }}</h3>
                <p class="text-muted mb-4">{{ __('Pastikan Anda berada di dalam kelas dan arahkan kamera ke QR Code yang ditampilkan dosen.') }}</p>
                <a href="{{ route('student.scan') }}" class="btn btn-primary btn-lg px-5 py-3 shadow">
                    <i class="bi bi-camera me-2"></i>{{ __('Mulai Scan QR') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Attendance History Section -->
    <div class="row animate-fade-in" style="animation-delay: 0.2s">
        <div class="col-12">
            <h4 class="fw-bold mb-4 d-flex align-items-center">
                <span class="bg-soft-info p-2 rounded-3 me-3"><i class="bi bi-clock-history text-info"></i></span>
                {{ __('Riwayat Kehadiran Kamu') }}
            </h4>
        </div>
        <div class="col-12">
            <div class="glass-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">{{ __('Mata Kuliah') }}</th>
                                <th class="py-3 text-center">{{ __('Tanggal') }}</th>
                                <th class="py-3 text-center">{{ __('Waktu') }}</th>
                                <th class="py-3 text-center">{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances ?? [] as $attendance)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $attendance->attendanceSession->schedule->course->name }}</div>
                                        <div class="small text-muted">{{ $attendance->attendanceSession->schedule->course->code }}</div>
                                    </td>
                                    <td class="text-center">{{ $attendance->scanned_at ? $attendance->scanned_at->format('d M Y') : '-' }}</td>
                                    <td class="text-center">{{ $attendance->scanned_at ? $attendance->scanned_at->format('H:i') : '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-soft-success text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> {{ __('Hadir') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-journal-x fs-1 d-block mb-3 opacity-25"></i>
                                        {{ __('Belum ada riwayat kehadiran.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
