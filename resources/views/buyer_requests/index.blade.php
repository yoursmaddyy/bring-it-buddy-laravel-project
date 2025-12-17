@extends('layouts.app')

@section('content')
    <h2>My Orders / Requests</h2>
    @foreach($requests as $req)
        <div style="border:1px solid #ccc; padding:15px; margin-bottom:10px;">
            <h3>{{ $req->item_name }} ({{ $req->status }})</h3>
            <p>Trip: {{ $req->travellerPost->from_location }} ➝ {{ $req->travellerPost->to_location }}</p>
            <p>Offered: Rs. {{ $req->offered_price }}</p>
            
            @if($req->status == 'pending')
                <a href="{{ route('buyer.edit', $req->id) }}">Edit</a> | 
                <form action="{{ route('buyer.destroy', $req->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" style="color:red; border:none; background:none; cursor:pointer;">Cancel</button>
                </form>
            @endif
        </div>
    @endforeach
@endsection