<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    @if ($errors->any())
        <div style="color: red; background: #ffe6e6; padding: 10px; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Create Account</h2>

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>

        <label>CNIC:</label><br>
        <input type="text" name="cnic" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <label><strong>I want to register as:</strong></label><br>
        <input type="checkbox" name="roles[]" value="buyer" id="role_buyer"> 
        <label for="role_buyer">Buyer (I want to request items)</label><br>

        <input type="checkbox" name="roles[]" value="traveller" id="role_traveller"> 
        <label for="role_traveller">Traveller (I want to bring items)</label><br>
        <br>

        <button type="submit">Register</button>
    </form>
</body>
</html>