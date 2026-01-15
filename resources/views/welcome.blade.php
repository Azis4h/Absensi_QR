<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QR Attendance System</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div class="container text-center mt-5">
            <h1>Sistem Absensi Mahasiswa Berbasis QR Code</h1>
            <p class="lead">Effective, Efficient, and Accurate Attendance Tracking</p>
            
            <div class="mt-4">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>

            <div class="mt-5">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=DemoQR" alt="Demo QR" class="img-thumbnail">
            </div>
        </div>
    </body>
</html>
