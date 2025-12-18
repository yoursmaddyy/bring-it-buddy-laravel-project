@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        
        <h2 class="mb-4" style="color: var(--primary-teal);">Make a Request</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                
                <div class="alert" style="background-color: #e0f2f1; border-left: 5px solid var(--primary-teal);">
                    <h5 class="alert-heading fw-bold mb-1">Trip Details</h5>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <small class="text-muted">Route:</small><br>
                            <strong>{{ $trip->from_location }} &rarr; {{ $trip->to_location }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Traveller:</small><br>
                            <strong>{{ $trip->user->name ?? 'Unknown' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted">Travel Date:</small><br>
                            <strong>{{ $trip->travel_date }}</strong>
                        </div>
                    </div>
                </div>

                <form action="{{ route('buyer.store', $trip->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Item Name</label>
                        <input type="text" name="item_name" class="form-control" placeholder="e.g. iPhone 15 Pro Max" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Est. Weight (kg)</label>
                            <input type="number" step="0.1" name="item_weight" class="form-control" placeholder="0.5" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-secondary">Your Offered Reward (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="number" name="offered_price" class="form-control" placeholder="5000" required>
                            </div>
                            <small class="text-muted">This is the fee you pay the traveller.</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary">Description / Details</label>
                        <textarea name="item_description" class="form-control" rows="4" placeholder="Provide link to product, color preference, or specific shop location..."></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('traveller.index') }}" class="text-decoration-none text-muted">Cancel</a>
                        <button type="submit" class="btn btn-teal px-5 py-2 fw-bold">Send Request</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection