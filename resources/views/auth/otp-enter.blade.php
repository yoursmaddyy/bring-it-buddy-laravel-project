<!DOCTYPE html>
<html>
<body>
    <h2>Verify Account - Step 2</h2>
    <p>Enter the code sent to {{ session('email') }}</p>

    <form action="{{ route('otp.check') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ session('email') }}">

        <label>OTP Code:</label><br>
        <input type="text" name="otp" required><br><br>
        <button type="submit">Verify & Login</button>
    </form>
</body>
</html>