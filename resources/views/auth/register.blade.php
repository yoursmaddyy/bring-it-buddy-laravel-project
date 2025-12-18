@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="text-center mb-4" style="color: var(--primary-teal);">Create New Account</h2>
                <p class="text-center text-muted mb-4">Join our community of Travellers and Buyers.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="johndoe123" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="0300-1234567" value="{{ old('phone') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">CNIC</label>
                        <input type="text" name="cnic" class="form-control" placeholder="XXXXX-XXXXXXX-X" value="{{ old('cnic') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark mb-2 d-block">I want to register as:</label>
                        
                        <div class="d-flex gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="buyer" id="role_buyer">
                                <label class="form-check-label" for="role_buyer">
                                    <strong>Buyer</strong> <span class="text-muted">(Request items)</span>
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="traveller" id="role_traveller">
                                <label class="form-check-label" for="role_traveller">
                                    <strong>Traveller</strong> <span class="text-muted">(Bring items)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-teal btn-lg">Create Account</button>
                    </div>

                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--primary-teal);">Login here</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection