@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Student Dashboard') }}</div>

                <div class="card-body">
                    <h3>Welcome, Student!</h3>
                    <p>Scan QR code to record your attendance.</p>

                    <div class="text-center">
                        <a href="{{ route('student.scan') }}" class="btn btn-lg btn-success">
                            <i class="bi bi-qr-code-scan"></i> Scan QR Code
                        </a>
                    </div>

                    <h4 class="mt-4">Attendance History</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through history -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
