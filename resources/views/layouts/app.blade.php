<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bring It Buddy</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; display: flex; flex-direction: column; min-height: 100vh; }
        nav { background: #333; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin-left: 15px; }
        main { flex: 1; padding: 20px; max-width: 1000px; margin: 0 auto; width: 100%; }
        footer { background: #eee; text-align: center; padding: 10px; margin-top: auto; }
        .btn { padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .error { color: red; background: #fee; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <nav>
        <div>
            <a href="{{ route('dashboard') }}" style="font-weight: bold; font-size: 1.2rem;">Bring It Buddy</a>
        </div>
        <div>
            @auth
                <span>Hello, {{ Auth::user()->name }}</span>
                @if(Auth::user()->hasRole('admin')) <a href="#">Admin Panel</a> @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:white; cursor:pointer; margin-left:15px;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div style="color: green; background: #e6fffa; padding: 10px; margin-bottom: 10px;">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        &copy; 2025 Bring It Buddy
    </footer>

</body>
</html>