@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold" style="color: var(--primary-teal);">My Scheduled Trips</h2>
            <p class="text-muted">Manage your upcoming travel plans.</p>
        </div>
        <a href="{{ route('traveller.create') }}" class="btn btn-teal btn-lg shadow-sm">
            + Post New Trip
        </a>
    </div>

    @if($posts->isEmpty())
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <h4 class="text-muted">You haven't posted any trips yet.</h4>
            <p class="mb-4">Share your travel plans to start earning money.</p>
            <a href="{{ route('traveller.create') }}" class="btn btn-outline-secondary">Post Your First Trip</a>
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-secondary">Route</th>
                                <th class="py-3 text-secondary">Travel Date</th>
                                <th class="py-3 text-secondary">Capacity</th>
                                <th class="py-3 text-secondary">Incoming Orders</th>
                                <th class="pe-4 py-3 text-end text-secondary">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">
                                    {{ $post->from_location }} &rarr; {{ $post->to_location }}
                                </td>
                                
                                <td>
                                    {{ \Carbon\Carbon::parse($post->travel_date)->format('M d, Y') }}
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $post->available_space }} kg left
                                    </span>
                                </td>

                                <td>
                                    @php $reqCount = $post->requests->count(); @endphp
                                    <a href="{{ route('traveller.view_requests', $post->id) }}" 
                                       class="btn btn-sm position-relative {{ $reqCount > 0 ? 'btn-outline-primary' : 'btn-outline-secondary' }}">
                                        View Requests
                                        @if($reqCount > 0)
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ $reqCount }}
                                            </span>
                                        @endif
                                    </a>
                                </td>

                                <td class="pe-4 text-end">
                                    <a href="{{ route('traveller.edit', $post->id) }}" class="btn btn-sm btn-link text-decoration-none text-secondary">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('traveller.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure? This will delete the trip and all associated requests.');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-decoration-none text-danger">
                                            Delete
                                        </button>
                                    </form>
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