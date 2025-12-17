@extends('layouts.app')

@section('content')
    <h2>Available Travellers</h2>

    @if($posts->isEmpty())
        <p>No trips available right now.</p>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            @foreach($posts as $post)
                <div style="border: 1px solid #ccc; padding: 20px; border-radius: 8px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    
                    <h3 style="margin-top:0; color: #333;">
                        {{ $post->from_location }} ➝ {{ $post->to_location }}
                    </h3>
                    
                    <p style="color: #666; font-size: 0.9em; margin-bottom: 15px;">
                        <strong>Traveller:</strong> {{ $post->user->name ?? 'Unknown' }}
                    </p>
                    
                    <hr style="border: 0; border-top: 1px solid #eee;">

                    <p><strong>📅 Date:</strong> {{ $post->travel_date }}</p>
                    <p><strong>📦 Space:</strong> {{ $post->available_space }} kg</p>
                    <p><strong>💰 Fee:</strong> Rs. {{ number_format($post->fee) }}</p>
                    <p><strong>⚖️ Preference:</strong> {{ ucfirst($post->preference) }}</p>
                    
                    <a href="{{ route('buyer.create', $post->id) }}" 
                       class="btn" 
                       style="display: block; text-align: center; background: #28a745; color: white; padding: 10px; text-decoration: none; border-radius: 4px; margin-top: 15px;">
                        Request Delivery
                    </a>
                </div>
            @endforeach
        </div>
    @endif
@endsection