@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="color: var(--primary-teal);">Available Trips</h2>
            <p class="text-muted">Find a traveller going your way.</p>
        </div>
        </div>

    @if($posts->isEmpty())
        <div class="text-center py-5">
            <div class="mb-3" style="font-size: 3rem;">✈️</div>
            <h4 class="text-muted">No trips available right now.</h4>
            <p>Check back later or post a request to notify travellers.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <div class="card-body p-4 d-flex flex-column">
                            
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="fw-bold mb-0 text-dark">
                                    {{ $post->from_location }} 
                                    <span style="color: var(--primary-teal);">&rarr;</span> 
                                    {{ $post->to_location }}
                                </h5>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-secondary fw-bold" style="width: 35px; height: 35px; margin-right: 10px;">
                                    {{ substr($post->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="line-height: 1;">Traveller</small>
                                    <span class="fw-bold text-secondary">{{ $post->user->name ?? 'Unknown' }}</span>
                                </div>
                            </div>

                            <hr class="text-muted opacity-25">

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Date</small>
                                    <div class="fw-medium text-dark">📅 {{ \Carbon\Carbon::parse($post->travel_date)->format('M d, Y') }}</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Capacity</small>
                                    <div class="fw-medium text-dark">📦 {{ $post->available_space }} kg</div>
                                </div>
                                <div class="col-6 mt-3">
                                    <small class="text-muted">Service Fee</small>
                                    <div class="fw-bold text-success">Rs. {{ number_format($post->fee) }}</div>
                                </div>
                                <div class="col-6 mt-3">
                                    <small class="text-muted">Accepts</small>
                                    <div>
                                        @if($post->preference == 'lightweight')
                                            <span class="badge bg-info text-dark rounded-pill">Lightweight</span>
                                        @elseif($post->preference == 'heavy')
                                            <span class="badge bg-warning text-dark rounded-pill">Heavy</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill">Any Item</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto pt-2">
                                <a href="{{ route('buyer.create', $post->id) }}" class="btn btn-teal w-100 fw-bold">
                                    Request Delivery
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection