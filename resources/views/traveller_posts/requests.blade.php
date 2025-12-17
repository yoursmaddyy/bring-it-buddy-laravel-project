@extends('layouts.app')

@section('content')
    <h2>Manage Requests for Trip: {{ $post->from_location }} ➝ {{ $post->to_location }}</h2>
    <a href="{{ route('traveller.my_posts') }}" class="btn" style="background:gray;">Back to My Trips</a>
    <br><br>

    @if($post->requests->isEmpty())
        <p>No requests received yet.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Buyer Name</th>
                    <th>Item</th>
                    <th>Weight</th>
                    <th>Offered Reward</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($post->requests as $req)
                <tr>
                    <td>{{ $req->buyer->name }}</td>
                    <td>
                        <strong>{{ $req->item_name }}</strong><br>
                        <small>{{ $req->item_description }}</small>
                    </td>
                    <td>{{ $req->item_weight }} kg</td>
                    <td>Rs. {{ $req->offered_price }}</td>
                    <td>
                        @if($req->status == 'pending')
                            <span style="color:orange;">Pending</span>
                        @elseif($req->status == 'accepted')
                            <span style="color:green; font-weight:bold;">Accepted</span>
                        @else
                            <span style="color:red;">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if($req->status == 'pending')
                            <div style="display:flex; gap:10px;">
                                <form action="{{ route('traveller.request.update', $req->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" style="background:green; color:white; border:none; padding:5px 10px; cursor:pointer;">Accept</button>
                                </form>

                                <form action="{{ route('traveller.request.update', $req->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" style="background:red; color:white; border:none; padding:5px 10px; cursor:pointer;">Reject</button>
                                </form>
                            </div>
                        @else
                            {{ ucfirst($req->status) }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection