@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome back, <strong>{{ auth()->user()->name }}</strong>!</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
        
        @if(auth()->user()->hasRole('admin'))
            <div style="background: #ffe6e6; padding: 20px; border-radius: 8px;">
                <h3>🔴 Admin Panel</h3>
                <p>Manage the entire system.</p>
                <a href="{{ route('admin.dashboard') }}" class="btn">Go to Admin Panel</a>
            </div>
        @endif

        @if(auth()->user()->hasRole('traveller'))
            <div style="background: #e6f7ff; padding: 20px; border-radius: 8px;">
                <h3>🔵 Traveller Zone</h3>
                <p>Post trips and earn money.</p>
                <a href="{{ route('traveller.create') }}" class="btn">Post a New Trip</a>
                <a href="{{ route('traveller.my_posts') }}" class="btn" style="background:#0056b3;">My Trips</a>
            </div>
        @endif

        @if(auth()->user()->hasRole('buyer'))
            <div style="background: #e6fffa; padding: 20px; border-radius: 8px;">
                <h3>🟢 Buyer Zone</h3>
                <p>Find travellers to bring your items.</p>
                <a href="{{ route('traveller.index') }}" class="btn">Browse Trips</a>
                <a href="{{ route('buyer.index') }}" class="btn" style="background:#218838;">My Orders</a>
            </div>
        @endif

    </div>
</div>
@endsection