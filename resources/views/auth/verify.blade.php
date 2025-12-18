@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <div class="text-center mb-4">
                    <h2 style="color: var(--primary-teal);">Verify Account</h2>
                    <p class="text-muted">Step 1 of 2</p>
                </div>

                <p class="text-center mb-4 text-secondary">
                    Please enter the email address you used during registration. We will send you a 4-digit OTP code.
                </p>

                <form action="{{ route('auth.otp.send') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" 
                               placeholder="john@example.com" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-teal btn-lg">Send Verification Code</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-decoration-none text-muted">
                        &larr; Back to Login
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection