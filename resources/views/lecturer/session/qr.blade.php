@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Session QR Code') }}</div>

                <div class="card-body text-center">
                    <h3>Scan to Attend</h3>
                    <p>Session Date: {{ $session->date->format('d M Y') }}</p>
                    <p>Expires at: {{ $session->expires_at->format('H:i') }}</p>

                    <div class="my-4">
                        {!! $qrCode !!}
                    </div>

                    <div class="alert alert-info">
                        Ask students to scan this QR code using their dashboard.
                    </div>

                    <a href="{{ route('lecturer.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
