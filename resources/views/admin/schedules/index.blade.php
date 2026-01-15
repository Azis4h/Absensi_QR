@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 animate-fade-in">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1">{{ __('Manajemen Jadwal') }}</h1>
                <p class="text-muted small mb-0">{{ __('Kelola penugasan dosen ke mata kuliah dan jadwal mingguan.') }}</p>
            </div>
            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-calendar-plus me-2"></i>{{ __('Tambah Jadwal') }}
            </a>
        </div>
    </div>

    <div class="animate-fade-in" style="animation-delay: 0.1s">
        @if (session('success'))
            <div class="alert bg-soft-success border-0 text-success mb-4" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="glass-card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">{{ __('Mata Kuliah') }}</th>
                            <th class="py-3">{{ __('Dosen') }}</th>
                            <th class="py-3">{{ __('Waktu & Ruangan') }}</th>
                            <th class="py-3 text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-info p-2 rounded-3 me-3">
                                            <i class="bi bi-journal-check text-info"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $schedule->course->name }}</div>
                                            <div class="small text-muted">{{ $schedule->course->code }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $schedule->lecturer->user->name }}</div>
                                    <div class="small text-muted">NIP: {{ $schedule->lecturer->nip }}</div>
                                </td>
                                <td>
                                    <div class="mb-1"><i class="bi bi-calendar-event me-2 text-primary"></i><strong>{{ __($schedule->day) }}</strong></div>
                                    <div class="small text-muted"><i class="bi bi-clock me-2"></i>{{ $schedule->start_time }} - {{ $schedule->end_time }} | <i class="bi bi-geo-alt me-1"></i>{{ $schedule->room }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm glass-card">
                                            <li><a class="dropdown-item" href="{{ route('admin.schedules.edit', $schedule->id) }}"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Ubah') }}</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>{{ __('Hapus') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
