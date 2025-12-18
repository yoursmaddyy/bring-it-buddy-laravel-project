@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold text-dark">Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, <span style="color: var(--primary-teal); font-weight: bold;">{{ auth()->user()->name }}</span>!</p>
        </div>
        <div>
            <span class="badge bg-secondary rounded-pill px-3 py-2">
                {{ now()->format('l, F j, Y') }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        
        @if(auth()->user()->hasRole('admin'))
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid #dc3545 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px;">
                                🛠
                            </div>
                            <h3 class="ms-3 mb-0 fs-4 fw-bold text-danger">Admin Panel</h3>
                        </div>
                        <p class="text-muted">Manage users, oversee transactions, and monitor system health.</p>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger w-100 mt-2">
                            Go to Admin Panel &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->hasRole('traveller'))
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid #0dcaf0 !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px;">
                                ✈️
                            </div>
                            <h3 class="ms-3 mb-0 fs-4 fw-bold text-info">Traveller Hub</h3>
                        </div>
                        <p class="text-muted">Going somewhere? Post your trip details and earn money by bringing items.</p>
                        
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('traveller.create') }}" class="btn btn-info text-white fw-bold">
                                + Post New Trip
                            </a>
                            <a href="{{ route('traveller.my_posts') }}" class="btn btn-outline-info">
                                View My Scheduled Trips
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->hasRole('buyer'))
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm" style="border-top: 5px solid var(--primary-teal) !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color: var(--primary-teal) !important;">
                                🛍
                            </div>
                            <h3 class="ms-3 mb-0 fs-4 fw-bold" style="color: var(--primary-teal);">Buyer Zone</h3>
                        </div>
                        <p class="text-muted">Need an item from abroad? Find a traveller willing to bring it to you.</p>
                        
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('traveller.index') }}" class="btn btn-teal fw-bold">
                                Browse Available Trips
                            </a>
                            <a href="{{ route('buyer.index') }}" class="btn btn-outline-success" style="color: var(--primary-teal); border-color: var(--primary-teal);">
                                Track My Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection