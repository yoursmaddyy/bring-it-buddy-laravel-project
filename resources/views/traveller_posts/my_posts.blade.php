@extends('layouts.app')

@section('content')
    <h2>My Scheduled Trips</h2>
    <a href="{{ route('traveller.create') }}" class="btn">Add New Trip</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Route</th>
                <th>Date</th>
                <th>Space</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->from_location }} ➝ {{ $post->to_location }}</td>
                <td>{{ $post->travel_date }}</td>
                <td>{{ $post->available_space }} kg</td>
                <td>
                    <a href="{{ route('traveller.view_requests', $post->id) }}" 
                       class="btn" 
                       style="background:purple; padding:5px 10px; font-size:0.8em; color:white; display:block; margin-bottom:10px; text-align:center;">
                        View Requests ({{ $post->requests->count() }})
                    </a>

                    <a href="{{ route('traveller.edit', $post->id) }}" style="color: blue;">Edit</a>
                    |
                    <form action="{{ route('traveller.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" style="color: red; border: none; background: none; cursor: pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection