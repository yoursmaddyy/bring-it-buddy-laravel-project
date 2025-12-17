@extends('layouts.app')

@section('content')
    <h1>Admin Overview</h1>
    <div style="display:flex; gap:20px;">
        <div style="background:#ddd; padding:20px;">Users: {{ $totalUsers }}</div>
        <div style="background:#ddd; padding:20px;">Trips: {{ $totalTrips }}</div>
        <div style="background:#ddd; padding:20px;">Orders: {{ $totalOrders }}</div>
    </div>

    <h3>Recent Trips</h3>
    <ul>
        @foreach($recentTrips as $trip)
            <li>{{ $trip->user->name }}: {{ $trip->from_location }} -> {{ $trip->to_location }}</li>
        @endforeach
    </ul>

    <h3>Recent Orders</h3>
    <ul>
        @foreach($recentOrders as $order)
            <li>{{ $order->buyer->name }} wants {{ $order->item_name }} ({{ $order->status }})</li>
        @endforeach
    </ul>
@endsection