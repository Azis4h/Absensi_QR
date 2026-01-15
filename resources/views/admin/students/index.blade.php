@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4 animate-fade-in">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold mb-1">{{ __('Manajemen Mahasiswa') }}</h1>
                <p class="text-muted small mb-0">{{ __('Kelola data akademik dan akun mahasiswa terdaftar.') }}</p>
            </div>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-person-plus me-2"></i>{{ __('Tambah Mahasiswa') }}
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
                            <th class="ps-4 py-3">{{ __('Mahasiswa') }}</th>
                            <th class="py-3">{{ __('NIM') }}</th>
                            <th class="py-3">{{ __('Jurusan') }}</th>
                            <th class="py-3 text-center">{{ __('Aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-soft-primary p-2 rounded-circle me-3">
                                            <i class="bi bi-person text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $student->user->name }}</div>
                                            <div class="small text-muted">{{ $student->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark fw-normal px-3 py-2 border">{{ $student->nim }}</span></td>
                                <td>{{ $student->major }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm glass-card">
                                            <li><a class="dropdown-item" href="{{ route('admin.students.edit', $student->id) }}"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Ubah') }}</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('{{ __('Apakah Anda yakin?') }}')">
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
