<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TravellerPost;
use App\Models\BuyerRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTrips = TravellerPost::count();
        $totalOrders = BuyerRequest::count();
        
        // Get all data for the lists
        $users = User::with('roles')->latest()->take(5)->get(); // Recent 5 users
        $recentTrips = TravellerPost::with('user')->latest()->take(5)->get();
        $recentOrders = BuyerRequest::with('buyer')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalTrips', 'totalOrders', 'users', 'recentTrips', 'recentOrders'));
    }

    // POWER 1: Ban (Delete) User
    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User has been banned/deleted.');
    }

    // POWER 2: Delete Any Trip (Moderation)
    public function deleteTrip($id)
    {
        TravellerPost::destroy($id);
        return back()->with('success', 'Trip removed by Admin.');
    }

    // POWER 3: Delete Any Order (Moderation)
    public function deleteOrder($id)
    {
        BuyerRequest::destroy($id);
        return back()->with('success', 'Order removed by Admin.');
    }
}