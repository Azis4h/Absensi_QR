@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Jadwal Baru') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.schedules.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="course_id" class="form-label">{{ __('Mata Kuliah') }}</label>
                            <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                                <option value="">{{ __('Pilih Mata Kuliah...') }}</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                                @endforeach
                            </select>
                            @error('course_id') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lecturer_id" class="form-label">{{ __('Dosen') }}</label>
                            <select class="form-select @error('lecturer_id') is-invalid @enderror" id="lecturer_id" name="lecturer_id" required>
                                <option value="">{{ __('Pilih Dosen...') }}</option>
                                @foreach($lecturers as $lecturer)
                                    <option value="{{ $lecturer->id }}">{{ $lecturer->user->name }}</option>
                                @endforeach
                            </select>
                            @error('lecturer_id') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="day" class="form-label">{{ __('Hari') }}</label>
                            <select class="form-select @error('day') is-invalid @enderror" id="day" name="day" required>
                                <option value="">{{ __('Pilih Hari...') }}</option>
                                @foreach($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('day') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">{{ __('Waktu Mulai') }}</label>
                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" required>
                                @error('start_time') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">{{ __('Waktu Selesai') }}</label>
                                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" required>
                                @error('end_time') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="room" class="form-label">{{ __('Ruangan') }}</label>
                            <input type="text" class="form-control @error('room') is-invalid @enderror" id="room" name="room" required>
                            @error('room') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">{{ __('Batal') }}</a>
                            <button type="submit" class="btn btn-primary">{{ __('Simpan Jadwal') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
