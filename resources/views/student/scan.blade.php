@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Scan Attendance QR') }}</div>

                <div class="card-body text-center">
                    <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                    
                    <form id="attendance-form" action="{{ route('student.attendance.store') }}" method="POST" class="d-none">
                        @csrf
                        <input type="hidden" name="qr_token" id="qr_token">
                    </form>

                    <p class="mt-3">Please point your camera at the QR code displayed by the lecturer.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        
        // Stop scanning
        html5QrcodeScanner.clear();

        // Submit form
        document.getElementById('qr_token').value = decodedText;
        document.getElementById('attendance-form').submit();
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection
