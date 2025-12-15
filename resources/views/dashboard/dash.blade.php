<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Bring It Buddy</title>
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f4f4f4; }
        .navbar { background: #333; overflow: hidden; padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; padding: 0 15px; font-weight: bold; }
        .navbar .user-info { color: #ccc; font-size: 0.9em; margin-right: 15px; }
        
        .container { padding: 40px; max-width: 1000px; margin: 0 auto; }
        .role-section { background: white; padding: 25px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .role-section h2 { margin-top: 0; }
        
        .btn { display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .btn-logout { background: #dc3545; border: none; padding: 8px 15px; color: white; border-radius: 4px; cursor: pointer; }
        
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8em; color: white; margin-left: 5px; }
        .bg-admin { background: #dc3545; }
        .bg-buyer { background: #28a745; }
        .bg-traveller { background: #17a2b8; }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <a href="#">Bring It Buddy</a>
            @if(auth()->user()->hasRole('admin')) <a href="#">Admin Panel</a> @endif
        </div>
        
        <div style="display: flex; align-items: center;">
            <span class="user-info">Logged in as: <strong>{{ auth()->user()->name }}</strong></span>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome back! Here are your active roles:</p>

        @if(auth()->user()->hasRole('admin'))
            <div class="role-section" style="border-left: 5px solid #dc3545;">
                <h2><span class="badge bg-admin">Admin</span> Control Center</h2>
                <p>Manage users, roles, and system settings.</p>
                <a href="#" class="btn">Manage Users</a>
                <a href="#" class="btn" style="background: #6c757d;">System Logs</a>
            </div>
        @endif

        @if(auth()->user()->hasRole('buyer'))
            <div class="role-section" style="border-left: 5px solid #28a745;">
                <h2><span class="badge bg-buyer">Buyer</span> Zone</h2>
                <p>Post requests for items you need from abroad.</p>
                <a href="#" class="btn">Post New Request</a>
                <a href="#" class="btn" style="background: #28a745;">View My Orders</a>
            </div>
        @endif

        @if(auth()->user()->hasRole('traveller'))
            <div class="role-section" style="border-left: 5px solid #17a2b8;">
                <h2><span class="badge bg-traveller">Traveller</span> Hub</h2>
                <p>Find orders matching your trip and earn money.</p>
                <a href="#" class="btn">Find Orders</a>
                <a href="#" class="btn" style="background: #17a2b8;">Manage Trips</a>
            </div>
        @endif
    </div>

</body>
</html>