<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QR Attendance - Modern System</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="hero-section d-flex align-items-center min-vh-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 animate-fade-in">
                        <h1 class="welcome-title">QR Attendance<br>System</h1>
                        <p class="lead text-secondary mb-5">
                            {{ __('Effective, Efficient, and Accurate Attendance Tracking') }}
                        </p>
                        
                        <div class="d-flex gap-3">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/home') }}" class="btn btn-primary btn-lg px-5">
                                        {{ __('Dashboard') }}
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                                        {{ __('Login Masuk') }}
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block animate-fade-in" style="animation-delay: 0.2s">
                        <div class="glass-card p-5 text-center">
                            <div class="mb-4">
                                <span class="badge bg-soft-primary p-3 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-qr-code-scan text-primary" viewBox="0 0 16 16">
                                        <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
                                        <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
                                        <path d="M7 9H2v5h5V9ZM3 10h3v3H3v-3Zm8-1h1v1h-1V9Z"/>
                                        <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1V8H8Z"/>
                                        <path d="M12 10h1v1h-1v-1Zm2-1h1v1h-1V9Zm-3 2h1v1h-1v-1Zm2 0h1v1h-1v-1Zm-2 2h1v1h-1v-1Zm2 0h1v1h-1v-1ZM9 14h2v1H9v-1Z"/>
                                    </svg>
                                </span>
                            </div>
                            <h3>Absensi Canggih</h3>
                            <p class="text-muted">Gunakan pemindaian QR Code untuk presensi yang lebih cepat dan aman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
