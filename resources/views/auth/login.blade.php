@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="text-center mb-4" style="color: var(--primary-teal);">Welcome Back</h2>
                <p class="text-center text-muted mb-4">Login to continue to Bring It Buddy</p>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Email or Username</label>
                        <input type="text" name="login" class="form-control form-control-lg" placeholder="Enter your email" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter your password" required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-teal btn-lg">Log In</button>
                    </div>

                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--primary-teal);">Register here</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection