@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5 text-center">
                
                <h2 class="mb-3" style="color: var(--primary-teal);">Verify Your Identity</h2>
                
                <p class="text-muted mb-4">
                    We have sent a verification code to:<br>
                    <span class="badge bg-secondary mt-2 fs-6">{{ session('email') }}</span>
                </p>

                <form action="{{ route('auth.otp.check') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <div class="mb-4 text-start">
                        <label class="form-label fw-bold text-secondary">Enter OTP Code</label>
                        <input type="text" name="otp" class="form-control form-control-lg text-center letter-spacing" 
                               placeholder="X X X X" maxlength="4" style="letter-spacing: 5px; font-weight: bold;" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-teal btn-lg">Verify & Login</button>
                    </div>
                </form>

                <div class="mt-4">
                    <small class="text-muted">Didn't receive code? 
                        <a href="{{ route('auth.verify') }}" style="color: var(--primary-teal); text-decoration: none;">Try Again</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection