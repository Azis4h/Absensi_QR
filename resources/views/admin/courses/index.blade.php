@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 animate-fade-in">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1">{{ __('Manajemen Mata Kuliah') }}</h1>
                <p class="text-muted small mb-0">{{ __('Kelola daftar mata kuliah yang tersedia di kurikulum.') }}</p>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>{{ __('Tambah Mata Kuliah') }}
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
                            <th class="py-3">{{ __('Kode') }}</th>
                            <th class="py-3">{{ __('SKS') }}</th>
                            <th class="py-3 text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-warning p-2 rounded-circle me-3">
                                            <i class="bi bi-book text-warning"></i>
                                        </div>
                                        <div class="fw-bold text-dark">{{ $course->name }}</div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark fw-normal px-3 py-2 border">{{ $course->code }}</span></td>
                                <td>{{ $course->credits }} SKS</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm glass-card">
                                            <li><a class="dropdown-item" href="{{ route('admin.courses.edit', $course->id) }}"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Ubah') }}</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin?') }}')">
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
