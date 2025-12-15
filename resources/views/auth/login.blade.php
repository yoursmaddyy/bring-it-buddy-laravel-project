<!DOCTYPE html>
<html>
<body>
    <h2>Login</h2>

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label>Email:</label><br>
        <input type="text" name="login" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    
    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
</body>
</html>