@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center animate-fade-in">
        <div class="col-md-8 text-center">
            <div class="glass-card p-5 border-0 shadow-lg">
                <span class="badge bg-soft-success text-success px-4 py-2 rounded-pill mb-3">
                    <i class="bi bi-broadcast me-2"></i>{{ __('Sesi Absensi Aktif') }}
                </span>
                
                <h3 class="fw-bold mb-1">{{ $session->schedule->course->name }}</h3>
                <p class="text-muted mb-4 small">{{ $session->schedule->course->code }} | {{ $session->schedule->room }}</p>

                <div class="qr-container bg-white p-4 d-inline-block rounded-4 shadow-sm mb-4">
                    {!! $qrCode !!}
                </div>

                <div class="alert bg-soft-warning border-0 animate-pulse mb-4">
                    <i class="bi bi-clock-history me-2 text-warning"></i>
                    <span class="text-dark">{{ __('Sesi ini akan berakhir pada jam') }}: <strong>{{ $session->expires_at->format('H:i') }}</strong></span>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-center">
                    <a href="{{ route('lecturer.dashboard') }}" class="btn btn-outline-primary px-4">
                        <i class="bi bi-speedometer2 me-2"></i>{{ __('Ke Dashboard') }}
                    </a>
                    <button onclick="window.location.reload()" class="btn btn-link text-muted">
                        <i class="bi bi-arrow-clockwise me-2"></i>{{ __('Segarkan Halaman') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .qr-container svg {
        width: 250px !important;
        height: 250px !important;
    }
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
</style>
@endsection
