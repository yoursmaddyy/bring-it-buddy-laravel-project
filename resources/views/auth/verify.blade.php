<!DOCTYPE html>
<html>
<body>
    <h2>Step 1: Enter your Email</h2>

    <form action="{{ route('otp.send') }}" method="POST">
        @csrf
        <label>Email Address:</label><br>
        <input type="email" name="email" required placeholder="Enter your email"><br><br>

        <button type="submit">Send OTP</button>
    </form>
</body>
</html>