<?php

namespace App\Http\Controllers;

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
        
        $recentTrips = TravellerPost::with('user')->latest()->take(5)->get();
        $recentOrders = BuyerRequest::with('buyer')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalTrips', 'totalOrders', 'recentTrips', 'recentOrders'));
    }
}