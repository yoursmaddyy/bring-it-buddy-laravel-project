@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-5">
                
                <h2 class="text-center mb-4" style="color: var(--primary-teal);">Post a New Trip</h2>
                <p class="text-center text-muted mb-4">Going somewhere? Share your space and earn money.</p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            {{ $errors->first() }}
                        </ul>
                    </div>
                @endif

                <form action="{{ route('traveller.store') }}" method="POST">
                    @csrf
                    
                    <h5 class="text-secondary mb-3 border-bottom pb-2">Trip Route</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Traveling From</label>
                            <input type="text" name="from_location" class="form-control" placeholder="e.g. Islamabad" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Traveling To</label>
                            <input type="text" name="to_location" class="form-control" placeholder="e.g. London" required>
                        </div>
                    </div>

                    <h5 class="text-secondary mb-3 mt-4 border-bottom pb-2">Logistics</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Travel Date</label>
                            <input type="date" name="travel_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Available Space (kg)</label>
                            <input type="number" step="0.1" name="available_space" class="form-control" placeholder="e.g. 5.0" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Service Fee (PKR)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rs.</span>
                                <input type="number" name="fee" class="form-control" placeholder="e.g. 2000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary">Item Preference</label>
                            <select name="preference" class="form-select">
                                <option value="both">Both (Light & Heavy)</option>
                                <option value="lightweight">Lightweight Items Only</option>
                                <option value="heavy">Heavy Items Only</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <a href="{{ route('traveller.my_posts') }}" class="text-decoration-none text-muted">Cancel</a>
                        <button type="submit" class="btn btn-teal btn-lg px-5">Post Trip</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection