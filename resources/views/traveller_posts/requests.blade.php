@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="mb-4">
        <a href="{{ route('traveller.my_posts') }}" class="text-decoration-none text-secondary mb-2 d-inline-block">
            &larr; Back to My Trips
        </a>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold" style="color: var(--primary-teal);">Manage Requests</h2>
                <p class="text-muted mb-0">
                    Trip Route: <span class="text-dark fw-bold">{{ $post->from_location }} &rarr; {{ $post->to_location }}</span>
                </p>
            </div>
            <div class="text-end d-none d-md-block">
                <span class="badge bg-light text-dark border p-2">
                    {{ $post->requests->count() }} Total Requests
                </span>
            </div>
        </div>
    </div>

    @if($post->requests->isEmpty())
        <div class="text-center py-5 bg-white rounded shadow-sm border">
            <div class="mb-3" style="font-size: 2.5rem;">📭</div>
            <h4 class="text-muted">No requests yet.</h4>
            <p class="text-secondary">Wait for buyers to see your trip and send offers.</p>
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-secondary">Buyer</th>
                                <th class="py-3 text-secondary">Item Details</th>
                                <th class="py-3 text-secondary">Weight</th>
                                <th class="py-3 text-secondary">Reward</th>
                                <th class="py-3 text-secondary">Status</th>
                                <th class="pe-4 py-3 text-end text-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post->requests as $req)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $req->buyer->name ?? 'Unknown' }}</div>
                                    <small class="text-muted">Buyer</small>
                                </td>

                                <td style="max-width: 250px;">
                                    <div class="fw-bold text-primary">{{ $req->item_name }}</div>
                                    @if($req->item_description)
                                        <div class="text-muted text-truncate" style="font-size: 0.85em;">
                                            {{ $req->item_description }}
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $req->item_weight }} kg</td>

                                <td>
                                    <span class="fw-bold text-success">Rs. {{ number_format($req->offered_price) }}</span>
                                </td>

                                <td>
                                    @if($req->status == 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill">Pending Review</span>
                                    @elseif($req->status == 'accepted')
                                        <span class="badge bg-success rounded-pill">Accepted</span>
                                    @elseif($req->status == 'rejected')
                                        <span class="badge bg-danger rounded-pill">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill">{{ ucfirst($req->status) }}</span>
                                    @endif
                                </td>

                                <td class="pe-4 text-end">
                                    @if($req->status == 'pending')
                                        <div class="d-flex gap-2 justify-content-end">
                                            
                                            <form action="{{ route('traveller.request.update', $req->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="accepted">
                                                <button type="submit" class="btn btn-success btn-sm shadow-sm" title="Accept Offer">
                                                    ✓ Accept
                                                </button>
                                            </form>

                                            <form action="{{ route('traveller.request.update', $req->id) }}" method="POST" onsubmit="return confirm('Reject this offer?');">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Reject Offer">
                                                    ✕
                                                </button>
                                            </form>

                                        </div>
                                    @else
                                        <span class="text-muted small">Locked</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection