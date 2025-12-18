@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: var(--primary-teal);">My Orders</h2>
        <a href="{{ route('traveller.index') }}" class="btn btn-teal btn-sm">
            + New Request
        </a>
    </div>

    @if($requests->isEmpty())
        <div class="text-center py-5">
            <h4 class="text-muted">No orders found.</h4>
            <p class="mb-4">You haven't requested any items yet.</p>
            <a href="{{ route('traveller.index') }}" class="btn btn-outline-secondary">Browse Traveller Trips</a>
        </div>
    @else
        <div class="row">
            @foreach($requests as $req)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-body">
                            
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold text-dark">{{ $req->item_name }}</h5>
                                
                                @php
                                    $badgeClass = match($req->status) {
                                        'pending' => 'bg-warning text-dark',
                                        'accepted' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        'completed' => 'bg-primary',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} rounded-pill px-3">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </div>

                            <p class="text-muted mb-3" style="font-size: 0.9em;">
                                <strong>Trip:</strong> 
                                {{ $req->travellerPost->from_location }} &rarr; {{ $req->travellerPost->to_location }}
                                <br>
                                <span class="text-secondary">Traveller: {{ $req->travellerPost->user->name ?? 'Unknown' }}</span>
                            </p>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <small class="text-muted d-block">Offered Reward</small>
                                    <span class="fw-bold text-success fs-5">Rs. {{ number_format($req->offered_price) }}</span>
                                </div>

                                @if($req->status == 'pending')
                                    <div class="btn-group">
                                        <a href="{{ route('buyer.edit', $req->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                        
                                        <form action="{{ route('buyer.destroy', $req->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-end">Cancel</button>
                                        </form>
                                    </div>
                                @else
                                    <button class="btn btn-light btn-sm text-muted" disabled>Locked</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection