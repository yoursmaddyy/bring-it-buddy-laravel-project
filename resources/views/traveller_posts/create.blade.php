@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <h2>Post a New Trip</h2>

    @if($errors->any())
        <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('traveller.store') }}" method="POST">
        @csrf
        
        <label>Traveling From:</label><br>
        <input type="text" name="from_location" class="form-control" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Traveling To:</label><br>
        <input type="text" name="to_location" class="form-control" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Travel Date:</label><br>
        <input type="date" name="travel_date" class="form-control" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Available Space (kg):</label><br>
        <input type="number" step="0.1" name="available_space" class="form-control" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <label>Preference:</label><br>
        <select name="preference" class="form-control" style="width: 100%; padding: 8px; margin-bottom: 10px;">
            <option value="lightweight">Lightweight Items Only</option>
            <option value="heavy">Heavy Items Only</option>
            <option value="both">Both</option>
        </select><br>

        <label>Fee (PKR):</label><br>
        <input type="number" name="fee" class="form-control" required style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

        <button type="submit" class="btn" style="background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer;">Post Trip</button>
    </form>
</div>
@endsection