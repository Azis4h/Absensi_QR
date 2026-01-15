@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center animate-fade-in">
        <div class="col-md-5">
            <div class="glass-card p-5 border-0 shadow-lg">
                <div class="text-center mb-5">
                    <div class="bg-soft-primary p-3 rounded-circle d-inline-block mb-3">
                        <i class="bi bi-shield-lock text-primary fs-1"></i>
                    </div>
                    <h2 class="fw-bold">{{ __('Masuk ke Akun') }}</h2>
                    <p class="text-muted small">{{ __('Gunakan kredensial resmi Anda untuk masuk.') }}</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label small fw-bold text-muted">{{ __('Alamat Email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input id="email" type="email" class="form-control bg-light border-0 py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                        </div>
                        @error('email')
                            <span class="invalid-feedback d-block mt-2"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label small fw-bold text-muted">{{ __('Kata Sandi') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-muted"></i></span>
                            <input id="password" type="password" class="form-control bg-light border-0 py-2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="invalid-feedback d-block mt-2"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label small text-muted" for="remember">
                                {{ __('Ingat Saya') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="small text-primary text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Lupa Sandi?') }}
                            </a>
                        @endif
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary py-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Masuk Sekarang') }}
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-4 animate-fade-in" style="animation-delay: 0.2s">
                <p class="text-muted small">
                    {{ __('Butuh bantuan?') }} <a href="mailto:admin@example.com" class="text-primary text-decoration-none fw-bold">{{ __('Hubungi Admin') }}</a>
                </p>
                <a href="{{ url('/') }}" class="text-muted small text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i>{{ __('Kembali ke Beranda') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
