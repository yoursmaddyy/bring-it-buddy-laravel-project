<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravellerPost;
use Illuminate\Support\Facades\Auth;

class TravellerController extends Controller
{
    // VIEW ALL TRIPS (For Buyers to see)
    public function index()
    {
        $posts = TravellerPost::where('status', true)->with('user')->latest()->get();
        return view('traveller_posts.index', compact('posts'));
    }

    // VIEW MY TRIPS (For Traveller to manage)
    public function myPosts()
    {
        $posts = TravellerPost::where('user_id', Auth::id())->latest()->get();
        return view('traveller_posts.my_posts', compact('posts'));
    }

    // CREATE FORM
    public function create()
    {
        return view('traveller_posts.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'travel_date' => 'required|date|after:today',
            'available_space' => 'required|numeric',
            'preference' => 'required|in:lightweight,heavy,both',
            'fee' => 'required|numeric',
        ]);

        $post = new TravellerPost($validated);
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('traveller.my_posts')->with('success', 'Trip created.');
    }

    // EDIT FORM
    public function edit($id)
    {
        $post = TravellerPost::where('user_id', Auth::id())->findOrFail($id);
        return view('traveller_posts.edit', compact('post'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $post = TravellerPost::where('user_id', Auth::id())->findOrFail($id);
        
        $validated = $request->validate([
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'travel_date' => 'required|date',
            'available_space' => 'required|numeric',
            'fee' => 'required|numeric',
            'preference' => 'required',
        ]);

        $post->update($validated);
        return redirect()->route('traveller.my_posts')->with('success', 'Trip updated.');
    }

    // DELETE
    public function destroy($id)
    {
        $post = TravellerPost::where('user_id', Auth::id())->findOrFail($id);
        $post->delete();
        return redirect()->route('traveller.my_posts')->with('success', 'Trip deleted.');
    }

    public function viewRequests($id)
    {
        // Get the post and ensure the current logged-in user owns it
        $post = TravellerPost::where('user_id', Auth::id())
                             ->with('requests.buyer') // Load requests and the buyers who made them
                             ->findOrFail($id);

        return view('traveller_posts.requests', compact('post'));
    }

    // 2. Accept or Reject a Request
    public function updateRequestStatus(Request $request, $request_id)
    {
        // Find the request
        $buyerRequest = \App\Models\BuyerRequest::findOrFail($request_id);
        
        // Security Check: Ensure the logged-in traveller owns the trip this request belongs to
        if ($buyerRequest->travellerPost->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate status
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        // Update Status
        $buyerRequest->status = $request->status;
        $buyerRequest->save();

        return back()->with('success', 'Request ' . $request->status);
    }
}