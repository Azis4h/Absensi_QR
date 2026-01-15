@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 animate-fade-in">
        <div class="col-12">
            <a href="{{ route('lecturer.dashboard') }}" class="btn btn-link text-decoration-none ps-0 mb-3 text-muted">
                <i class="bi bi-arrow-left me-1"></i> {{ __('Kembali ke Dashboard') }}
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 fw-bold mb-1">{{ __('Daftar Kehadiran') }}</h1>
                    <p class="text-muted mb-0">
                        {{ $session->schedule->course->name }} - {{ $session->schedule->course->code }}
                    </p>
                </div>
                <div>
                    <span class="badge {{ $session->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                        {{ $session->is_active ? __('Sesi Aktif') : __('Sesi Berakhir') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row animate-fade-in" style="animation-delay: 0.1s">
        <div class="col-md-4 mb-4">
            <div class="glass-card p-4 h-100">
                <h5 class="fw-bold mb-3">{{ __('Informasi Sesi') }}</h5>
                <div class="mb-3">
                    <label class="text-muted small d-block">{{ __('Tanggal') }}</label>
                    <span class="fw-medium">{{ $session->date->format('d M Y') }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">{{ __('Waktu & Ruangan') }}</label>
                    <span class="fw-medium">{{ $session->schedule->start_time }} - {{ $session->schedule->end_time }}</span>
                    <div class="small text-muted">{{ $session->schedule->room }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block">{{ __('Total Hadir') }}</label>
                    <span class="display-6 fw-bold text-primary">{{ $session->attendances->count() }}</span>
                    <span class="text-muted">{{ __('Mahasiswa') }}</span>
                </div>
                @if($session->is_active)
                <div class="mt-4">
                    <a href="{{ route('lecturer.session.qr', $session->id) }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-qr-code me-2"></i>{{ __('Tampilkan QR Code') }}
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-8">
            <div class="glass-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3" style="width: 50px;">#</th>
                                <th class="py-3">{{ __('Nama Mahasiswa') }}</th>
                                <th class="py-3">{{ __('NIM') }}</th>
                                <th class="py-3">{{ __('Waktu Absen') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($session->attendances as $index => $attendance)
                                <tr>
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $attendance->student->user->name }}</div>
                                    </td>
                                    <td>{{ $attendance->student->student_id }}</td>
                                    <td>
                                        <span class="badge bg-soft-info text-info rounded-pill">
                                            {{ $attendance->scanned_at->format('H:i:s') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-people fs-1 mb-2 opacity-25"></i>
                                            <span>{{ __('Belum ada mahasiswa yang absen.') }}</span>
                                        </div>
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
