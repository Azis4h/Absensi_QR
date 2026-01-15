@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 animate-fade-in">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1">{{ __('Manajemen Dosen') }}</h1>
                <p class="text-muted small mb-0">{{ __('Kelola data penugasan dan akun pengajar terdaftar.') }}</p>
            </div>
            <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-person-plus me-2"></i>{{ __('Tambah Dosen') }}
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
                            <th class="ps-4 py-3">{{ __('Dosen') }}</th>
                            <th class="py-3">{{ __('NIP') }}</th>
                            <th class="py-3">{{ __('Departemen') }}</th>
                            <th class="py-3 text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lecturers as $lecturer)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-success p-2 rounded-circle me-3">
                                            <i class="bi bi-person-badge text-success"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $lecturer->user->name }}</div>
                                            <div class="small text-muted">{{ $lecturer->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark fw-normal px-3 py-2 border">{{ $lecturer->nip }}</span></td>
                                <td>{{ $lecturer->department }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm glass-card">
                                            <li><a class="dropdown-item" href="{{ route('admin.lecturers.edit', $lecturer->id) }}"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Ubah') }}</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.lecturers.destroy', $lecturer->id) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin?') }}')">
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
