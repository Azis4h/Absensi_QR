@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profil Tidak Ditemukan') }}</div>

                <div class="card-body">
                    <div class="alert alert-warning">
                        {{ __('Profil dosen Anda belum dibuat oleh administrator.') }}
                    </div>
                    <p>{{ __('Silakan hubungi admin untuk melengkapi data Anda agar dapat menggunakan fitur ini.') }}</p>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
                        {{ __('Keluar') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
