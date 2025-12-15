<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Bring It Buddy</title>
    <style>
        body { font-family: sans-serif; margin: 0; }
        .navbar { background: #333; overflow: hidden; padding: 10px; }
        .navbar a { float: left; color: white; text-decoration: none; padding: 10px 20px; }
        .navbar a:hover { background: #ddd; color: black; }
        .navbar .logout { float: right; background: #d9534f; }
        .container { padding: 20px; }
        .card { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .admin-box { background-color: #ffe6e6; }
        .buyer-box { background-color: #e6f7ff; }
        .traveller-box { background-color: #e6fffa; }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="#">Home</a>
        
        <a href="#">Profile</a>

        @if(auth()->user()->hasRole('buyer'))
            <a href="#">My Orders</a>
            <a href="#">Post Request</a>
        @endif

        @if(auth()->user()->hasRole('traveller'))
            <a href="#">Find Orders</a>
            <a href="#">My Trips</a>
        @endif

        @if(auth()->user()->hasRole('admin'))
            <a href="#">Manage Users</a>
            <a href="#">Site Settings</a>
        @endif

        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="logout" style="border:none; color:white; padding: 10px 20px; cursor:pointer;">Logout</button>
        </form>
    </div>

    <div class="container">
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        <p>You are logged in as: 
            <strong>
                {{ implode(', ', auth()->user()->roles->pluck('role_name')->toArray()) }}
            </strong>
        </p>

        @if(auth()->user()->hasRole('admin'))
            <div class="card admin-box">
                <h3>Admin Panel</h3>
                <p>You have full control over the system.</p>
                <ul>
                    <li>Total Users: 150</li>
                    <li>Pending Verifications: 3</li>
                </ul>
            </div>
        @endif

        @if(auth()->user()->hasRole('buyer'))
            <div class="card buyer-box">
                <h3>Buyer Dashboard</h3>
                <p>Need something from abroad? Post a request!</p>
                <button>Create New Request</button>
            </div>
        @endif

        @if(auth()->user()->hasRole('traveller'))
            <div class="card traveller-box">
                <h3>Traveller Dashboard</h3>
                <p>Traveling soon? Earn money by bringing items.</p>
                <button>Add Trip Details</button>
            </div>
        @endif
    </div>

</body>
</html>