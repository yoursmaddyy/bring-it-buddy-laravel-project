@extends('layouts.app')

@section('content')
    <h2>Request Item from this Trip</h2>
    <p>Trip: {{ $trip->from_location }} to {{ $trip->to_location }}</p>

    <form action="{{ route('buyer.store', $trip->id) }}" method="POST">
        @csrf
        <label>Item Name:</label><br> <input type="text" name="item_name" required><br>
        <label>Weight (kg):</label><br> <input type="number" step="0.1" name="item_weight" required><br>
        <label>Offered Price (PKR):</label><br> <input type="number" name="offered_price" required><br>
        <label>Description:</label><br> <textarea name="item_description"></textarea><br><br>
        <button type="submit" class="btn">Send Request</button>
    </form>
@endsection