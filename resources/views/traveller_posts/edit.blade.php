@extends('layouts.app')

@section('content')
    <h2>Edit Trip</h2>
    <form action="{{ route('traveller.update', $post->id) }}" method="POST">
        @csrf @method('PUT')
        
        <label>From:</label> <input type="text" name="from_location" value="{{ $post->from_location }}"><br><br>
        <label>To:</label> <input type="text" name="to_location" value="{{ $post->to_location }}"><br><br>
        <label>Date:</label> <input type="date" name="travel_date" value="{{ $post->travel_date }}"><br><br>
        <label>Space (kg):</label> <input type="number" name="available_space" value="{{ $post->available_space }}"><br><br>
        <label>Fee:</label> <input type="number" name="fee" value="{{ $post->fee }}"><br><br>
        
        <label>Preference:</label>
        <select name="preference">
            <option value="lightweight" {{ $post->preference == 'lightweight' ? 'selected' : '' }}>Lightweight</option>
            <option value="heavy" {{ $post->preference == 'heavy' ? 'selected' : '' }}>Heavy</option>
            <option value="both" {{ $post->preference == 'both' ? 'selected' : '' }}>Both</option>
        </select><br><br>

        <button type="submit" class="btn">Update Trip</button>
    </form>
@endsection