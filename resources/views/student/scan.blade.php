@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center animate-fade-in">
        <div class="col-md-8 text-center">
            <h2 class="fw-bold mb-4">{{ __('Scan Kehadiran') }}</h2>
            
            <div class="glass-card p-4 border-0 shadow-lg">
                <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto; overflow: hidden; border-radius: 1rem;"></div>
                
                <div class="mt-4 p-3 bg-soft-info rounded-3">
                    <i class="bi bi-info-circle text-info me-2"></i>
                    <span class="text-dark small">{{ __('Arahkan kamera ke QR Code dosen dengan jelas.') }}</span>
                </div>

                <form id="attendance-form" action="{{ route('student.attendance.store') }}" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" name="qr_token" id="qr_token">
                </form>

                <div class="mt-4">
                    <a href="{{ route('student.dashboard') }}" class="btn btn-link text-muted">
                        <i class="bi bi-arrow-left me-1"></i>{{ __('Kembali ke Dashboard') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning
        html5QrcodeScanner.clear();

        // Submit form
        document.getElementById('qr_token').value = decodedText;
        document.getElementById('attendance-form').submit();
    }

    function onScanFailure(error) {
        // handle scan failure
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 15, qrbox: {width: 280, height: 280} },
        /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

<style>
    #reader__dashboard_section_csr button {
        background-color: var(--primary-color) !important;
        color: white !important;
        border: none !important;
        padding: 8px 20px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        margin-top: 10px !important;
    }
    #reader video {
        border-radius: 1rem !important;
    }
</style>
@endsection
