@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Attendance Session') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="mb-3">
                            <label for="course" class="form-label">Course / Schedule</label>
                            <select class="form-select" id="course" name="schedule_id" required>
                                <option value="">Select Schedule...</option>
                                <!-- options populate dynamically -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="30" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Generate QR Code</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
