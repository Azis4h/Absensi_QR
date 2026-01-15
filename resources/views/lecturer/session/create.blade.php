@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Attendance Session') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('lecturer.session.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="course" class="form-label">{{ __('Course / Schedule') }}</label>
                            <select class="form-select" id="course" name="schedule_id" required>
                                <option value="">{{ __('Select Schedule...') }}</option>
                                @foreach($courses as $schedule)
                                    <option value="{{ $schedule->id }}" {{ request('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->course->name }} ({{ $schedule->day }}, {{ $schedule->start_time }} - {{ $schedule->end_time }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">{{ __('Duration (Minutes)') }}</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="30" required>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Generate QR Code') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
