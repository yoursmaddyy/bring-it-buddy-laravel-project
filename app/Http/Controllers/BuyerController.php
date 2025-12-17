<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuyerRequest;
use App\Models\TravellerPost;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    // SHOW MY REQUESTS
    public function index()
    {
        $requests = BuyerRequest::where('user_id', Auth::id())->with('travellerPost')->latest()->get();
        return view('buyer_requests.index', compact('requests'));
    }

    // SHOW FORM TO REQUEST ITEM (Requires Trip ID)
    public function create($post_id)
    {
        $trip = TravellerPost::findOrFail($post_id);
        return view('buyer_requests.create', compact('trip'));
    }

    // STORE REQUEST
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'item_name' => 'required|string',
            'item_weight' => 'required|numeric',
            'offered_price' => 'required|numeric',
        ]);

        BuyerRequest::create([
            'user_id' => Auth::id(),
            'traveller_post_id' => $post_id,
            'item_name' => $request->item_name,
            'item_description' => $request->item_description,
            'item_weight' => $request->item_weight,
            'offered_price' => $request->offered_price,
            'status' => 'pending'
        ]);

        return redirect()->route('buyer.index')->with('success', 'Request sent!');
    }

    // EDIT REQUEST
    public function edit($id)
    {
        $request = BuyerRequest::where('user_id', Auth::id())->findOrFail($id);
        return view('buyer_requests.edit', compact('request'));
    }

    // UPDATE REQUEST
    public function update(Request $request, $id)
    {
        $buyerRequest = BuyerRequest::where('user_id', Auth::id())->findOrFail($id);

        // Prevent editing if already accepted
        if($buyerRequest->status !== 'pending') {
            return back()->with('error', 'Cannot edit accepted requests.');
        }

        $buyerRequest->update($request->only(['item_name', 'item_description', 'item_weight', 'offered_price']));

        return redirect()->route('buyer.index')->with('success', 'Request updated.');
    }

    // DELETE / CANCEL REQUEST
    public function destroy($id)
    {
        $buyerRequest = BuyerRequest::where('user_id', Auth::id())->findOrFail($id);
        
        if($buyerRequest->status !== 'pending') {
            return back()->with('error', 'Cannot cancel processed requests.');
        }
        
        $buyerRequest->delete();
        return redirect()->route('buyer.index')->with('success', 'Request cancelled.');
    }
}