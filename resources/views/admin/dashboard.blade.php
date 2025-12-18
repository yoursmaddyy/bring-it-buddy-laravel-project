@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2 class="fw-bold mb-4" style="color: #dc3545;">🔴 Admin Control Panel</h2>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-4" style="border-bottom: 5px solid #007bff !important;">
                <h5 class="text-muted">Total Users</h5>
                <h1 class="fw-bold text-primary">{{ $totalUsers }}</h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-4" style="border-bottom: 5px solid #17a2b8 !important;">
                <h5 class="text-muted">Active Trips</h5>
                <h1 class="fw-bold text-info">{{ $totalTrips }}</h1>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center py-4" style="border-bottom: 5px solid #28a745 !important;">
                <h5 class="text-muted">Total Orders</h5>
                <h1 class="fw-bold text-success">{{ $totalOrders }}</h1>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">👤 Recent Users</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-secondary">{{ $role->role_name }}</span>
                            @endforeach
                        </td>
                        <td class="text-end pe-4">
                            <form action="{{ route('admin.delete_user', $user->id) }}" method="POST" onsubmit="return confirm('WARNING: This will ban the user and delete all their data. Continue?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Ban User</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">✈️ Recent Trips</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Route</th>
                                <th>Traveller</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTrips as $trip)
                            <tr>
                                <td class="ps-3">
                                    {{ $trip->from_location }} &rarr; {{ $trip->to_location }}<br>
                                    <small class="text-muted">{{ $trip->travel_date }}</small>
                                </td>
                                <td>{{ $trip->user->name }}</td>
                                <td class="text-end pe-3">
                                    <form action="{{ route('admin.delete_trip', $trip->id) }}" method="POST" onsubmit="return confirm('Remove this trip?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger text-white px-2">X</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 mb-4 h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">📦 Recent Orders</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Item</th>
                                <th>Buyer</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td class="ps-3">
                                    {{ $order->item_name }}<br>
                                    <small class="badge bg-light text-dark border">{{ $order->status }}</small>
                                </td>
                                <td>{{ $order->buyer->name }}</td>
                                <td class="text-end pe-3">
                                    <form action="{{ route('admin.delete_order', $order->id) }}" method="POST" onsubmit="return confirm('Remove this order?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger text-white px-2">X</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection